<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.guru.pelajaran.index', [
            'title' => 'Data Pelajaran',
        ])->title('Data Pelajaran');
    }
}
