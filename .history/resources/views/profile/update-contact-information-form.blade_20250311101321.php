<x-form-section submit="updateContactInformation">
    <x-slot name="title">
        {{ __('Contact Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your contact details, including phone number and address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="tel" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" autocomplete="street-address" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="city" value="{{ __('City') }}" />
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" autocomplete="address-level2" />
            <x-input-error for="city" class="mt-2" />
        </div>

        <!-- State -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="state" value="{{ __('State') }}" />
            <x-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="state.state" autocomplete="address-level1" />
            <x-input-error for="state" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="country" value="{{ __('Country') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model.defer="state.country" autocomplete="country-name" />
            <x-input-error for="country" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="postal_code" value="{{ __('Postal Code') }}" />
            <x-input id="postal_code" type="text" class="mt-1 block w-full" wire:model.defer="state.postal_code" autocomplete="postal-code" />
            <x-input-error for="postal_code" class="mt-2" />
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
