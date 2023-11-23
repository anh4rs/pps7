<?php

namespace App\Http\Livewire\Kelas;

use App\Models\Kelas;
use Livewire\Component;
use Livewire\WithPagination;

class KelasTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ?Kelas $kelas;
    // public $id;
    public $kelasId;
    public $namaKelas;
    public $isActive;


    protected $rules = [
        'namaKelas' => 'required|string',
        'isActive' => 'required',
    ];

    // public function updated($fields)
    // {
    //     $this->validateOnly($fields, [
    //         'namaKelas' => 'required|string',
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
        $this->namaKelas = '';
        $this->isActive = '';
    }

    public function render()
    {
        return view(
            'livewire.kelas.kelas-table',
            ['kelases' => Kelas::latest()->paginate(10)]
        );
    }

    public function simpan()
    {
        // $validatedData = $this->validate();
        $validatedData['namaKelas'] = $this->namaKelas;
        $validatedData['isActive'] = true;
        Kelas::create($validatedData);
        session()->flash('message', 'Berhasil menambahkan data baru');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function edit(int $kelasId)
    {
        $kelas = Kelas::find($kelasId);
        if ($kelas) {
            $this->kelasId = $kelas->id;
            $this->namaKelas = $kelas->namaKelas;
            $this->isActive = false;
        } else {
            return redirect()->to('/home');
        }
    }


    public function update()
    {
        $validatedData = $this->validate();
        if ($this->kelasId) {
            $kelas = Kelas::find($this->kelasId);
            $kelas->update([
                'namaKelas' => $this->namaKelas,
                'isActive' => $this->isActive,
            ]);
        } else {
            return redirect()->to('/home');
        }
        session()->flash('message', 'Data sukses diperbaharui');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function hapus(int $kelasId)
    {
        $this->kelasId = $kelasId;
    }

    public function destroy()
    {
        $kelas = Kelas::find($this->kelasId)->delete();
        session()->flash('message', 'Data sukses dihapus');
        $this->dispatchBrowserEvent('close-modal');
    }
}
