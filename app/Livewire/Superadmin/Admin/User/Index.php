<?php

namespace App\Livewire\Superadmin\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Helpers\ImageHelper;

#[Title('Manajemen User')]  
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = '';
    public $user_id, $name, $email, $password, $role, $status, $img, $password_confirmation;
    public $old_img;
    public $deleteId = null;

    // Validation rules
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => $this->user_id ? 'nullable|string|min:6|confirmed' : 'required|string|min:6|confirmed',
            'password_confirmation' => $this->user_id ? 'nullable' : 'required',
            'role' => 'required|string|max:50',
            'status' => 'required|boolean',
            'img' => 'nullable|file|mimes:webp,jpg,jpeg,png,avif,svg,gif|max:5120', // Image validation (5MB)
        ];
    }

    public function render()
    {
        // Fetch users with search functionality
        $users = User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.user.index', [
            'title' => 'Data User',  
            'user' => $users,
        ]);
    }

    public function resetInputFields()
    {
        // Reset input fields to default state
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->status = '';
        $this->img = null;
        $this->old_img = null;
    }

    public function create()
    {
        $this->resetInputFields();
    }

    public function store()
    {
        $validatedData = $this->validate();

        // Handle image upload
        if ($this->img) {
            $validatedData['img'] = ImageHelper::storeOptimized(
                $this->img,
                'users',
                $validatedData['name'] ?? $this->name,
                'public'
            );
        }

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create new user
        User::create($validatedData);

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'User "' . $this->name . '" berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->img = null;
        $this->old_img = $user->img;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $user = User::findOrFail($this->user_id);

        // Handle image upload safely: only call ->store() on uploaded files
        if (is_object($this->img) && method_exists($this->img, 'store')) {
            $validatedData['img'] = ImageHelper::replaceOptimized(
                $user->img,
                $this->img,
                'users',
                $validatedData['name'] ?? $this->name,
                'public'
            );
        } else {
            // no new upload; keep existing path
            $validatedData['img'] = $user->img;
        }

        // If password is provided, hash it
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // Update user
        $user->update($validatedData);

        $this->dispatch('closeEditModal');
        session()->flash('message', 'User "' . $user->name . '" berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $user = User::findOrFail($this->deleteId);

        // Delete user's image if it exists
        if ($user->img) {
            ImageHelper::deletePath($user->img, 'public');
        }

        // Delete user record
        $user->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'User "' . $user->name . '" berhasil dihapus.');
        $this->deleteId = null;
    }
}
