<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Laravel\Jetstream\Jetstream;

class UpdateProfileInformationForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = auth()->user()->only(['name', 'email', 'phone', 'address']);
    }

    public function updateProfileInformation()
    {
        $this->resetErrorBag();

        $validatedData = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(auth()->id())],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ])->validate();

        auth()->user()->update($validatedData);

        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
