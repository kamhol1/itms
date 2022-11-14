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
                    <button type="submit" class="mt-4 bg-button text-white rounded-md p-3 inline-block">
                        <i class="fas fa-check mr-3"></i>
                        Save
                    </button>
                @endcan
            </form>

            @can('delete', $note)
                <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Note?');"
                        class="mt-4 bg-red-600 hover:bg-red-900 text-white rounded-md p-3 inline-block">
                        <i class="fas fa-trash mr-3"></i>
                        Delete Note
                    </button>
                </form>
            @endcan

            <a href="{{ route('tasks.show', $note->task->id) }}">
                <button type="button" class="mt-4 bg-button text-white rounded-md p-3 inline-block">
                    <i class="fas fa-chevron-left mr-3"></i>
                    Go back
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
