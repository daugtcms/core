<?php

namespace Daugt\Livewire\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;
use Daugt\Livewire\MemberArea\CoursePosts;
use Daugt\Models\User;

class EditUser extends ModalComponent
{
    public int|User $user;

    #[Rule('required')]
    public $name = '';

    #[Rule('required')]
    public $email = '';

    #[Rule('required')]
    public $full_name = '';

    public function mount(?User $user = null)
    {
        if (! $user->exists) {
            $user = Auth::user();
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->full_name = $user->full_name;
        $this->user = $user;
    }

    public function save()
    {
        if ($this->user->id != Auth::user()->id) {
            return;
        }
        $this->validate();

        if (isset($this->user->id)) {
            if ($this->user->email != $this->email) {
                $this->user->email_verified_at = null;
            }
            $this->user->update(
                $this->only(['name', 'email', 'full_name'])
            );
            $this->user->save();
        } else {
            User::create(
                $this->only(['name', 'email', 'full_name'])
            );
        }

        $this->closeModalWithEvents([
            'refreshComponent',
        ]);
    }

    public function delete($id)
    {
        User::destroy($id);

        $this->closeModalWithEvents([
            'refreshComponent',
        ]);
    }

    public function impersonate($id)
    {
        Auth::user()->impersonate(User::find($id));

        return redirect()->route('member-area.index');
    }

    public function render()
    {

        return view('daugt::livewire.users.edit-user', [

        ]);
    }
}
