<x-layout>
<x-slot:heading>
{{ $job['title'] }}
</x-slot:heading>

<div class="max-w-3xl mx-auto bg-gray-900 border border-gray-800 rounded-xl shadow-2xl p-8 space-y-8">
<!-- Header & Edit Button -->
<div class="flex justify-between items-start border-b border-gray-700 pb-6">
<div>
<p class="text-sm font-semibold text-indigo-400 uppercase tracking-widest">{{ $job->employer->name }}</p>
<h1 class="text-3xl font-extrabold text-white mt-1">{{ $job['title'] }}</h1>
<p class="text-lg text-gray-400 mt-2">
<span class="font-bold text-green-400">Pays ${{ $job['salary'] }}</span> per year.
</p>
@if ($job->location)
<p class="text-sm text-gray-500 mt-1">Location: {{ $job->location }}</p>
@endif
</div>

    <!-- NEW: Edit Button -->
    <a href="/jobs/{{ $job->id }}/edit"
        class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-700 transition shadow-indigo-500/50 shadow-lg whitespace-nowrap">
        Edit this Job
    </a>
</div>

<!-- Job Description (Re-added) -->
<section class="space-y-4">
    <h2 class="text-xl font-semibold text-gray-200 border-b border-gray-800 pb-2">Job Description</h2>
    <div class="prose prose-invert text-gray-400 leading-relaxed">
        <p>{{ $job['description'] }}</p>
        <!-- Add more description content here if available -->
    </div>
</section>

<!-- Tags -->
@if ($job->tags->isNotEmpty())
    <section>
        <h2 class="text-xl font-semibold text-gray-200 border-b border-gray-800 pb-2 mb-4">Skills & Requirements</h2>
        <div class="flex flex-wrap gap-2">
            @foreach ($job->tags as $tag)
                <span class="bg-indigo-900/50 text-indigo-300 text-xs font-medium px-3 py-1 rounded-full border border-indigo-500/50 shadow-md">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    </section>
@endif

<!-- Back Link -->
<div class="pt-6 border-t border-gray-700 flex justify-center">
    <a href="/jobs"
       class="px-4 py-2 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 transition">
        &larr; Back to Job Listings
    </a>
    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

</div>

</x-layout>