@if($errors->has($fieldName)) 
    <p class="text-sm text-red-500 font-semibold mt-1">
        {{$errors->first($fieldName)}} 
    </p>
@endif