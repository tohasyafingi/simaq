<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use App\Models\Materi;
use App\Models\Rombel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;

#[Title('Edit Materi')]
class Edit extends Component
{
    public $materiId;
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

    public function mount($materiId)
    {
        $materi = Materi::with('rombel')->findOrFail($materiId);
        $this->materiId = $materi->id;
        $this->guruPelajaranId = $materi->guru_pelajaran_id;
        $this->rombelId = $materi->rombel_id;
        $this->judul = $materi->judul;
        $this->deskripsi = $materi->deskripsi;
        $this->tanggal = $materi->tanggal;
        $this->jam = $materi->jam;
        $this->file = $materi->file;
        $this->status = $materi->status;

        // Load absensi yang sudah ada
        foreach ($materi->absensis as $abs) {
            $this->absensi[$abs->siswa_id] = $abs->status_kehadiran;
        }
    }

    public function update()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $materi = Materi::findOrFail($this->materiId);
                $materi->update([
                    'judul' => $this->judul,
                    'deskripsi' => $this->deskripsi,
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'file' => $this->file,
                    'status' => $this->status,
                ]);
            });

            $this->successMessage = 'Materi berhasil diperbarui!';
        } catch (\Exception $e) {
            $this->addError('general', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $rombel = Rombel::with('siswaAktif')->findOrFail($this->rombelId);

        return view('livewire.superadmin.guru.pelajaran.materi.edit', [
            'title' => 'Edit Materi - ' .  ' (Rombel: ' . $rombel->nama . ')',
            'rombel' => $rombel,
        ]);
    }
}
