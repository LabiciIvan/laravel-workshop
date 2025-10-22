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
</form>

</x-layout>