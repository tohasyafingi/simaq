<?php

namespace App\Livewire\Superadmin\Admin\Ppdb;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.ppdb.index', [
            'title' => 'Data PPDB',
        ])->title('Akademik');
    }
}
