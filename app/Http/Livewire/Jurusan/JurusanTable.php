<?php

namespace App\Http\Livewire\Jurusan;

use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class JurusanTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ?Jurusan $jurusan;
    public $jurusanId;
    public $namaJurusan;
    public $slug;
    public $uuid;
    public $isActive;


    protected $rules = [
        'namaJurusan' => 'required|string',
        'slug' => 'required|string',
        'uuid' => 'required|string',
        // 'isActive' => 'required',
    ];

    // public function updated($fields)
    // {
    //     $this->validateOnly($fields, [
    //         'namaJurusan' => 'required|string',
    //         'isActive' => 'required',
    //     ]);
    // }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->namaJurusan = '';
        $this->slug = '';
        $this->uuid = '';
        $this->isActive = '';
    }

    public function render()
    {
        return view(
            'livewire.jurusan.jurusan-table',
            ['jurusans' => Jurusan::latest()->paginate(10)]
        )->extends('layouts.app')->section('content');
    }

    public function simpan()
    {
        $validatedData = $this->validate();
        // $validatedData['isActive'] = 0;
        Jurusan::create([
            'namaJurusan' => $validatedData['namaJurusan'],
            'slug' => $validatedData['slug'],
            'isActive' => 1,
            'uuid' =>''
        ]);
        session()->flash('message', 'Berhasil menambahkan data baru');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function edit(int $jurusanId)
    {
        $jurusan = Jurusan::find($jurusanId);
        if ($jurusan) {
            $this->userId = $jurusan->id;
            $this->namaJurusan = $jurusan->namaJurusan;
            $this->slug = $jurusan->slug;
            $this->isActive = false;
        } else {
            return redirect()->to('/user');
        }
    }


    public function update()
    {
        $validatedData = $this->validate();
        if ($this->userId) {
            $jurusan = Jurusan::find($this->userId);
            $jurusan->update([
                'namaJurusan' => $this->namaJurusan,
                'slug' => $this->slug,
                'uuid' => $this->uuid,
                'isActive' => $this->isActive,
            ]);
        } else {
            return redirect()->to('/user');
        }
        session()->flash('message', 'Data sukses diperbaharui');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function hapus(int $jurusanId)
    {
        $this->userId = $jurusanId;
    }

    public function destroy()
    {
        $jurusan = Jurusan::find($this->userId)->delete();
        session()->flash('message', 'Data sukses dihapus');
        $this->dispatchBrowserEvent('close-modal');
    }
}
