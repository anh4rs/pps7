<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ?User $user;
    // public $id;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $isActive;


    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string',
        // 'isActive' => 'required',
    ];

    // public function updated($fields)
    // {
    //     $this->validateOnly($fields, [
    //         'name' => 'required|string',
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
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->isActive = '';
    }

    public function render()
    {
        return view(
            'livewire.user.user-table',
            ['users' => User::latest()->paginate(10)]
        );
    }

    public function simpan()
    {
        $validatedData = $this->validate();
        // $validatedData['isActive'] = 0;
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'isActive' => 1,
            'password' => Hash::make($validatedData['password'])
        ]);
        session()->flash('message', 'Berhasil menambahkan data baru');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function edit(int $userId)
    {
        $user = User::find($userId);
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->isActive = false;
        } else {
            return redirect()->to('/user');
        }
    }


    public function update()
    {
        $validatedData = $this->validate();
        if ($this->userId) {
            $user = User::find($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'isActive' => $this->isActive,
            ]);
        } else {
            return redirect()->to('/user');
        }
        session()->flash('message', 'Data sukses diperbaharui');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function hapus(int $userId)
    {
        $this->userId = $userId;
    }

    public function destroy()
    {
        $user = User::find($this->userId)->delete();
        session()->flash('message', 'Data sukses dihapus');
        $this->dispatchBrowserEvent('close-modal');
    }
}
