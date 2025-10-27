<?php

namespace App\Livewire\Superadmin\Admin\Ppdb;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('PPDB')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.ppdb.index', [
            'title' => 'Data PPDB',
        ]);
    }
}
