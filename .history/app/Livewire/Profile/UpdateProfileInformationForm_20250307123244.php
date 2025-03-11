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
    $user = Auth::user();

    $this->validate([
        'state.name' => ['nullable', 'string', 'max:255'],
        'state.email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'state.phone' => ['nullable', 'string', 'max:20'],
        'state.address' => ['nullable', 'string', 'max:255'],
    ]);

    $user->update(array_filter([
        'name' => $this->state['name'] ?? $user->name,
        'email' => $this->state['email'] ?? $user->email,
        'phone' => $this->state['phone'] ?? $user->phone,
        'address' => $this->state['address'] ?? $user->address,
    ]));

    $this->emit('saved');
}

}
