<x-form-section submit="updateContactInformation">
    <x-slot name="title">
        {{ __('Contact Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s contact information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model="state.phone" autocomplete="phone" />
            <x-input-error for="state.phone" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model="state.address" autocomplete="address" />
            <x-input-error for="state.address" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="city" value="{{ __('City') }}" />
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model="state.city" autocomplete="city" />
            <x-input-error for="state.city" class="mt-2" />
        </div>

        <!-- State -->
        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="state" value="{{ __('State') }}" />
            <x-input id="state" type="text" class="mt-1 block w-full" wire:model="state.state" autocomplete="state" />
            <x-input-error for="state.state" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="country" value="{{ __('Country') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model="state.country" autocomplete="country" />
            <x-input-error for="state.country" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="postal_code" value="{{ __('Postal Code') }}" />
            <x-input id="postal_code" type="text" class="mt-1 block w-full" wire:model="state.postal_code" autocomplete="postal_code" />
            <x-input-error for="state.postal_code" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
