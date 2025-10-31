@props([
    'employers' => $employers ?? null,
    'job' => $job ?? null,
    'availableTags' => $availableTags ?? null
])

<x-layout>

<x-slot:headings>Edit job</x-slot:headings>

<form method="POST" action="{{ route('jobs.update') }}" >
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{$job['id']}}"/>
    @if ($employers)
        <div class="mb-4">
            <select name="employer" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                @foreach ($employers as $employer)
                    <option value="{{$employer['id']}}">{{$employer['name']}}</option>
                @endforeach
            </select>
        </div>
    @endif
    @if($errors->has('employer')) {{$errors->first('employer')}} @endif

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Job name</label>
        <input class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" name="title" value="{{$job['title']}}"/>
        @if($errors->has('name')) {{$errors->first('name')}} @endif
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Job salary</label>
        <input class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" name="salary" value="{{$job['salary']}}"/>
        @if($errors->has('salary')) {{$errors->first('salary')}} @endif
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>

        <div id="selected-tags" class="flex flex-wrap gap-2 mb-3 min-h-[2rem]">
            @foreach($job->tags as $tag)
                <div class="flex items-center gap-2 bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-gray-200 transition" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}" >
                    <span>{{ $tag->name }}</span>
                    <button type="button" class="remove-tag text-red-600 hover:text-red-800 font-bold" title="Remove tag">−</button>
                </div>
            @endforeach
        </div>

        {{-- Available tags --}}
        <div id="available-tags" class="flex flex-wrap gap-2">
            @foreach($availableTags as $tag)
                <div class="flex items-center gap-2 bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-gray-200 transition" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}" >
                    <span>{{ $tag->name }}</span>
                    <button  type="button"  class="add-tag text-green-600 hover:text-green-800 font-bold" title="Add tag">+</button>
                </div>
            @endforeach
        </div>
    </div>

    <div id="selected-tags-inputs"></div>

    <a href={{ route('jobs.index') }} class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">Cancel</a>
    <x-form-button type="submit" innerHtml="Update"/>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const available = document.getElementById('available-tags');
    const selected = document.getElementById('selected-tags');
    const inputs = document.getElementById('selected-tags-inputs');

    // Move tag to selected list
    available.addEventListener('click', (e) => {
        if (e.target.classList.contains('add-tag')) {
            const tagDiv = e.target.closest('[data-tag-id]');
            const tagId = tagDiv.dataset.tagId;
            const tagName = tagDiv.dataset.tagName;

            // Create tag in selected list
            const selectedTag = document.createElement('div');
            selectedTag.className = 'flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-blue-200 transition';
            selectedTag.dataset.tagId = tagId;
            selectedTag.dataset.tagName = tagName;

            selectedTag.innerHTML = `
                <span>${tagName}</span>
                <button type="button" class="remove-tag text-red-600 hover:text-red-800 font-bold" title="Remove tag">−</button>
            `;

            // Add hidden input
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'tags[]';
            hiddenInput.value = tagId;
            hiddenInput.dataset.tagId = tagId;

            inputs.appendChild(hiddenInput);
            selected.appendChild(selectedTag);
            tagDiv.remove();
        }
    });

    // Move tag back to available list
    selected.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-tag')) {
            const tagDiv = e.target.closest('[data-tag-id]');
            const tagId = tagDiv.dataset.tagId;
            const tagName = tagDiv.dataset.tagName;

            // Create tag back in available list
            const availableTag = document.createElement('div');
            availableTag.className = 'flex items-center gap-2 bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-gray-200 transition';
            availableTag.dataset.tagId = tagId;
            availableTag.dataset.tagName = tagName;

            availableTag.innerHTML = `
                <span>${tagName}</span>
                <button type="button" class="add-tag text-green-600 hover:text-green-800 font-bold" title="Add tag">+</button>
            `;

            available.appendChild(availableTag);
            document.querySelector(`#selected-tags-inputs [data-tag-id="${tagId}"]`)?.remove();
            tagDiv.remove();
        }
    });
});
</script>

</form>

</x-layout>