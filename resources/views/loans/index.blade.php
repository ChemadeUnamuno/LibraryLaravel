<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Loans') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">

        <div class="flex justify-end mb-4">
            <a href="{{ route('loans.download') }}" target="_blank"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                {{ __('Download PDF') }}
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __('Title') }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __('Author') }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __('Publisher') }}</th>
                    <th class="border border-gray-600 px-6 py-3 text-left font-semibold">{{ __('Loan Date') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loans as $loan)
                    <tr class="bg-gray-600 border-b-2 border-b-gray-500 hover:bg-gray-500">
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->book->titulo }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->book->autor }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->book->editorial }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-gray-200">{{ $loan->fecha_prestamo }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $loans->links() }}
        </div>
    </div>
</x-app-layout>
