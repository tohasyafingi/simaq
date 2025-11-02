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

        // Fetch user data based on role, and ensure it's always loaded
        $this->userData = $this->getUserDataByRole($user);
        $this->mergeUserData($user);
    }

    /**
     * Get user data based on their role.
     */
    private function getUserDataByRole($user)
    {
        $roleModelMapping = [
            'guru' => Guru::class,
            'bendahara' => Bendahara::class,
            'karyawan' => TataUsaha::class,
            'siswa' => Siswa::class,
            'alumni' => Siswa::class, // Assuming alumni is also part of the Siswa model
        ];

        $modelClass = $roleModelMapping[$this->role] ?? User::class; // Default to User model

        return $modelClass::where('email', $user->email)->first() ?? $user;
    }

    /**
     * Merge the user's data with role-specific model data.
     */
    private function mergeUserData($user)
    {
        $this->userData = (object) array_merge(
            $user->toArray(), 
            $this->isEloquentModel($this->userData) ? $this->userData->toArray() : (array) $this->userData
        );
    }

    /**
     * Check if the given object is an Eloquent model.
     */
    private function isEloquentModel($object)
    {
        return $object instanceof \Illuminate\Database\Eloquent\Model;
    }

    /**
     * Update the user's password.
     */
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Check if current password matches the one stored in the database
        if (!Hash::check($this->current_password, Auth::user()->password)) {
            session()->flash('error', 'Password lama tidak sesuai.');
            return;
        }

        // Update password in the database
        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        // Set success state
        $this->passwordUpdated = true;

        // Clear password fields
        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('message', 'Password berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.profile.profil-show', [
            'title' => $this->title,
        ]);
    }
}
