<x-layout>

<x-slot:headings>Job</x-slot:headings>

<div class="space-y-4">
    @foreach ($jobs as $job)
        <a class="block px-4 py-6 border border-gray-200 rounded-lg" href="{{ route("jobs.show", ['id' => $job['id']]) }}">
            <div class="font-bold text-blue-500">
                {{ $job->employer->name}}
            </div>

            <div>
                <strong>Job: {{$job['title']}}</strong> Pays {{$job['salary']}} per year.
            </div>
        </a>
    @endforeach

    <div>
        {{ $jobs->links() }}
    </div>
</div>

</x-layout>