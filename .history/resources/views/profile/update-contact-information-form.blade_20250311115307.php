<x-form-section submit="updateUserContactInformation">
    <x-slot name="title">
        {{ __('Contact Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your contact details such as phone number, address, and location.') }}

        <div class="p-4 bg-gray-800 rounded-lg text-white">
            <h3 class="text-lg font-semibold mb-2">{{ __('Saved Contact Information') }}</h3>

            <p><strong>{{ __('Phone:') }}</strong> <span>{{ $state['phone'] }}</span></p>
            <p><strong>{{ __('Address:') }}</strong> <span>{{ $state['address'] }}</span></p>
            <p><strong>{{ __('City:') }}</strong> <span>{{ $state['city'] }}</span></p>
            <p><strong>{{ __('State:') }}</strong> <span>{{ $state['state'] }}</span></p>
            <p><strong>{{ __('Country:') }}</strong> <span>{{ $state['country'] }}</span></p>
            <p><strong>{{ __('Postal Code:') }}</strong> <span>{{ $state['postal_code'] }}</span></p>
        </div>

        @if (session()->has('message'))
            <div class="p-4 mt-4 bg-green-500 text-white rounded">
                {{ session('message') }}
            </div>
        @endif
    </x-slot>


    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" required autocomplete="tel" />
            <x-input-error for="state.phone" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" required autocomplete="street-address" />
            <x-input-error for="state.address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="city" value="{{ __('City') }}" />
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" required />
            <x-input-error for="state.city" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="state" value="{{ __('State') }}" />
            <x-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="state.state" required />
            <x-input-error for="state.state" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="country" value="{{ __('Country') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model.defer="state.country" required />
            <x-input-error for="state.country" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="postal_code" value="{{ __('Postal Code') }}" />
            <x-input id="postal_code" type="text" class="mt-1 block w-full" wire:model.defer="state.postal_code" required />
            <x-input-error for="state.postal_code" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        @if (session()->has('message'))
        <x-action-message class="me-3" wire:target="updateUserContactInformation" wire:loading>
            {{ __('Saved.') }}
        </x-action-message>

        @endif

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
