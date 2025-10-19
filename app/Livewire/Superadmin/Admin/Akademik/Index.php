<?php

namespace App\Livewire\Superadmin\Admin\Akademik;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.akademik.index', [
            'title' => 'Data Akademik',
        ])->title('Akademik');
    }
}
