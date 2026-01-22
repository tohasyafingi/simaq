<?php

namespace App\Livewire\Superadmin\Guru;

use Livewire\Component;
use App\Models\GuruPelajaran;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Dashboard Guru')]
class Index extends Component
{
    public bool $showPasswordModal = false;
    public $guru_id;
    public $jumlah_rombel = 0;
    public $jumlah_pelajaran = 0;
    public $status_guru = 'Aktif';
    public $events = [];

    public function mount()
    {
        $user = Auth::user();
        $this->guru_id = $user->guru_id;

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        // Ambil guru_pelajaran sesuai tahun ajaran aktif
        $guruPelajarans = GuruPelajaran::with('pelajaran')
            ->where('guru_id', $this->guru_id)
            ->when($tahunAjaranAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaranAktif->id))
            ->get();

        // Hitung pelajaran unik per rombel (kombinasi)
        $jumlahPelajaran = 0;
        $rombels = collect();

        foreach ($guruPelajarans as $gp) {
            // pastikan relasi pelajaran ada
            if (! $gp->pelajaran) {
                continue;
            }

            $rombelsForPelajaran = Rombel::where('tingkat_kelas_id', $gp->pelajaran->tingkat_kelas_id)
                ->when($gp->pelajaran->jurusan_id, fn($q) => $q->where('jurusan_id', $gp->pelajaran->jurusan_id))
                ->when($tahunAjaranAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaranAktif->id))
                ->get();

            foreach ($rombelsForPelajaran as $rombel) {
                $rombels->push($rombel);
                $jumlahPelajaran++; // Setiap kombinasi GP + Rombel dihitung
            }
        }

        $this->jumlah_pelajaran = $jumlahPelajaran;
        $this->jumlah_rombel = $rombels->unique('id')->count();

        // Status guru (guard jika relasi guru belum tersedia)
        $this->status_guru = ($user->guru && isset($user->guru->status) && $user->guru->status)
            ? 'Aktif'
            : 'Tidak Aktif';
        
        if (Auth::check() && optional(Auth::user())->password_changed_at === null) {
            $this->showPasswordModal = true;
        }
    }

    public function render()
    {
        return view('livewire.superadmin.guru.index', [
            'title' => 'Dashboard Guru',
        ]);
    }
}
