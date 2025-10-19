<?php

namespace App\Livewire\Superadmin\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $paginate = '10';
    public $search = '';

    // Form fields
    public $user_id, $name, $email, $password, $role, $status, $img, $password_confirmation;


    public $deleteId = null;

protected function rules()
{
    return [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $this->user_id,
        'password' => $this->user_id ? 'nullable|string|min:6|confirmed' : 'required|string|min:6|confirmed',
        'password_confirmation' => $this->user_id ? 'nullable' : 'required',
        'role' => 'required|string',
        'status' => 'required|boolean',
        'img' => 'nullable|image|max:2048',
    ];
}

    public function render()
    {
        $data = [
            'title' => 'Data User',
            'user' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy('name', 'asc')->paginate($this->paginate),
        ];
        return view('livewire.superadmin.admin.user.index', $data)->title('Manajemen User');
    }

    public function resetInputFields()
    {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->status = '';
        $this->img = null;
    }

    public function create()
    {
        $this->resetInputFields();
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->img) {
            $validatedData['img'] = $this->img->store('users', 'public');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'User berhasil ditambahkan.');
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
    }

    public function update()
    {
        $validatedData = $this->validate();

        $user = User::findOrFail($this->user_id);

        if ($this->img) {
            if ($user->img && \Storage::disk('public')->exists($user->img)) {
                \Storage::disk('public')->delete($user->img);
            }
            $validatedData['img'] = $this->img->store('users', 'public');
        } else {
            $validatedData['img'] = $user->img;
        }

        if ($validatedData['password']) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        $this->dispatch('closeEditModal');
        session()->flash('message', 'User berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $user = User::findOrFail($this->deleteId);

        if ($user->img && \Storage::disk('public')->exists($user->img)) {
            \Storage::disk('public')->delete($user->img);
        }

        $user->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'User berhasil dihapus.');
        $this->deleteId = null;
    }
}
