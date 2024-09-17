@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload New Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <div class="card">
                        <div class="card-header">Upload New Image</div>
                        <div class="card-body">
                            <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <x-input-label for="image_path" class="col-md-3 col-form-label text-md-center">Image</x-input-label>
                                    <div class="col-md-7 col-form-label">
                                        <x-text-input type="file" id="image_path" name="image_path" class="form-control" required />
                                        <x-input-error :messages="$errors->get('image_path')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <x-input-label for="description" class="col-md-3 col-form-label text-md-center" >Description</x-input-label>
                                    <div class="col-md-7 col-form-label">
                                        <textarea id="description" name="description" class="form-control" required ></textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ms-4">
                                            {{ __('Upload') }}
                                        </x-primary-button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
