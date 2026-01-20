<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-person-fill sm-1"></i>{{ $title ?? 'Profil' }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Profil' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-1">
                                <div>
                                    <h3>Manage Profil Sekolah</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                @if (session()->has('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <button wire:click="$set('tab','vision')" class="btn btn-sm {{ $tab=='vision' ? 'btn-primary' : 'btn-secondary' }}">Vision & Mission</button>
                                <button wire:click="$set('tab','history')" class="btn btn-sm {{ $tab=='history' ? 'btn-primary' : 'btn-secondary' }}">History</button>
                                <button wire:click="$set('tab','struktur')" class="btn btn-sm {{ $tab=='struktur' ? 'btn-primary' : 'btn-secondary' }}">Struktur</button>
                            </div>

                            <!-- Vision Tab -->
                            @if($tab=='vision')
                            <div class="card p-3 mb-4">
                                <h4>Tambah / Edit Vision</h4>
                                <div class="form-group">
                                    <label>Visi</label>
                                    <input wire:model="vision" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Misi</label>
                                    <textarea wire:model="mission" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" wire:model="image" />
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @if($vision_id)
                                    <button wire:click="updateVision" class="btn btn-success btn-sm">Update</button>
                                    <button wire:click="resetVisionForm" class="btn btn-secondary btn-sm">Cancel</button>
                                    @else
                                    <button wire:click="createVision" class="btn btn-primary btn-sm">Create</button>
                                    @endif
                                </div>
                            </div>

                            <div class="card p-3">
                                <h5>List Vision & Mission</h5>
                                <table class="table table-striped">
                                    <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Visi</th>
                                            <th>Misi</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($visions as $v)
                                        <tr>
                                            <td>{{ $visions->firstItem() + $loop->index }}</td>
                                            <td>@if($v->image)<img src="{{ asset('storage/'.$v->image) }}" alt="" width="80">@endif</td>
                                            <td>{{ Str::limit($v->vision,60) }}</td>
                                            <td>{{ Str::limit($v->mission,80) }}</td>
                                            <td>{{ $v->status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <button wire:click="editVision({{ $v->id }})" class="btn btn-sm btn-info">Edit</button>
                                                <button wire:click="deleteVision({{ $v->id }})" class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $visions->links() }}
                            </div>
                            @endif

                            <!-- History Tab -->
                            @if($tab=='history')
                            <div class="card p-3 mb-4">
                                <h4>Tambah / Edit Sejarah</h4>
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input wire:model="judul" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Konten</label>
                                    <textarea wire:model="content" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" wire:model="image_h" />
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="status_h" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @if($history_id)
                                    <button wire:click="updateHistory" class="btn btn-success btn-sm">Update</button>
                                    <button wire:click="resetHistoryForm" class="btn btn-secondary btn-sm">Cancel</button>
                                    @else
                                    <button wire:click="createHistory" class="btn btn-primary btn-sm">Create</button>
                                    @endif
                                </div>
                            </div>

                            <div class="card p-3">
                                <h5>List Histories</h5>
                                <table class="table table-striped">
                                    <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Konten</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($histories as $h)
                                        <tr>
                                            <td>{{ $histories->firstItem() + $loop->index }}</td>
                                            <td>@if($h->image)<img src="{{ asset('storage/'.$h->image) }}" alt="" width="80">@endif</td>
                                            <td>{{ $h->judul }}</td>
                                            <td>{{ Str::limit($h->content,80) }}</td>
                                            <td>{{ $h->status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <button wire:click="editHistory({{ $h->id }})" class="btn btn-sm btn-info">Edit</button>
                                                <button wire:click="deleteHistory({{ $h->id }})" class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $histories->links() }}
                            </div>
                            @endif

                            <!-- Struktur Tab -->
                            @if($tab=='struktur')
                            <div class="card p-3 mb-4">
                                <h4>Tambah / Edit Struktur</h4>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input wire:model="jabatan" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Urutan</label>
                                    <input wire:model="urutan" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Nama (Guru / Bendahara / Tata Usaha)</label>
                                    <select wire:model="member_selection" class="form-control">
                                        <option value="">-- pilih nama --</option>
                                        <optgroup label="Guru">
                                            @foreach($gurus as $id=>$name)
                                                <option value="guru:{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Bendahara">
                                            @foreach($bendaharas as $id=>$name)
                                                <option value="bendahara:{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Tata Usaha">
                                            @foreach($tata_usahas as $id=>$name)
                                                <option value="tata_usaha:{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="status_s" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @if($struktur_id)
                                    <button wire:click="updateStruktur" class="btn btn-success btn-sm">Update</button>
                                    <button wire:click="resetStrukturForm" class="btn btn-secondary btn-sm">Cancel</button>
                                    @else
                                    <button wire:click="createStruktur" class="btn btn-primary btn-sm">Create</button>
                                    @endif
                                </div>
                            </div>

                            <div class="card p-3">
                                <h5>List Struktur</h5>
                                <table class="table table-striped">
                                    <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Jabatan</th>
                                            <th>Urutan</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($strukturs as $s)
                                        <tr>
                                            <td>{{ $strukturs->firstItem() + $loop->index }}</td>
                                            <td>{{ $s->jabatan }}</td>
                                            <td>{{ $s->urutan }}</td>
                                            <td>{{ $gurus[$s->guru_id] ?? $bendaharas[$s->bendahara_id] ?? $tata_usahas[$s->tata_usaha_id] ?? '' }}</td>
                                            <td>{{ $s->status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <button wire:click="editStruktur({{ $s->id }})" class="btn btn-sm btn-info">Edit</button>
                                                <button wire:click="deleteStruktur({{ $s->id }})" class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $strukturs->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>