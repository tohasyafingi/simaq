<?php

namespace App\Livewire\Superadmin\Siswa\Pelajaran;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Pelajaran;
use App\Models\GuruPelajaran;
use App\Models\Materi;

#[Title('Data Mata Pelajaran')]
class Index extends Component
{
    public $siswaId;
    public $tahun_ajaran_id;

    public function mount($siswaId)
    {
        $this->siswaId = $siswaId;

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        if ($tahunAjaranAktif) {
            $this->tahun_ajaran_id = $tahunAjaranAktif->id;
        }
    }

    public function render()
    {
        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();

        $siswa = Siswa::with('rombels')->findOrFail($this->siswaId);

        $rombel = $siswa->rombels()
            ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
            ->first();

        $pelajarans = collect();

        if ($rombel) {
            $pelajarans = Pelajaran::where('tingkat_kelas_id', $rombel->tingkat_kelas_id)
                ->when($rombel->jurusan_id, fn($q) => $q->where('jurusan_id', $rombel->jurusan_id))
                ->where('status', true)
                ->get();

            foreach ($pelajarans as $pelajaran) {
                $guruPelajaran = GuruPelajaran::with('guru')
                    ->where('pelajaran_id', $pelajaran->id)
                    ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
                    ->first();

                $pelajaran->guru = $guruPelajaran?->guru?->name ?? '-';

                $guruPelajaran = GuruPelajaran::where('pelajaran_id', $pelajaran->id)
                    ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
                    ->first();

                $pelajaran->jumlah_materi = $guruPelajaran
                    ? Materi::where('guru_pelajaran_id', $guruPelajaran->id)
                    ->where('rombel_id', $rombel->id)
                    ->count()
                    : 0;
            }
        }

        return view('livewire.superadmin.siswa.pelajaran.index', [
            'title' => 'Data Mata Pelajaran',
            'siswa' => $siswa,
            'tahunAjarans' => $tahunAjarans,
            'rombel' => $rombel,
            'pelajarans' => $pelajarans,
        ]);
    }
}
