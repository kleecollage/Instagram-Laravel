<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex flex-col items-center space-y-4">
                    @include('includes.message')
                    @foreach($images as $image)
                    <div class="card  w-full max-w-3xl pub-image">
                        <div class="card-header">
                            @if($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}" class="avatar" alt="user-avatar"/>
                            </div>
                            @else
                                <div class="container-avatar">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="default" class="avatar">
                                </div>
                           @endif
                            <div class="data-user">
                                {{ $image->user->name.' '.$image->user->surname }}
                                <span class="nickname">
                                    {{ '@'.$image->user->nick }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="image-container">
                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="image">
                            </div>
                            <div class="likes">

                            </div>
                            <div class="description">
                                <span class="nickname-desc">{{ '@'.$image->user->nick }}</span>
                                <br/>
                                <p>{{$image->description}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
