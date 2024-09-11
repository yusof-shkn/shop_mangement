<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="text-center text-white fs-3">Registeration</div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="dropdown mb-5">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" style="background-color:#2243B6;color:white " data-bs-toggle="dropdown" aria-expanded="false">
                    Admin
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{url('/registration/service_manager')}}">Service Manager</a>
                  <a class="dropdown-item" href="{{url('/registration/inventory_manager')}}">Inventory Manager</a>
                </div>
            </div>
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4 adminsInput" >
                <x-label for="username" value="{{ __('Username ') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" autocomplete="username" />
            </div>
            <div class="mt-4 adminsInput">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
            </div>
            
            <div class="mt-4 d-flex">
                <div class="">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <input type="hidden" name="validate" value="7as9dbj8708aej">
                </div>
                <div class="ml-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>





