<x-layout>

<x-slot:headings>Job details</x-slot:headings>

@if ($job)
    <div class="flex flex-col m-2">
        <div class="m-1">
            <h2>Employer: {{$job->employer->name}}</h2>
        </div>
        <div class="m-1">
            <strong class="ms-2">Job: </strong>{{$job['title']}}
        </div>
        <div class="m-1">
            <strong class="ms-2">Salary: $</strong>{{$job['salary']}} <strong> per year.</strong> 
        </div>
        <div class="flex flex-row">
            @can('edit', $job)
                <a href="{{route('jobs.edit', ['job' => $job])}}" class="bg-blue-900 rounded-md  px-3 py-2 text-sm font-medium text-white m-2">Edit</a>
            @endcan
            <form method="POST" action="{{route('jobs.delete', ['id' => $job->id])}}">
                @method('DELETE')
                @csrf
                <button type="submit" class="bg-red-900 rounded-md  px-3 py-2 text-sm font-medium text-white m-2 ">DELETE</button>
            </form>
        </div> 
    </div>
@else
    <div>Job not found.</div>
@endif


</x-layout>