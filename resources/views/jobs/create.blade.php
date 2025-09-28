<x-layout>
<x-slot:heading>
Create a New Job
</x-slot:heading>

<div class="max-w-3xl mx-auto bg-gray-900 border border-gray-800 rounded-xl shadow-lg p-8">
    <form method="POST" action="/jobs" class="space-y-6">
        @csrf

        <!-- Job Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-300">Job Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="mt-2 w-full rounded-lg bg-gray-800 border-gray-700 text-gray-200 placeholder-gray-500 
                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                    placeholder="e.g. Software Engineer">
            @error('title')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Salary (UPDATED WITH $ SIGN) -->
        <div>
            <label for="salary" class="block text-sm font-medium text-gray-300">Salary (per year)</label>
            <div class="relative mt-2 rounded-lg shadow-sm">
                <!-- Prefix $ sign -->
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">$</span>
                </div>
                
                <input type="number" name="salary" id="salary" value="{{ old('salary') }}"
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
                    <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                        {{ $employer->name }}
                    </option>
                @endforeach
            </select>
            @error('employer_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tags (Updated to two columns) -->
        <div>
            <label class="block text-sm font-medium text-gray-300">Tags</label>
            <!-- NEW: Added grid grid-cols-2 and gap-x-8 -->
            <div class="mt-2 grid grid-cols-2 gap-x-8 gap-y-3">
                @foreach ($tags as $tag)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               class="h-4 w-4 text-indigo-500 border-gray-600 rounded bg-gray-800 focus:ring-indigo-500"
                               {{ (collect(old('tags'))->contains($tag->id)) ? 'checked' : '' }}
                               @if(in_array($tag->id, old('tags', $tags->pluck('id')->toArray()))) checked @endif
                               >
                        <span class="text-gray-300 text-sm">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>


        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="/jobs"
               class="px-4 py-2 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                Save Job
            </button>
        </div>
    </form>
</div>

</x-layout>