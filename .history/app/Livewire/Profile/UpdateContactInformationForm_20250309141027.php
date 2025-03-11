<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserContact;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateContactInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $user = Auth::user();

        // Initialize the state with the user's contact information
        $this->state = [
            'phone' => $user->contact->phone ?? null,
            'address' => $user->contact->address ?? null,
            'city' => $user->contact->city ?? null,
            'state' => $user->contact->state ?? null,
            'country' => $user->contact->country ?? null,
            'postal_code' => $user->contact->postal_code ?? null,
        ];
    }

    /**
     * Update the user's contact information.
     *
     * @return void
     */
    public function updateContactInformation()
    {
        $this->resetErrorBag();

        // Validate the input
        $this->validate([
            'state.phone' => ['nullable', 'string', 'max:255'],
            'state.address' => ['nullable', 'string', 'max:255'],
            'state.city' => ['nullable', 'string', 'max:255'],
            'state.state' => ['nullable', 'string', 'max:255'],
            'state.country' => ['nullable', 'string', 'max:255'],
            'state.postal_code' => ['nullable', 'string', 'max:255'],
        ]);

        // Update or create the user's contact information
        Auth::user()->contact()->updateOrCreate(
            ['user_id' => Auth::id()],
            $this->state
        );

        // Emit an event to notify the UI
        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.profile.update-contact-information-form');
    }
}
