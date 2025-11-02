<div>
    <!-- Buttons for Export -->
    <button wire:click="exportSiswa" class="btn btn-success">Export Siswa</button>
    <button wire:click="exportGuru" class="btn btn-success">Export Guru</button>
    <button wire:click="exportBendahara" class="btn btn-success">Export Bendahara</button>
    <button wire:click="exportTataUsaha" class="btn btn-success">Export Tata Usaha</button>

    <!-- Buttons for Import -->
    <input type="file" wire:model="fileSiswa" wire:change="importSiswa($event.target.files[0])">
    <input type="file" wire:model="fileGuru" wire:change="importGuru($event.target.files[0])">
    <input type="file" wire:model="fileBendahara" wire:change="importBendahara($event.target.files[0])">
    <input type="file" wire:model="fileTataUsaha" wire:change="importTataUsaha($event.target.files[0])">
</div>
