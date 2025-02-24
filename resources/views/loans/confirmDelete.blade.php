<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Confirm Loan Deletion') }}
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-gray-700 mt-4">{{ __('Are you sure you want to delete this loan?') }}</p>

        <form action="{{ route('loans.delete', ['id' => $id]) }}" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">{{ __('Delete') }}</button>
            <a href="{{ route('loans.index') }}" class="ml-4 text-gray-600">{{ __('Cancel') }}</a>
        </form>
    </div>

</x-app-layout>
