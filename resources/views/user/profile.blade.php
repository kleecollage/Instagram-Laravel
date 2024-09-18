@php use App\Helpers\FormatTime; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex flex-col items-center space-y-4">
                    <div class="profile-user col-md-8">
                        @if($user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar',['filename' => $user->image]) }}"
                                     class="avatar" alt="user-avatar"/>
                            </div>
                        @else
                            <div class="container-avatar">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="default"
                                     class="avatar">
                            </div>
                        @endif
                        <div class="user-info">
                            <h1>{{ '@' . $user->nick }}</h1>
                            <h1>{{ $user->name . ' ' . $user->surname }}</h1>
                            <p>{{'Se unio ' . FormatTime::LongTimeFilter($user->created_at) }}</p>
                        </div>
                            <div class="clearfix"></div>
                        <hr/>
                    </div>
                    <div class="clearfix"> </div>
                    @foreach($user->images as $image)
                        @include('includes.image', ['image'=>$image])
                    @endforeach
                </div>
                {{--PAGINACION--}}
                <div class="clearfix">
                    {{--$user->links()--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
