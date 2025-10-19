<?php

namespace App\Livewire\Superadmin\Admin\EBook;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.e-book.index', [
            'title' => 'Data E-Book',
        ])->title('E-Book');
    }
}
