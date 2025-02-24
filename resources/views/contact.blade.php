<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{__('Contact')}}</title>
    </head>
    <body class="bg-gray-100">
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
    <div class="container mx-auto p-4">
        <h1 class="text-2xl text-white font-bold mb-4">{{__('Contact')}}</h1>
        <form action="{{ route('contact.send') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">{{__('Name')}}:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">{{__('Email')}}:</label>
                <input type="email" name="email" id="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="subject" class="block text-gray-700">{{__('Issue')}}:</label>
                <input type="text" name="subject" id="subject" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">{{__('Message')}}:</label>
                <textarea name="message" id="message" rows="5" class="w-full p-2 border rounded"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{__('Send')}}</button>
        </form>
    </div>
    </body>
    </html>
</x-app-layout>
