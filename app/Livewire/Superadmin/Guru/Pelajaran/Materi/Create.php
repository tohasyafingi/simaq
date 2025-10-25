<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use App\Models\Materi;
use App\Models\GuruPelajaran;
use App\Models\Rombel;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $guruPelajaranId;
    public $rombelId;
    public $materi_id;
    public $judul;
    public $deskripsi;
    public $tanggal;
    public $jam;
    public $file;
    public $status = true;
    public $absensi = [];
    public $successMessage;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'file' => 'nullable|string|max:255',
        'status' => 'boolean',
    ];

    public function mount($guruPelajaranId, $rombelId)
    {
        $this->guruPelajaranId = $guruPelajaranId;
        $this->rombelId = $rombelId;
        $this->tanggal = now()->toDateString();

        // Validasi tambahan: Pastikan rombel terkait dengan guruPelajaran
        $guruPelajaran = GuruPelajaran::findOrFail($this->guruPelajaranId);
        if (!$guruPelajaran->rombels()->where('rombels.id', $this->rombelId)->exists()) {
            abort(404, 'Rombel tidak terkait dengan guru pelajaran ini.');
        }
    }

    public function store()
    {
        $this->validate();

        // Validasi tambahan sebelum transaction
        if (!GuruPelajaran::find($this->guruPelajaranId)) {
            $this->addError('guruPelajaranId', 'Guru pelajaran tidak ditemukan.');
            return;
        }
        if (!Rombel::find($this->rombelId)) {
            $this->addError('rombelId', 'Rombel tidak ditemukan.');
            return;
        }

        try {
            DB::transaction(function () {
                $materi = Materi::create([
                    'guru_pelajaran_id' => $this->guruPelajaranId,
                    'rombel_id' => $this->rombelId,
                    'judul' => $this->judul,
                    'deskripsi' => $this->deskripsi,
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'file' => $this->file,
                    'status' => $this->status,
                ]);

                $this->materi_id = $materi->id;

                $rombel = Rombel::with('siswaAktif')->findOrFail($this->rombelId);
                foreach ($rombel->siswaAktif as $siswa) {
                    Absensi::create([
                        'materi_id' => $materi->id,
                        'siswa_id' => $siswa->id,
                        'status_kehadiran' => null,
                        'status' => true,
                    ]);
                }
            });

            $this->successMessage = 'Materi berhasil dibuat!';
            $this->reset(['judul', 'deskripsi', 'jam', 'file', 'absensi']);
        } catch (\Exception $e) {
            $this->addError('general', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }


    public function render()
    {
        // Ambil guruPelajaran dan rombel spesifik
        $guruPelajaran = GuruPelajaran::with('pelajaran')->findOrFail($this->guruPelajaranId);
        $rombel = Rombel::with('siswaAktif')->findOrFail($this->rombelId);

        return view('livewire.superadmin.guru.pelajaran.materi.create', [ // Update path view
            'title' => 'Tambah Materi - ' . ($guruPelajaran->pelajaran->nama ?? '-') . ' (Rombel: ' . $rombel->nama . ')',
            'guruPelajaran' => $guruPelajaran,
            'rombel' => $rombel, // Pass rombel untuk view
        ])->title('Tambah Materi');
    }
}
