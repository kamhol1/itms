<x-app-layout>
    <h1 class="text-3xl text-black pb-8">Create new Task</h1>

    <div class="content-center bg-white w-min p-12 m-auto rounded-sm">
        <form aciton="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="title">Title:</label><br/>
                <input type="text" name="title" size="50" id="title" value="{{ old('title') }}" required class="p-1">
            </div>

            <div class="mb-6">
                <label for="description">Description:</label><br/>
                <textarea name="description" id="description" class="p-1" cols="50" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="category">Category:</label><br/>
                <select name="category" id="category" required class="py-1" value="{{ old('category') }}">
                    <option hidden selected value>Choose</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="customer">Customer:</label><br/>
                <select name="customer" id="customer" class="py-1" value="{{ old('customer') }}">
                    <option selected value>Choose</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="priority">Priority:</label><br/>
                <select name="priority" id="priority" required class="py-1" value="{{ old('priority') }}">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="assignee">Assignee:</label><br/>
                <select name="assignee" id="assignee" class="py-1" value="{{ old('assignee') }}">
                    <option selected value>Choose</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="due_date">Due date:</label><br/>
                <input type="date" name="due_date" id="due_date" class="p-1" value="{{ old('due_date') }}">
            </div>

            <div class="flex items-center">
                <button type="submit" class="m-auto mt-6 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Create Task
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
