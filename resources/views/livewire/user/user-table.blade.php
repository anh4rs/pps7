<div>
    @if (session()->has('message'))
        <h5 class="alert alert-success" role="alert">
            {{ session('message') }}
        </h5>
    @endif
    <div class="card">

        <div class="card-header">{{ __('Daftar User') }} <span class="float-end"><button type="button"
                    class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambah">Tambah</button></span></div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>@livewire('tombol-status', ['model' => $item, 'field' => 'isActive'], key($item->id))</td>
                            <td>
                                <span data-bs-toggle="tooltip" data-placement="bottom" title="Edit Data"><button
                                        type="button" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                        wire:click="edit({{ $item->id }})" class="btn btn-primary" role="button">
                                        Edit
                                    </button>
                                </span>
                                <span data-bs-toggle="tooltip" data-placement="bottom" title="Hapus Data"><button
                                        type="button" data-bs-toggle="modal" data-bs-target="#modalHapus"
                                        wire:click="hapus({{ $item->id }})" class="btn btn-danger">
                                        Delete
                                    </button>
                                </span>
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @include('livewire.user.user-modal')
</div>
