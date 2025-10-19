<?php

namespace App\Livewire\Superadmin\Admin\Kesiswaan;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.kesiswaan.index', [
            'title' => 'Data Kesiswaan',
        ])->title('Akademik');
    }
}
