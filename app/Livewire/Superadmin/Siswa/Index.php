<?php

namespace App\Livewire\Superadmin\Siswa;

use Livewire\Component;
use App\Models\Siswa;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Dashboard Siswa')]
class Index extends Component
{
    public bool $showPasswordModal = false;
    public $nama_rombel;
    public $status_siswa;
    public $jumlah_pelajaran = 0;
    public $events = [];

    public function mount()
    {
        $user = Auth::user()->name ?? 'Siswa';
        $siswa = Siswa::with(['rombels.tahunAjaran'])->find(Auth::user()->siswa_id);

        // Ambil rombel aktif
        $rombel_aktif = $siswa->rombels()->wherePivot('status', true)->first();

        $this->nama_rombel = $rombel_aktif->nama ?? 'Belum ada Rombel';
        $this->status_siswa = $siswa->status ? 'Aktif' : 'Tidak Aktif';

        if ($rombel_aktif) {
            $pelajarans = Pelajaran::where('tingkat_kelas_id', $rombel_aktif->tingkat_kelas_id)
                ->when($rombel_aktif->jurusan_id, fn($q) => $q->where('jurusan_id', $rombel_aktif->jurusan_id))
                ->where('status', true)
                ->get();

            $this->jumlah_pelajaran = $pelajarans->count();
        }

        if (auth()->check() && auth()->user()->password_changed_at === null) {
            $this->showPasswordModal = true;
        }
    }

    public function render()
    {
        return view('livewire.superadmin.siswa.index', [
            'title' => 'Dashboard Siswa',
        ]);
    }
}
