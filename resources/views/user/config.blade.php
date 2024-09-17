@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Configuration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('includes.message')
                    <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data" aria-label="Account configuration">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                          :value="Auth::user()->name" required autofocus autocomplete="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Surname -->
                        <div class="mt-4">
                            <x-input-label for="surname" :value="__('Surname')"/>
                            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                                          :value="Auth::user()->surname" required autofocus autocomplete="surname"/>
                            <x-input-error :messages="$errors->get('surname')" class="mt-2"/>
                        </div>

                        <!-- Nickname -->
                        <div class="mt-4">
                            <x-input-label for="nick" :value="__('Nick')"/>
                            <x-text-input id="nick" class="block mt-1 w-full" type="text" name="nick"
                                          :value="Auth::user()->nick" required autofocus autocomplete="nick"/>
                            <x-input-error :messages="$errors->get('nick')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                          :value="Auth::user()->email" required autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- User Avatar -->
                        <div class="mt-4">
                            <x-input-label for="image_path" :value="__('Avatar')"/>
                            <div class="col-md-6">
                                @include('includes.avatar')
                            </div>
                            <x-text-input id="image_path" class="block mt-1 w-full" type="file" name="image_path"/>
                            <x-input-error :messages="$errors->get('image_path')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-4">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
