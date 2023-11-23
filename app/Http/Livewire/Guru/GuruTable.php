<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class GuruTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ?Guru $gurus;
    public $guruId;
    public $namaGuru;
    public $slug;
    public $uuid;
    public $isActive;


    protected $rules = [
        'namaGuru' => 'required|string',
        'slug' => 'required|string',
        'uuid' => 'required|string',
        // 'isActive' => 'required',
    ];

    // public function updated($fields)
    // {
    //     $this->validateOnly($fields, [
    //         'namaGuru' => 'required|string',
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
        $this->namaGuru = '';
        $this->slug = '';
        $this->uuid = '';
        $this->isActive = '';
    }

    public function render()
    {
        return view(
            'livewire.guru.guru-table',
            ['gurues' => Guru::Latest()->paginate(10)]
        )->extends('layouts.app')->section('content');
    }

    public function simpan()
    {
        $validatedData = $this->validate();
        // $validatedData['isActive'] = 0;
        Guru::create([
            'namaGuru' => $validatedData['namaGuru'],
            'slug' => $validatedData['slug'],
            'isActive' => 1,
            'uuid' =>''
        ]);
        session()->flash('message', 'Berhasil menambahkan data baru');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function edit(int $guruId)
    {
        $guru = Guru::find($guruId);
        if ($guru) {
            $this->userId = $guru->id;
            $this->namaGuru = $guru->namaGuru;
            $this->slug = $guru->slug;
            $this->isActive = false;
        } else {
            return redirect()->to('/guru');
        }
    }


    public function update()
    {
        $validatedData = $this->validate();
        if ($this->userId) {
            $guru = Guru::find($this->userId);
            $guru->update([
                'namaGuru' => $this->namaGuru,
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

    public function hapus(int $guruId)
    {
        $this->userId = $guruId;
    }

    public function destroy()
    {
        $guru = Guru::find($this->userId)->delete();
        session()->flash('message', 'Data sukses dihapus');
        $this->dispatchBrowserEvent('close-modal');
    }
}
