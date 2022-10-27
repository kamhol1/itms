<x-app-layout>
    <div>
        <h1 class="text-3xl text-black pb-8">Task no. {{ $task->id }}</h1>

        <div class="content-center bg-white w-min p-12 rounded-sm">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title">Title:</label><br/>
                    <input type="text" name="title" size="50" id="title" value="{{ $task->title }}" class="p-1">
                    @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" class="p-1" cols="50" rows="4">{{ $task->description }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="category_id">Category:</label><br/>
                    <select name="category_id" id="category_id" required class="py-1">
                        @foreach($categories as $category)
                            @if(($task->category->id ?? null) != $category->id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="customer_id">Customer:</label><br/>
                    <select name="customer_id" id="customer_id" class="py-1">
                        <option value>-</option>
                        @foreach($customers as $customer)
                            @if(($task->customer->id ?? null) != $customer->id)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @else
                                <option selected value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="priority">Priority:</label><br/>
                    <select name="priority" id="priority" required class="py-1">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="assignee_id">Assignee:</label><br/>
                    <select name="assignee_id" id="assignee_id" class="py-1">
                        <option value>-</option>
                        @foreach($users as $user)
                            @if(($task->assignee->id ?? null) != $user->id)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @else
                                <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="due_date">Due date:</label><br/>
                    <input type="date" name="due_date" id="due_date" class="p-1" value="{{ $task->due_date }}">
                    @error('due_date')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <button type="submit" class="m-auto mt-6 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="content-center bg-white w-min p-12 rounded-sm mx-2 mt-[68px]">
        <div>01</div>
        <div>02</div>
        <div>03</div>
    </div>

</x-app-layout>