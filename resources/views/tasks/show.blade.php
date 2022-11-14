<x-app-layout>
        <div class="bg-white p-12 rounded-sm min-w-[300px] w-[40%]">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="id">Task ID:</label><br/>
                    <input type="text" name="id" id="id" disabled value="{{ $task->id }}" class="p-1 w-full">
                </div>

                <div class="mb-6">
                    <label for="title">Title:</label><br/>
                    <input type="text" name="title" size="30" id="title" value="{{ $task->title }}" class="p-1 w-full">
                    @error('title')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" class="p-1 w-full" rows="4">{{ $task->description }}</textarea>
                    @error('description')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id">Category:</label><br/>
                    <select name="category_id" id="category_id" required class="py-1 w-full">
                        @foreach($categories as $category)
                            @if(($task->category->id ?? null) != $category->id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="customer_id">Customer:</label><br/>
                    <select name="customer_id" id="customer_id" class="py-1 w-full">
                        <option value>-</option>
                        @foreach($customers as $customer)
                            @if(($task->customer->id ?? null) != $customer->id)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @else
                                <option selected value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('customer_id')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="priority">Priority:</label><br/>
                    <select name="priority" id="priority" required class="py-1 w-full">
                        @foreach($priorityLevels as $priority)
                            @if($task->priority != $priority)
                                <option value="{{ $priority }}">{{ ucfirst($priority) }}</option>
                            @else
                                <option selected value="{{ $priority }}">{{ ucfirst($priority) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('priority')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="assignee_id">Assignee:</label><br/>
                    <select name="assignee_id" id="assignee_id" class="py-1 w-full">
                        <option value>-</option>
                        @foreach($users as $user)
                            @if(($task->assignee->id ?? null) != $user->id)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @else
                                <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('assignee_id')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status">Status:</label><br/>
                    <select name="status" id="status" class="py-1 w-full">
                        <option value>-</option>
                        @foreach($statuses as $status)
                            @if($task->status != $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @else
                                <option selected value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('status')
                    <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="due_date">Due date:</label><br/>
                    <input type="date" name="due_date" id="due_date" class="p-1 w-full" value="{{ $task->due_date }}">
                    @error('due_date')
                        <span class="text-sm text-red-500 inline-block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" @cannot('edit', $task) disabled @endcannot
                    class="mt-4 bg-button text-white rounded-md p-3 inline-block">
                    <i class="fas fa-check mr-3"></i>
                    Save
                </button>
            </form>

            @can('delete', $task)
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Task?');"
                        class="mt-4 bg-red-600 hover:bg-red-900 text-white rounded-md p-3 inline-block">
                        <i class="fas fa-trash mr-3"></i>
                        Delete Task
                    </button>
                </form>
            @endcan
        </div>

    <div class="content-center w-full p-12 rounded-sm flex flex-col max-h-[1000px]">
        <h1 class="text-2xl pb-4">Notes:</h1>

        <div class="overflow-auto">
            @unless(count($notes) == 0)
                <table class="w-full bg-white mb-4 table-fixed">
                    <thead class="bg-black text-white">
                    <tr>
                        <th class="w-[70%] py-3 px-4 uppercase font-semibold text-sm">Content</th>
                        <th class="w-[15%] py-3 px-4 uppercase font-semibold text-sm">Author</th>
                        <th class="w-[15%] py-3 px-4 uppercase font-semibold text-sm">Created</th>
                    </tr>
                    </thead>

                    <tbody class="border-b border-gray-300">
                    @foreach($notes as $note)
                        <tr class="even:bg-gray-200 hover:bg-gray-300 clickable-row hover:cursor-pointer" onclick="window.location.href='{{ route('notes.show', $note->id) }}'">
                            <td class="p-1 border-l border-gray-300 whitespace-pre-wrap break-all">{{ preg_replace("/(\r?\n){2,}/", "\n", $note->content) }}</td>
                            <td class="p-1 border-x border-gray-300">{{ $note->user->name ?? '' }}</td>
                            <td class="p-1 border-x border-gray-300">{{ date("H:i:s d-m-Y", strtotime($note->created_at)) }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $notes->links() }}
            @else
                <p>No notes to show</p>
            @endunless
        </div>

        <div class="mt-auto">
            <h1 class="text-2xl py-4">New note:</h1>

            <form action="{{ route('notes.store') }}" method="POST">
                @csrf

                <input type="hidden" name="task_id" id="task_id" value="{{ $task->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                <textarea class="w-full rounded-sm" name="content" id="content" rows="3"></textarea>

                <button type="submit" class="mt-4 bg-button text-white rounded-md p-3 inline-block">
                    <i class="fas fa-add mr-3"></i>
                    Add
                </button>
            </form>
        </div>
    </div>

</x-app-layout>
