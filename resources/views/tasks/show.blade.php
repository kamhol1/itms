<x-app-layout>
    <div>
        <div class="bg-white p-12 rounded-sm">
            <form action="{{ route('tasks.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="id">Task ID:</label><br/>
                    <input type="text" name="id" size="30" id="id" disabled value="{{ $task->id }}" class="p-1">
                </div>

                <div class="mb-6">
                    <label for="title">Title:</label><br/>
                    <input type="text" name="title" size="30" id="title" value="{{ $task->title }}" class="p-1">
                    @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" class="p-1" cols="30" rows="4">{{ $task->description }}</textarea>
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
                    <label for="assignee_id">Status:</label><br/>
                    <select name="assignee_id" id="assignee_id" class="py-1">
                        <option value>-</option>
                        @foreach($statuses as $status)
                            @if($task->status != $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @else
                                <option selected value="{{ $status }}">{{ ucfirst($status) }}</option>
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
                    <button type="submit" class="mt-6 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="content-center bg-white w-full p-12 rounded-sm flex flex-col">
        <h1 class="text-2xl pb-4">Notes:</h1>

        @unless(count($notes) == 0)
        <table class="min-w-full bg-white mb-12">
            <thead class="bg-black text-white">
            <tr>
                <th class="uppercase font-semibold text-sm"></th>
                <th class="w-2/4 py-3 px-4 uppercase font-semibold text-sm">Content</th>
                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Author</th>
                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Created</th>
            </tr>
            </thead>

            <tbody class="border-b border-gray-300">
            @foreach($notes as $note)
                <tr class="even:bg-gray-200 hover:bg-gray-300">
                    <td class="p-1 border-l border-gray-300">
                        @if($note->user_id == auth()->user()->id)
                            <a href="#">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                    </td>
                    <td class="p-1">{{ $note->content }}</td>
                    <td class="p-1 border-x border-gray-300">{{ $note->user->name }}</td>
                    <td class="p-1 border-x border-gray-300">{{ date("H:i:s d-m-Y", strtotime($note->created_at)) }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p>No notes to show</p>
        @endunless

        <div class="mt-auto">
            <h1 class="text-2xl pb-4">New note:</h1>

            <form action="{{ route('notes.store') }}" method="POST">
                @csrf

                <textarea class="w-full" rows="3"></textarea>

                <button type="submit" class="mt-6 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Add
                </button>
            </form>
        </div>
    </div>

</x-app-layout>

{{--max-w-0 truncate text-ellipsis--}}
