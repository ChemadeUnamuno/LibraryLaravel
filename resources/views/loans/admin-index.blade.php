<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Library Loans List") }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 bg-green-500 text-white p-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-500 text-white p-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('loans.download') }}" target="_blank"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                {{ __("Download PDF") }}
            </a>
        </div>

        <div class="overflow-x-auto rounded-3xl">
            <table class="table-auto w-full border-collapse border border-gray-300 ">
                <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Name") }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Surname") }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Title") }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Author") }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Publisher") }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Loan Date") }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __("Actions") }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loans as $loan)
                    <tr class="bg-gray-600 border-b-2 border-b-gray-500 hover:bg-gray-500">
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->user->name }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->user->surname }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->book->titulo }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->book->autor }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->book->editorial }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->fecha_prestamo }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('loans.confirmDelete', $loan->id_socio . ';' . $loan->id_ejemplar . ';' . $loan->fecha_prestamo) }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    🗑️
                                </a>
                                <a href="{{ route('loans.edit', $loan->id_socio . ';' . $loan->id_ejemplar . ';' . $loan->fecha_prestamo) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    ✏️
                                </a>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('loans.new_loan') }}" class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-900">
                {{ __("Register a New Loan") }}
            </a>
        </div>
    </div>
</x-app-layout>
