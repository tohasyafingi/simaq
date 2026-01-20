<?php

namespace App\Livewire\Superadmin\Admin\Profil;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Guru;
use App\Models\Bendahara;
use App\Models\TataUsaha;
use Livewire\Attributes\Title;

#[Title(content: 'Profil')]
class Index extends Component
{
    use WithFileUploads;

    public $tab = 'vision';

    // vision_missions
    public $vision_id;
    public $image;
    public $vision;
    public $mission;
    public $status = true;

    // histories
    public $history_id;
    public $image_h;
    public $judul;
    public $content;
    public $status_h = true;

    // struktur
    public $struktur_id;
    public $jabatan;
    public $urutan;
    public $guru_id;
    public $bendahara_id;
    public $tata_usaha_id;
    public $member_selection;
    public $status_s = true;

    public $perPage = 10;

    protected $rules = [
        'vision' => 'required_without:image|string',
        'mission' => 'required_without:image|string',
        'content' => 'required_without:image|string',
        'judul' => 'nullable|string',
        'jabatan' => 'nullable|string',
        'urutan' => 'nullable|string',
        'guru_id' => 'nullable|integer',
        'bendahara_id' => 'nullable|integer',
        'tata_usaha_id' => 'nullable|integer',
        'member_selection' => 'nullable|string',
    ];

    public function render()
    {
        $visions = DB::table('vision_missions')->orderBy('id','desc')->paginate($this->perPage);
        $histories = DB::table('histories')->orderBy('id','desc')->paginate($this->perPage);
        $strukturs = DB::table('struktur')->orderBy('urutan')->paginate($this->perPage);

        $gurus = Guru::pluck('name','id');
        $bendaharas = Bendahara::pluck('name','id');
        $tata_usahas = TataUsaha::pluck('name','id');

        return view('livewire.superadmin.admin.profil.index', compact(
            'visions','histories','strukturs','gurus','bendaharas','tata_usahas'
        ));
    }

    // Vision CRUD
    public function resetVisionForm()
    {
        $this->vision_id = null;
        $this->image = null;
        $this->vision = null;
        $this->mission = null;
        $this->status = true;
    }

