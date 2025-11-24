<?php

namespace App\Livewire\Superadmin\Admin;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Bendahara;
use App\Models\GuruPelajaran;
use App\Models\TataUsaha;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Rombel;
use App\Models\RuangKelas;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Dashboard Admin')]
class Index extends Component
{
    public $nama_admin;
    public $jumlah_guru;
    public $jumlah_bendahara;
    public $jumlah_tu;
    public $jumlah_siswa;
    public $tahun_ajaran;
    public $jumlah_jurusan;
    public $jumlah_rombel;
    public $jumlah_ruang_kelas;
    public $jumlah_pengajar;

    public $calendarEvents = [];

    public function mount()
    {
        $this->nama_admin = Auth::user()->name ?? 'Admin';

        $this->jumlah_guru = Guru::count();
        $this->jumlah_bendahara = Bendahara::count();
        $this->jumlah_tu = TataUsaha::count();
        $this->jumlah_siswa = Siswa::count();
        $this->jumlah_jurusan = Jurusan::count();
        $this->jumlah_rombel = Rombel::count();
        $this->jumlah_ruang_kelas = RuangKelas::count();
        $this->jumlah_pengajar = GuruPelajaran::count();

        // Perbaiki query status (asumsikan boolean, bukan string)
        $aktif = TahunAjaran::where('status', true)->first();
        $this->tahun_ajaran = $aktif
            ? $aktif->tahun . ' ' . $aktif->semester
            : 'Belum ada Tahun Ajaran Aktif';
    }

    public function render()
    {
        return view('livewire.superadmin.admin.index', [
            'title' => 'Dashboard Admin'
        ]);
    }
}
