<?php

namespace App\Livewire\Superadmin\Admin\Download;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.download.index', [
            'title' => 'Data Download',
        ])->title('Download');
    }
}
