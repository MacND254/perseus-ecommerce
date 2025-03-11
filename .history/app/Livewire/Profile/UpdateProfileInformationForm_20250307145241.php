<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateProfileInformationForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = Auth::user()->only(['name', 'email', 'phone', 'address']);
    }

    public function updateProfileInformation()
    {
        $this->resetErrorBag();

        \Log::info('Updating user profile with:', $this->state);

        app(UpdatesUserProfileInformation::class)->update(Auth::user(), $this->state);

        $this->emit('saved');
    }

    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}
