@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @livewire('kelas.kelas-table')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#modalTambah').modal('hide');
            $('#modalEdit').modal('hide');
            $('#modalHapus').modal('hide');
        })
    </script>
@endsection
