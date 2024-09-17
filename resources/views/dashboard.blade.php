@php use App\Helpers\FormatTime;use Illuminate\Support\Facades\Auth; @endphp
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
                                <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                    <div class="card-header">
                                        @if($image->user->image)
                                            <div class="container-avatar">
                                                <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}"
                                                     class="avatar" alt="user-avatar"/>
                                            </div>
                                        @else
                                            <div class="container-avatar">
                                                <img src="{{ asset('images/default-avatar.png') }}" alt="default"
                                                     class="avatar">
                                            </div>
                                        @endif
                                        <div class="data-user">
                                            {{ $image->user->name.' '.$image->user->surname }}
                                            <span class="nickname">{{ '@'.$image->user->nick }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <div class="image-container">
                                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                             alt="image">
                                    </div>
                                    <div class="description">
                                        <span class="nickname-desc">{{ '@'.$image->user->nick }}&nbsp; |</span>
                                        <span
                                            class="nickname-desc date">&nbsp; {{ FormatTime::LongTimeFilter($image->created_at)}}</span>
                                        <br/>
                                        <p>{{$image->description}}</p>
                                    </div>
                                    <div class="social-bar">
                                        {{--Comprobar si el usuario le dio liike a la imagen--}}
                                        <?php $user_like = false; ?>
                                        @foreach($image -> likes as $like)
                                            @if($like->user->id == Auth::user()->id)
                                                <?php $user_like = true; ?>
                                            @endif
                                        @endforeach
                                        @if($user_like)
                                            <img src="{{ asset('images/heart-icon-red.png') }}" alt="heart-icon"
                                                 class="btn-like" data-id="{{ $image->id }}">
                                        @else
                                            <img src="{{ asset('images/heart-icon.png') }}" alt="heart-icon"
                                                 class="btn-dislike" data-id="{{ $image->id }}">
                                        @endif
                                        <span class="number-likes">{{ count($image->likes) }}</span>
                                        <a href="{{ route('image.detail', ['id' => $image->id]) }}"
                                           class="btn btn-sm btn-warning btn-comments" data-id="{{ $image->id }}">
                                            Comentarios {{ count($image->comments) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                {{--PAGINACION--}}
                <div class="clearfix">
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
