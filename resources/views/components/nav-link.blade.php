{{-- <a href="{{ $path }}" class="{{ request()->path() === $path ? 'bg-gray-900 rounded-md  px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}}">{{ $name }}</a> --}}
@props([
    'active' => false,
    'path' => '/',
    'name' => 'Home',
    'type' => 'a'
])

@if ($type === 'a')
    <a href="{{ $path }}" class="{{ $active ? 'bg-gray-900 rounded-md  px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}}">{{ $name }}</a>
@else
    <button href="{{ $path }}" class="{{ $active ? 'bg-gray-900 rounded-md  px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}}">{{ $name }}</button>
@endif
