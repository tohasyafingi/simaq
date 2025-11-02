<?php

namespace App\Livewire\Superadmin\Siswa\Materi;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Materi;
use App\Models\Rombel;
use App\Models\GuruPelajaran;

#[Title('Materi Pembelajaran')]
class Index extends Component
{
    public $siswaId;
    public $pelajaranId;
    public $tahun_ajaran_id;

    public function mount($siswaId, $pelajaranId)
    {
        $this->siswaId = $siswaId;
        $this->pelajaranId = $pelajaranId;

        // Default: tahun ajaran aktif
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        if ($tahunAjaranAktif) {
            $this->tahun_ajaran_id = $tahunAjaranAktif->id;
        }
    }

    public function render()
    {
        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();

        // Ambil data siswa dan rombel-nya pada tahun ajaran terpilih
        $siswa = Siswa::with('rombels')->findOrFail($this->siswaId);

        $rombel = $siswa->rombels()
            ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
            ->first();

        $materis = collect();

        if ($rombel) {
            // Ambil guru_pelajaran yang sesuai pelajaran & tahun ajaran
            $guruPelajaran = GuruPelajaran::where('pelajaran_id', $this->pelajaranId)
                ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
                ->first();

            if ($guruPelajaran) {
                $materis = Materi::where('guru_pelajaran_id', $guruPelajaran->id)
                    ->where('rombel_id', $rombel->id)
                    ->where('status', true)
                    ->orderByDesc('tanggal')
                    ->get();
            }
        }

        return view('livewire.superadmin.siswa.materi.index', [
            'title' => 'Materi Pembelajaran',
            'tahunAjarans' => $tahunAjarans,
            'siswa' => $siswa,
            'rombel' => $rombel,
            'materis' => $materis,
        ]);
    }
}
