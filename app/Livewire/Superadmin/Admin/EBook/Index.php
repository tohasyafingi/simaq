<?php

namespace App\Livewire\Superadmin\Admin\EBook;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('E-Book')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.e-book.index', [
            'title' => 'Data E-Book',
        ]);
    }
}
