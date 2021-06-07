<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('messages.Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('messages.Email') }}" />
                <x-input-email id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                :domains="'('.implode('|',config('misc.valid_register_domains',[''])).')'" />
                {{-- <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required /> --}}
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('messages.Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('messages.password_confirmation') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {{-- FIXME: Cómo se guardaría esto en lang/es/messages.php ? --}}
                                {!! __('Acepto los :términos_del_servicio y la :política_de_privacidad', [
                                        'términos_del_servicio' => '<a target="_blank" href="'.route('terms_es.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Términos del servicio').'</a>',
                                        'política_de_privacidad' => '<a target="_blank" href="'.route('policy_es.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Política de privacidad').'</a>',
                                ]) !!}
{{--                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                            ]) !!}--}}
                        </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('messages.already_registered') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('messages.Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
