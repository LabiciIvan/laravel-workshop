@props([
    'name' => '',
    'placeholder' => ''
])

<input 
    {{$attributes->merge(["class" => "w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"])}}
    name="{{$name}}"
    placeholder="{{$placeholder}}"
/>
