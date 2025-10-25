<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use App\Models\Rombel;
use App\Models\Materi;

class Rekap extends Component
{
    public $guruPelajaranId;
    public $rombelId;
    public $rombel;
    public $materis;

    public function mount($guruPelajaranId, $rombelId)
    {
        $this->guruPelajaranId = $guruPelajaranId;
        $this->rombelId = $rombelId;

        // Load rombel beserta siswa aktif
        $this->rombel = Rombel::with('siswaAktif')->findOrFail($this->rombelId);

        // Load semua materi untuk guruPelajaran & rombel
        $this->materis = Materi::where('guru_pelajaran_id', $this->guruPelajaranId)
            ->where('rombel_id', $this->rombelId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.superadmin.guru.pelajaran.materi.rekap', [
            'title' => 'Rekap Absensi',
        ])->title('Rekap Absensi');
    }
}
