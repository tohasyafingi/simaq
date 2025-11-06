<?php

namespace App\Livewire\Superadmin\Siswa\Materi;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Materi;
use App\Models\Rombel;
use App\Models\Siswa;

#[Title('Data Absensi Mata Pelajaran')]
class Absensi extends Component
{
    public $materiId;
    public $pelajaranId;
public $siswa;
    public $materi;
    public $rombel;
    public $absensi = [];

public function mount($siswaId, $pelajaranId, $materiId)
{
    $this->materiId = $materiId;
    $this->pelajaranId = $pelajaranId;
    $this->siswa = Siswa::findOrFail($siswaId); 

    $this->materi = Materi::with('absensis')->findOrFail($materiId);

    $this->rombel = Rombel::with('siswaAktif')->findOrFail($this->materi->rombel_id);

    foreach ($this->rombel->siswaAktif as $siswa) {
        $abs = $this->materi->absensis->where('siswa_id', $siswa->id)->first();
        $this->absensi[$siswa->id] = $abs->status_kehadiran ?? null;
    }
}


    public function render()
    {
        return view('livewire.superadmin.siswa.materi.absensi', [
            'title' => 'Data Absensi Mata Pelajaran',
            'materi' => $this->materi,
            'rombel' => $this->rombel,
            'absensi' => $this->absensi,
            'siswa' => $this->siswa,
            'siswaId' => request()->route('siswaId'),
            'pelajaranId' => $this->pelajaranId,
        ]);
    }
}
