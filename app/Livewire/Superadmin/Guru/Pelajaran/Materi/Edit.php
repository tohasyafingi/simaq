<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Materi;
use App\Models\Rombel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;

#[Title('Edit Materi')]
class Edit extends Component
{
    use WithFileUploads;

    public $materiId;
    public $guruPelajaranId;
    public $rombelId;
    public $judul;
    public $deskripsi;
    public $tanggal;
    public $jam;
    public $file; // Bisa file baru diupload
    public $fileLama; // Menyimpan file lama
    public $status = true;
    public $absensi = [];
    public $successMessage;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'file' => 'nullable|file|mimes:pdf,doc,docx,pptx,jpg,png|max:5120', // max 5MB
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
        $this->fileLama = $materi->file; // simpan file lama
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

                $filePath = $this->fileLama;

                // Jika user upload file baru, simpan dan replace file lama
                if ($this->file) {
                    $filePath = $this->file->store('materi', 'public');
                }

                $materi->update([
                    'judul' => $this->judul,
                    'deskripsi' => $this->deskripsi,
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'file' => $filePath,
                    'status' => $this->status,
                ]);

                $this->fileLama = $filePath; // update preview file
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
            'title' => 'Edit Materi - (Rombel: ' . $rombel->nama . ')',
            'rombel' => $rombel,
        ]);
    }
}
