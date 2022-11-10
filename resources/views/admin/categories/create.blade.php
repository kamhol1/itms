<x-app-layout>
    <div class="m-auto">
        <h1 class="text-3xl text-black pb-8">Add new category</h1>

        <div class="content-center bg-white w-min p-12 m-auto rounded-sm">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="name">Name:</label><br/>
                    <input type="text" name="name" size="50" id="name" value="{{ old('name') }}" class="p-1">
                    @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <button type="submit" class="m-auto mt-8 bg-button text-white rounded-md p-3 mb-4 inline-block">
                        <i class="fas fa-check mr-3"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
