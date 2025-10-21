<x-layout>

<x-slot:headings>Create new job</x-slot:headings>

@props([
    'method' => 'GET',
    'action' => '/',
    'button' => 'submit'
])

<form method={{$method}} action={{$action}} >
    @csrf
    {{ $slot }}
    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out" type="submit">{{$button}}</button>
</form>

</x-layout>