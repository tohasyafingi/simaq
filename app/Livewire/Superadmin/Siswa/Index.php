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
        $user = optional(Auth::user());
        $this->nama_rombel = 'Belum ada Rombel';
        $this->status_siswa = 'Tidak Aktif';

        $siswa = null;
        if ($user && $user->siswa_id) {
            $siswa = Siswa::with(['rombels.tahunAjaran'])->find($user->siswa_id);
        }

        // Ambil rombel aktif jika siswa ada
        $rombel_aktif = $siswa ? $siswa->rombels()->wherePivot('status', true)->first() : null;

        if ($rombel_aktif) {
            $this->nama_rombel = $rombel_aktif->nama ?? 'Belum ada Rombel';
        }

        $this->status_siswa = $siswa && isset($siswa->status) && $siswa->status ? 'Aktif' : 'Tidak Aktif';

        if ($rombel_aktif) {
            $pelajarans = Pelajaran::where('tingkat_kelas_id', $rombel_aktif->tingkat_kelas_id)
                ->when($rombel_aktif->jurusan_id, fn($q) => $q->where('jurusan_id', $rombel_aktif->jurusan_id))
                ->where('status', true)
                ->get();

            $this->jumlah_pelajaran = $pelajarans->count();
        }
        if (Auth::check() && optional(Auth::user())->password_changed_at === null) {
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
