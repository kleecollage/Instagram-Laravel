<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Likes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex flex-col items-center space-y-4">
                    <h1 class="text-lg font-medium text-gray-900">My Favorite Images </h1>
                    @foreach($likes as $like)
                        @include('includes.image',['image'=>$like->image])
                    @endforeach
                </div>
                <div class="clearfix">
                    {{ $likes->links() }}
                </div>
                {{--PAGINACION--}}
            </div>
        </div>
    </div>
</x-app-layout>
