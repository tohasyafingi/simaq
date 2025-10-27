<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Bendahara;
use App\Models\TataUsaha;
use Livewire\Attributes\Title;

#[Title('Profil')]
class ProfilShow extends Component
{
    public $userData;
    public $role;
    public $title = 'Profil Pengguna';
    public $current_password;
    public $password;
    public $password_confirmation;
    public $passwordUpdated = false;

    public function mount()
    {
        $user = Auth::user();
        $this->role = $user->role;

        switch ($this->role) {
            case 'guru':
                $this->userData = Guru::where('email', $user->email)->first() ?? $user;
                break;

            case 'bendahara':
                $this->userData = Bendahara::where('email', $user->email)->first() ?? $user;
                break;

            case 'karyawan':
                $this->userData = TataUsaha::where('email', $user->email)->first() ?? $user;
                break;

            case 'siswa':
            case 'alumni':
                $this->userData = Siswa::where('email', $user->email)->first() ?? $user;
                break;

            default:
                $this->userData = $user;
                break;
        }

        $this->userData = (object) array_merge(
            $user->toArray(), 
            $this->isEloquentModel($this->userData) ? $this->userData->toArray() : (array) $this->userData
        );
    }

    /**
     * Check if the given object is an Eloquent model
     */
    private function isEloquentModel($object)
    {
        return $object instanceof \Illuminate\Database\Eloquent\Model;
    }


    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            session()->flash('error', 'Password lama tidak sesuai.');
            return;
        }

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        $this->passwordUpdated = true;

        $this->reset(['current_password', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.profile.profil-show', [
            'title' => $this->title,
        ]);
    }
}
