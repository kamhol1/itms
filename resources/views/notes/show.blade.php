<x-app-layout>
    <div class="m-auto">
        <h1 class="text-3xl text-black pb-8">Note show/edit</h1>

        <div class="content-center bg-white p-12 m-auto rounded-sm">
            <form action="{{ route('notes.update', $note->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <textarea @cannot('edit', $note) disabled @endcannot class="w-full rounded-sm" name="content" id="content" rows="10" cols="100">{{ $note->content }}</textarea>
                    @error('content')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                @can('edit', $note)
                    <button type="submit" class="mt-6 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Save
                    </button>
                @endcan
            </form>

            @can('delete', $note)
                <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Note?');"
                        class="mt-4 px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Delete Note
                    </button>
                </form>
            @endcan

            <a href="{{ route('tasks.show', $note->task->id) }}">
                <button type="button" class="mt-6 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-chevron-left"></i>
                    Go back
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
