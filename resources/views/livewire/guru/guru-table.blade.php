<div>
    <div class="container">
        @if (session()->has('message'))
            <h5 class="alert alert-success" role="alert">
                {{ session('message') }}
            </h5>
        @endif
        <div class="card">

            <div class="card-header"><b>{{ __('Daftar Guru') }}</b> <span class="float-end"><button type="button"
                        class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">Tambah</button></span></div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Guru</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurues as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->namaGuru }}</td>
                                <td>@livewire('tombol-status', ['model' => $item, 'field' => 'isActive'], key($item->id))</td>
                                <td>
                                    <span data-bs-toggle="tooltip" data-placement="bottom" title="Edit Data"><button
                                            type="button" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            wire:click="edit({{ $item->id }})" class="btn btn-primary"
                                            role="button">
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
                        {{-- @endforeach --}}


                    </tbody>
                </table>
                <div>
                    {{ $gurues->links() }}
                </div>
            </div>
        </div>
        @include('livewire.guru.guru-modal')
    </div>
</div>
