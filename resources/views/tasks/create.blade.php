<x-app-layout>
    <div class="m-auto">
        <h1 class="content-left text-3xl text-black pb-8">Create new Task</h1>

        <div class="content-center bg-white w-min p-12 m-auto rounded-sm">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title">Title:</label><br/>
                    <input type="text" name="title" size="50" id="title" value="{{ old('title') }}" class="p-1">
                    @error('title')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" class="p-1" cols="50" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="category_id">Category:</label><br/>
                    <select name="category_id" id="category_id" required class="py-1 w-full">
                        <option hidden selected value>-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="customer_id">Customer:</label><br/>
                    <select name="customer_id" id="customer_id" class="py-1 w-full">
                        <option selected value>-</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="priority">Priority:</label><br/>
                    <select name="priority" id="priority" required class="py-1 w-full">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="assignee_id">Assignee:</label><br/>
                    <select name="assignee_id" id="assignee_id" class="py-1 w-full">
                        <option selected value>-</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="due_date">Due date:</label><br/>
                    <input type="date" name="due_date" id="due_date" class="p-1 w-full" value="{{ old('due_date') }}">
                    @error('due_date')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <button type="submit" class="m-auto mt-4 bg-button text-white rounded-md p-3 inline-block">
                        <i class="fas fa-edit mr-3"></i>
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
