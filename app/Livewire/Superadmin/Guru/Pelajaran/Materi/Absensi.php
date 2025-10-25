<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use App\Models\Rombel;
use App\Models\Absensi as AbsensiModel;
use App\Models\Materi;

class Absensi extends Component
{
    public $materiId;
    public $rombelId;
    public $guruPelajaranId;
    public $absensi = [];
    public $materi;

    public function mount($materiId, $rombelId, $guruPelajaranId)
    {
        $this->materiId = $materiId;
        $this->rombelId = $rombelId;
        $this->guruPelajaranId = $guruPelajaranId;

        $rombel = Rombel::with('siswaAktif')->find($this->rombelId);
        $this->materi = Materi::find($this->materiId);

        if ($rombel) {
            foreach ($rombel->siswaAktif as $siswa) {
                $absensi = AbsensiModel::firstOrNew([
                    'materi_id' => $this->materiId,
                    'siswa_id' => $siswa->id,
                ]);

                $this->absensi[$siswa->id] = $absensi->status_kehadiran ?? null;
            }
        }
    }

    /**
     * Set status absensi per siswa
     */
    public function setAbsensi($siswaId, $status)
    {
        $absensi = AbsensiModel::firstOrNew([
            'materi_id' => $this->materiId,
            'siswa_id' => $siswaId,
        ]);

        $absensi->status_kehadiran = $status;
        $absensi->status = true;
        $absensi->save();

        $this->absensi[$siswaId] = $status;
    }

    public function render()
    {
        $rombel = Rombel::with('siswaAktif')->findOrFail($this->rombelId);

        return view('livewire.superadmin.guru.pelajaran.materi.absensi', [
            'rombel' => $rombel,
            'title' => 'Absensi Siswa',
        ])->title('Absensi Siswa');
    }
}
