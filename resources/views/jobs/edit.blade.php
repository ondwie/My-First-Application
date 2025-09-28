<x-layout>
<x-slot:heading>
Edit Job: {{ $job->title }}
</x-slot:heading>

<div class="max-w-3xl mx-auto bg-gray-900 border border-gray-800 rounded-xl shadow-lg p-8">
    <!-- Main Update Form -->
    <form method="POST" action="/jobs/{{ $job->id }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <!-- Job Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-300">Job Title</label>
            <input type="text" name="title" id="title"
                value="{{ old('title') ?: $job->title }}"
                class="mt-2 w-full rounded-lg bg-gray-800 border-gray-700 text-gray-200 placeholder-gray-500 
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                placeholder="e.g. Software Engineer">
            @error('title')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Salary -->
        <div>
            <label for="salary" class="block text-sm font-medium text-gray-300">Salary (per year)</label>
            <div class="relative mt-2 rounded-lg shadow-sm">
                <!-- Prefix $ sign -->
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">$</span>
                </div>
                
                <input type="number" name="salary" id="salary"
                    value="{{ old('salary') ?: $job->salary }}"
                    class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-200 placeholder-gray-500 
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 pl-7 pr-4 py-2"
                    placeholder="e.g. 60000">
            </div>
            @error('salary')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Employer -->
        <div>
            <label for="employer_id" class="block text-sm font-medium text-gray-300">Employer</label>
            <select name="employer_id" id="employer_id"
                    class="mt-2 w-full rounded-lg bg-gray-800 border-gray-700 text-gray-200 
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
                <option value="">-- Select Employer --</option>
                @foreach ($employers as $employer)
                    <option value="{{ $employer->id }}" 
                        {{ (old('employer_id') == $employer->id || $job->employer_id == $employer->id) ? 'selected' : '' }}>
                        {{ $employer->name }}
                    </option>
                @endforeach
            </select>
            @error('employer_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tags -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Tags</label>
            <div class="mt-2 grid grid-cols-2 gap-x-8 gap-y-3">
                @php
                    // Get the IDs of tags currently associated with the job
                    $jobTagIds = $job->tags->pluck('id')->toArray();
                    // Use old('tags') if available, otherwise use $jobTagIds
                    $selectedTags = collect(old('tags', $jobTagIds));
                @endphp

                @foreach ($tags as $tag)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            class="h-4 w-4 text-indigo-500 border-gray-600 rounded bg-gray-800 focus:ring-indigo-500"
                            {{ $selectedTags->contains($tag->id) ? 'checked' : '' }}>
                        <span class="text-gray-300 text-sm">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-300">Job Description</label>
            <textarea name="description" id="description" rows="5"
                        class="mt-2 w-full rounded-lg bg-gray-800 border-gray-700 text-gray-200 placeholder-gray-500 
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        placeholder="Write a detailed job description...">{{ old('description') ?: $job->description }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-800">
            
            <!-- Delete Button -->
            <button form="delete-form" type="submit"
                    class="px-4 py-2 rounded-lg text-red-500 font-semibold hover:bg-gray-800 transition">
                Delete Job
            </button>

            <div class="flex space-x-4">
                <a href="/jobs/{{ $job->id }}"
                   class="px-4 py-2 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Update Job
                </button>
            </div>
        </div>
    </form>

    <!-- Hidden Delete Form -->
    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>

</x-layout>