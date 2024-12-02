<?php

namespace Daugt\Livewire\Users;

use Daugt\Helpers\Media\MediaHelper;
use Daugt\Jobs\Media\SaveUploadedFile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Daugt\Livewire\MemberArea\CoursePosts;
use Daugt\Models\User;

class EditUser extends ModalComponent
{
    use WithFileUploads;

    public int|User $user;

    #[Validate('nullable', 'image|max:10240')]
    public $photo;

    #[Rule('required')]
    public $name = '';

    #[Rule('required', 'unique:users')]
    public $email = '';

    #[Rule('required')]
    public $full_name = '';

    public function mount(?User $user = null)
    {
        if (! $user->exists || !Auth::user()->can('edit users')) {
            $user = Auth::user();
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->full_name = $user->full_name;
        $this->user = $user;
    }

    public function save()
    {
        if ($this->user->id != Auth::user()->id && !Auth::user()->can('edit users')) {
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

        if (isset($this->photo)) {
            // remove current avatar
            if ($this->user->avatar()) {
                $this->user->avatar()->getAllVariants()->each(function ($variant) {
                    $variant->delete();
                });
                $this->user->avatar()->delete();
            }
            SaveUploadedFile::dispatch($this->photo->getRealPath(), pathinfo($this->photo->getClientOriginalName(), PATHINFO_FILENAME), true, $this->user, 'avatar');
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

        return redirect()->route('daugt.member-area.index');
    }

    public function render()
    {

        return view('daugt::livewire.users.edit-user', [

        ]);
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
