<?php

namespace Sitebrew\Livewire\Users;

use Sitebrew\Livewire\Navigation\NavigationEditor;
use Sitebrew\Models\Navigation\Navigation;
use Livewire\Attributes\Rule;
use Sitebrew\Models\User;
use WireElements\Pro\Components\Modal\Modal;

class EditUser extends Modal
{
    public int|User $user;

    #[Rule('required')]
    public $name = '';

    #[Rule('required')]
    public $email = '';

    #[Rule('required')]
    public $full_name = '';

    public function mount(User $user = null)
    {
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->full_name = $user->full_name;
            $this->user = $user;
        }
    }

    public function save()
    {
        $this->validate();

        if (isset($this->user)) {
            $this->user->update(
                $this->only(['name', 'email', 'full_name'])
            );
            $this->user->save();
        } else {
            User::create(
                $this->only(['name', 'email', 'full_name'])
            );
        }

        $this->close(andDispatch: [
            UserTable::class => 'refreshComponent',
        ]);
    }

    public function delete($id) {
        User::destroy($id);

        $this->close(andDispatch: [
            UserTable::class => 'refreshComponent',
        ]);
    }

    public function render()
    {

        return view('sitebrew::livewire.users.edit-user', [

        ]);
    }
}
