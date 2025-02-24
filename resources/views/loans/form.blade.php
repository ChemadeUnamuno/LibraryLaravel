<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __(isset($loan) ? 'Edit Loan' : 'Register New Loan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 bg-green-500 text-white p-3 rounded-lg">
                {{ __('Success:') }} {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-500 text-white p-3 rounded-lg">
                {{ __('Error:') }} {{ session('error') }}
            </div>
        @endif


        <form action="{{ isset($loan) ? route('loans.update', $loan->id_socio . ';' . $loan->id_ejemplar . ';' . $loan->fecha_prestamo) : route('loans.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($loan))
                @method('PUT')
            @endif

            <div>
                <label for="nombre" class="block text-gray-200">{{ __('Name:') }}</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $loan->user->name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 @error('nombre') border-red-500 @enderror">
                @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="apellidos" class="block text-gray-200">{{ __('Surname:') }}</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $loan->user->surname ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 @error('apellidos') border-red-500 @enderror">
                @error('apellidos')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="titulo" class="block text-gray-200">{{ __('Book Title:') }}</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $loan->book->titulo ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 @error('titulo') border-red-500 @enderror">
                @error('titulo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="autor" class="block text-gray-200">{{ __('Author:') }}</label>
                <input type="text" id="autor" name="autor" value="{{ old('autor', $loan->book->autor ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 @error('autor') border-red-500 @enderror">
                @error('autor')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="editorial" class="block text-gray-200">{{ __('Publisher:') }}</label>
                <input type="text" id="editorial" name="editorial" value="{{ old('editorial', $loan->book->editorial ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 @error('editorial') border-red-500 @enderror">
                @error('editorial')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="fecha_prestamo" class="block text-gray-200">{{ __('Loan Date:') }}</label>
                <input type="date" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo', isset($loan) ? $loan->fecha_prestamo : '') }}" class="w-full border border-gray-300 rounded px-3 py-2 @error('fecha_prestamo') border-red-500 @enderror">
                @error('fecha_prestamo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    {{ isset($loan) ? __('Save Changes') : __('Register Loan') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
