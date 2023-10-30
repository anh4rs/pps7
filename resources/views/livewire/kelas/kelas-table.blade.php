<div>
    @if (session()->has('message'))
        <h5 class="alert alert-success" role="alert">
            {{ session('message') }}
        </h5>
    @endif
    <div class="card">

        <div class="card-header">{{ __('Daftar Kelas') }} <span class="float-end"><button type="button"
                    class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambah">Tambah</button></span></div>

        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kelas</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelases as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->namaKelas }}</td>
                            <td>@livewire('kelas-status', ['model' => $item, 'field' => 'isActive'], key($item->id))</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                    wire:click="edit({{ $item->id }})" class="btn btn-primary">
                                    Edit
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalHapus"
                                    wire:click="hapus({{ $item->id }})" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Record Found</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
            <div>
                {{ $kelases->links() }}
            </div>
        </div>
    </div>

    <!-- Modal  Tambah-->
    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="simpan">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKelas" class="form-label">Nama Kelas</label>
                            <input type="text" wire:model="namaKelas" class="form-control" id="namaKelas">
                            @error('namaKelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="statusKelas" class="form-label">Status</label>
                            <input type="text" wire:model="statusKelas" class="form-control" id="statusKelas"
                                placeholder="aktif">
                            @error('statusKelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                            wire:click="closeModal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal  Edit-->
    <div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKelas" class="form-label">Nama Kelas</label>
                            <input type="text" wire:model="namaKelas" class="form-control" id="namaKelas">
                            @error('namaKelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="statusKelas" class="form-label">Status</label>
                            <input type="text" wire:model="statusKelas" class="form-control" id="statusKelas"
                                placeholder="aktif">
                            @error('statusKelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                            wire:click="closeModal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Hapus-->
    <div wire:ignore.self class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroy">
                    <div class="modal-body">
                        <h4>Apakah yakin untuk hapus data ini ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                            wire:click="closeModal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Ya!, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
