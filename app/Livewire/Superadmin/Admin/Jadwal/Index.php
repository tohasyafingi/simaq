<?php

namespace App\Livewire\Superadmin\Admin\Jadwal;

use App\Models\Jadwal;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Jadwal Pelajaran')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    protected $queryString = ['search', 'paginate'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.superadmin.admin.jadwal.index', [
            'title' => 'Data Jadwal Pelajaran',
        ]);
    }
}
