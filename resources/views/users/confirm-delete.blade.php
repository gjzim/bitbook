@extends('layouts.users')

@section('content')
    <div class="">
        <h1 class="text-4xl font-bold text-gray-700">Delete Profile </h1>

        <hr class="border-t border-gray-300 mt-3 mb-6">

        <p class="text-lg">This action is irreversible. Please confirm again if you really want to delete your account
            forever.</p>

        <hr class="border-t border-gray-300 my-6">

        <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}" class="mt-5">
            @method('DELETE')
            @csrf

            <div class="flex items-center">
                <a href="#" class="text-blue-500 ml-auto mr-3">Cancel</a>

                <x-button variant="error">{{ __('Confirm') }}</x-button>
            </div>
        </form>
    </div>
@endsection
