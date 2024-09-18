@php use App\Helpers\FormatTime;use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex flex-col items-center space-y-4">
                    @include('includes.message')
                    <div class="card  w-full max-w-7xl pub-image">
                        <div class="card-header">
                            @if($image->user->image)
                                <div class="container-avatar">
                                    <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}"
                                         class="avatar" alt="user-avatar"/>
                                </div>
                            @else
                                <div class="container-avatar">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="default" class="avatar">
                                </div>
                            @endif
                            <div class="data-user">
                                {{ $image->user->name.' '.$image->user->surname }}
                                <span class="nickname">{{ '@'.$image->user->nick }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="image-detail-container">
                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="image">
                            </div>
                            <div class="description">
                                <span class="nickname-desc">{{ '@'.$image->user->nick }}&nbsp; | </span>
                                <span
                                    class="nickname-desc date">&nbsp;{{ FormatTime::LongTimeFilter($image->created_at)}}</span>
                                <br/>
                                <p>{{$image->description}}</p>
                            </div>
                            <div class="likes">
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
                            </div>
                            <div class="comments">
                                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                    Comentarios {{ count($image->comments) }}</h1>
                                <hr>
                                <form action="{{ route('comment.save') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    <div class="col-md-8 ml-14 mt-5">
                                        <textarea rows="7" name="content"
                                                  class="form-control {{ $errors->get('content') ? 'is-invalid' : '' }}"></textarea>
                                        <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                                    </div>
                                    <div class="flex items-center mt-4 ml-5 mb-4">
                                        <x-primary-button class="ms-4">
                                            {{ __('Send') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                                <hr/>
                                @foreach($image->comments as $comment)
                                    <div class="comment">
                                        <span class="nickname-desc">{{ '@'.$comment->user->nick }}&nbsp; | </span>
                                        <span
                                            class="nickname-desc date">&nbsp;{{ FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                        <br/>
                                        <p>{{$comment->content}}</p> <br/>
                                        @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->$id))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                               class="btn btn-sm btn-danger mb-2">
                                                Delete
                                            </a>
                                        @endif
                                        <hr/>
                                    </div>
                                @endforeach
                            </div>
                            @if(Auth::user() && Auth::user()->id == $image->user_id)
                                <div class="actions">
                                    <a href="" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal">Delete</a>
                                </div>

                                {{--MODAL--}}
                                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalLabel">Surely you want to delete?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                If you delete this file it will not be able to be recovered by us
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('image.delete', ['id'=>$image->id]) }}" class="btn btn-danger">Delete Permanently </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

