<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $user;

    public function showUserModal($user = null)
    {
        $this->resetValidation();
        if(!$user){
            $user['active'] = 1;
        }
        $this->user = $user;
    }

    public function save_user()
    {
        if (isset($this->user['id'])) {
            //edit
            $this->validate([
                'user.username'  => ['required', 'unique:users,username,'. $this->user['id']],
                'user.name'      => ['required'],
                'user.email'     => ['nullable', 'email'],
                'user.active'    => ['nullable'],
                'user.type'      => ['nullable'],
            ]);
            $currentUser = User::find($this->user['id']);
            $currentUser->update([
                'username' => $this->user['username'],
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'active' => $this->user['active'],
                'type' => $this->user['type'],
            ]);
            if (isset($this->user['password'])) {
                $currentUser->update([
                    'password' => bcrypt($this->user['password']),
                ]);
            }

        } else {
            //create
            $this->validate([
                'user.username'  => ['required', 'unique:users,username'],
                'user.name'      => ['required'],
                'user.password'  => ['required'],
                'user.email'     => ['nullable', 'email'],
                'user.active'    => ['nullable'],
                'user.type'      => ['nullable'],
            ]);
            $this->user['password'] = bcrypt($this->user['password']);
            User::create($this->user);
        }
        $this->reset('user');
        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete_user(User $user)
    {
        $user->delete();
    }

    public function render()
    {
        $users = User::paginate();
        return view('livewire.users.users-index',[
            'users' => $users,
        ])->layout('layouts.livewire_app');
    }
}
