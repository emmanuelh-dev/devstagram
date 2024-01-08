@extends('layouts.app')

@section('title')
    {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center mb-6">{{ auth()->user()->username }}</h1>

        <form method="POST" action="{{ route('perfil.update', auth()->user()->id) }}" class="flex flex-col gap-4"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nombre de usuario -->
            <div class="mb-4">
                <label for="username" class="text-sm font-medium text-gray-700">Username</label>
                <input name="username" id="username" type="text"
                    class="mt-1 p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500"
                    placeholder="Username" value="{{ auth()->user()->username }}">

                @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Vista previa de la imagen -->
            <div class="mb-4">
                <label for="image" class="text-sm font-medium text-gray-700">Profile Image</label>
                <input name="image" id="image" type="file" accept=".jpeg, .jpg, .png"
                    class="mt-1 p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500"
                    onchange="previewImage(event)">
                <div class="mt-2">
                    <img id="image-preview" class="hidden rounded-lg max-w-full h-auto" alt="Preview">
                </div>

                @error('image')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex justify-center">
                <!-- Botón de envío -->
                <button type="submit"
                    class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mr-2">
                    Save changes
                </button>

                <a href="{{ U }}"
                    class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Return
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
