@extends('layouts.users')

@section('title', 'Edit profile')

@section('content')
    <div class="flex justify-between">
        <div class="w-3/4 mr-10">
            <h1 class="text-4xl font-bold text-gray-700">Edit Profile</h1>

            <hr class="border-t border-gray-300 mt-3 mb-6">

            <form method="POST" action="{{ route('users.update', ['user' => auth()->user()]) }}" class="mx-auto">
                @method('PUT')
                @csrf

                <div class="mt-2 mb-4 flex">
                    <x-label for="name" :value="__('Name:')" class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4">
                        <x-input id="name" class="w-full border px-2 py-1" type="text" name="name"
                            :value="old('name') ?? auth()->user()->name" autofocus />

                        <x-form-error field="name" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="username" :value="__('Username:')"
                        class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4">
                        <x-input id="username" class="w-full border px-2 py-1" type="text" name="username"
                            :value="old('username') ?? auth()->user()->username" />

                        <x-form-error field="username" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="email" :value="__('Email:')" class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4">
                        <x-input id="email" class="w-full border px-2 py-1" type="email" name="email"
                            :value="old('email') ?? auth()->user()->email" />

                        <x-form-error field="email" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="tagline" :value="__('Tagline:')" class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4">
                        <x-input id="tagline" class="w-full border px-2 py-1" type="text" name="tagline"
                            :value="old('tagline') ?? auth()->user()->tagline" />

                        <x-form-error field="tagline" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="sex" :value="__('Sex:')" class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4 flex items-center">
                        <x-radio name="sex" value="male" :checked="old('sex') == 'male' || auth()->user()->sex == 'male'">
                            Male
                        </x-radio>
                        <x-radio name="sex" value="female"
                            :checked="old('sex') == 'female' || auth()->user()->sex == 'female'">Female
                        </x-radio>
                        <x-radio name="sex" value="other"
                            :checked="old('sex') == 'other' || auth()->user()->sex == 'other'">Other
                        </x-radio>

                        <x-form-error field="sex" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="birthdate" :value="__('Birthdate:')"
                        class="w-1/4 relative pt-1 mr-5 text-base text-right" />
                    <div class="w-2/4">
                        <x-input id="birthdate" class="w-full border px-2 py-1" type="date" name="birthdate"
                            :value="old('birthdate') ?? auth()->user()->birthdate?->format('Y-m-d')" />

                        <x-form-error field="birthdate" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="country" :value="__('Country:')" class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4">
                        <x-select id="country" name="country" :options="$countries"
                            :selected="old('country') ?? auth()->user()->country" />

                        <x-form-error field="country" />
                    </div>
                </div>

                <div class="mt-2 mb-4 flex">
                    <x-label for="about" :value="__('About Me:')" class="w-1/4 relative pt-1 mr-5 text-base text-right" />

                    <div class="w-2/4">
                        <x-textarea name="about" id="about" class="w-full" rows="5">
                            {{ old('about') ?? auth()->user()->about }}
                        </x-textarea>

                        <x-form-error field="about" />
                    </div>
                </div>

                <hr class="border-t border-gray-300 mt-8 my-5">

                <div class="flex justify-between">
                    @if (session('message'))
                        <x-form-message />
                    @endif

                    @error('avatar')
                        <div class="flex items-center justify-between bg-red-600 my-2 py-1 pl-3 pr-2 text-white"
                            x-data="{ show: true }" x-show="show">
                            {{ $message }}

                            <span @click="show = false" class="ml-3 cursor-pointer">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </span>
                        </div>
                    @enderror

                    <x-button class="ml-auto">{{ __('Save Changes') }}</x-button>
                </div>
            </form>
        </div>

        <div class="w-1/4">
            <div class="mt-5 p-1 border border-gray-300">
                <img src="{{ auth()->user()->getAvatarUrl('thumb') }}" alt="" class="mx-auto w-full">
            </div>

            <button x-data @click="$dispatch('open-avatar-modal')"
                class="block mx-auto mt-2 w-full py-2 border border-gray-300 bg-gray-200 hover:bg-gray-300 text-black">
                <i class="fa fa-camera mr-1" aria-hidden="true"></i>
                Change Photo
            </button>
        </div>
    </div>
@endsection

@push('overlays')
    @include('overlays.upload-avatar')
@endpush