    public function createVision()
    {
        $this->validate([
            'vision' => 'required|string',
            'mission' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        $filename = null;
        if ($this->image) {
            $filename = $this->image->store('profil','public');
        }

        DB::table('vision_missions')->insert([
            'image' => $filename,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'status' => (bool) $this->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message','Vision created');
        $this->resetVisionForm();
    }

    public function editVision($id)
    {
        $row = DB::table('vision_missions')->find($id);
        if (!$row) return;
        $this->vision_id = $row->id;
        $this->vision = $row->vision;
        $this->mission = $row->mission;
        $this->status = (bool) $row->status;
    }

    public function updateVision()
    {
        $this->validate([
            'vision' => 'required|string',
            'mission' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        $data = [
            'vision' => $this->vision,
            'mission' => $this->mission,
            'status' => (bool) $this->status,
            'updated_at' => now(),
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('profil','public');
        }

        DB::table('vision_missions')->where('id',$this->vision_id)->update($data);
        session()->flash('message','Vision updated');
        $this->resetVisionForm();
    }

    public function deleteVision($id)
    {
        DB::table('vision_missions')->where('id',$id)->delete();
        session()->flash('message','Vision deleted');
    }

    // History CRUD
    public function resetHistoryForm()
    {
        $this->history_id = null;
        $this->image_h = null;
        $this->judul = null;
        $this->content = null;
        $this->status_h = true;
    }

    public function createHistory()
    {
        $this->validate([
            'content' => 'required|string',
            'judul' => 'nullable|string',
            'image_h' => 'nullable|image|max:5120',
        ]);

        $filename = null;
        if ($this->image_h) {
            $filename = $this->image_h->store('profil','public');
        }

        DB::table('histories')->insert([
            'image' => $filename,
            'judul' => $this->judul,
            'content' => $this->content,
            'status' => (bool) $this->status_h,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message','History created');
        $this->resetHistoryForm();
    }

    public function editHistory($id)
    {
        $row = DB::table('histories')->find($id);
        if (!$row) return;
        $this->history_id = $row->id;
        $this->judul = $row->judul;
        $this->content = $row->content;
        $this->status_h = (bool) $row->status;
    }

    public function updateHistory()
    {
        $this->validate([
            'content' => 'required|string',
            'judul' => 'nullable|string',
            'image_h' => 'nullable|image|max:5120',
        ]);

        $data = [
            'judul' => $this->judul,
            'content' => $this->content,
            'status' => (bool) $this->status_h,
            'updated_at' => now(),
        ];

        if ($this->image_h) {
            $data['image'] = $this->image_h->store('profil','public');
        }

        DB::table('histories')->where('id',$this->history_id)->update($data);
        session()->flash('message','History updated');
        $this->resetHistoryForm();
    }

    public function deleteHistory($id)
    {
        DB::table('histories')->where('id',$id)->delete();
        session()->flash('message','History deleted');
    }

    // Struktur CRUD
    public function resetStrukturForm()
    {
        $this->struktur_id = null;
        $this->jabatan = null;
        $this->urutan = null;
        $this->guru_id = null;
        $this->bendahara_id = null;
        $this->tata_usaha_id = null;
        $this->member_selection = null;
        $this->status_s = true;
    }

    public function createStruktur()
    {
        $this->validate([
            'jabatan' => 'required|string',
            'urutan' => 'nullable|string',
        ]);

        // reset foreign keys
        $g = $b = $t = null;
        if ($this->member_selection) {
            [$type, $id] = explode(':', $this->member_selection);
            if ($type === 'guru') $g = (int) $id;
            if ($type === 'bendahara') $b = (int) $id;
            if ($type === 'tata_usaha') $t = (int) $id;
        }

        DB::table('struktur')->insert([
            'jabatan' => $this->jabatan,
            'urutan' => $this->urutan,
            'guru_id' => $g,
            'bendahara_id' => $b,
            'tata_usaha_id' => $t,
            'status' => (bool) $this->status_s,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message','Struktur created');
        $this->resetStrukturForm();
    }

    public function editStruktur($id)
    {
        $row = DB::table('struktur')->find($id);
        if (!$row) return;
        $this->struktur_id = $row->id;
        $this->jabatan = $row->jabatan;
        $this->urutan = $row->urutan;
        $this->guru_id = $row->guru_id;
        $this->bendahara_id = $row->bendahara_id;
        $this->tata_usaha_id = $row->tata_usaha_id;
        $this->status_s = (bool) $row->status;

        // set combined selection
        if ($row->guru_id) {
            $this->member_selection = 'guru:'.$row->guru_id;
        } elseif ($row->bendahara_id) {
            $this->member_selection = 'bendahara:'.$row->bendahara_id;
        } elseif ($row->tata_usaha_id) {
            $this->member_selection = 'tata_usaha:'.$row->tata_usaha_id;
        } else {
            $this->member_selection = null;
        }
    }

    public function updateStruktur()
    {
        $this->validate([
            'jabatan' => 'required|string',
            'urutan' => 'nullable|string',
        ]);

        $g = $b = $t = null;
        if ($this->member_selection) {
            [$type, $id] = explode(':', $this->member_selection);
            if ($type === 'guru') $g = (int) $id;
            if ($type === 'bendahara') $b = (int) $id;
            if ($type === 'tata_usaha') $t = (int) $id;
        }

        DB::table('struktur')->where('id',$this->struktur_id)->update([
            'jabatan' => $this->jabatan,
            'urutan' => $this->urutan,
            'guru_id' => $g,
            'bendahara_id' => $b,
            'tata_usaha_id' => $t,
            'status' => (bool) $this->status_s,
            'updated_at' => now(),
        ]);

        session()->flash('message','Struktur updated');
        $this->resetStrukturForm();
    }

    public function deleteStruktur($id)
    {
        DB::table('struktur')->where('id',$id)->delete();
        session()->flash('message','Struktur deleted');
    }
}
// <?php

// namespace App\Livewire\Superadmin\Admin\Profil;

// use Livewire\Component;
// use Livewire\Attributes\Title;

// #[Title(content: 'Profil')]
// class Index extends Component
// {
//     public function render()
//     {
//         return view('livewire.superadmin.admin.profil.index', [
//             'title' => 'Data Profil',
//         ]);
//     }
// }
