@extends('layouts.users')

@section('title', 'Change password')

@section('content')
    <div>
        <h1 class="text-4xl font-bold text-gray-700">Change Password </h1>

        <hr class="border-t border-gray-300 mt-3 mb-6">

        <form method="POST" action="{{ route('users.update.password', ['user' => $user]) }}" class="mt-5">
            @csrf

            <div class="mt-2 mb-4 flex">
                <x-label for="password" :value="__('Current Password:')"
                    class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                <div class="w-2/4">
                    <x-input id="password" class="w-full border px-2 py-1" type="password" name="password" required
                        autofocus />

                    <x-form-error field="password" />
                </div>
            </div>

            <div class="mt-2 mb-4 flex">
                <x-label for="new_password" :value="__('New Password:')"
                    class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                <div class="w-2/4">
                    <x-input id="new_password" class="w-full border px-2 py-1" type="password" name="new_password"
                        required />

                    <x-form-error field="new_password" />
                </div>
            </div>


            <div class="mt-2 mb-4 flex">
                <x-label for="new_password_confirmation" :value="__('Confirm New Password:')"
                    class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                <div class="w-2/4">
                    <x-input id="new_password_confirmation" class="w-full border px-2 py-1" type="password"
                        name="new_password_confirmation" required />

                    <x-form-error field="new_password_confirmation" />
                </div>
            </div>

            <hr class="border-t border-gray-300 mt-8 my-5">

            <div class="flex justify-between">
                @if (session('message'))
                    <x-form-message />
                @endif

                <x-button class="ml-auto">{{ __('Update') }}</x-button>
            </div>
        </form>
    </div>
@endsection
