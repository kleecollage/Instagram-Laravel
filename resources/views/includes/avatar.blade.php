@if(Auth::check() && Auth::user()->image)
    <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" alt="avatar" class="avatar">
@else
    <!-- Aquí podrías poner una imagen por defecto si el usuario no tiene imagen -->
    <img src="{{ asset('images/default-avatar.png') }}" alt="default avatar" class="avatar">
@endif
