<x-app-layout>
    <div class="content-center w-full rounded-sm flex flex-col">
        <h1 class="text-3xl text-black pb-8">All Tasks</h1>

            <div class="bg-white p-4 rounded-sm mb-10">
                <form action="{{ route('tasks.index') }}" method="GET">
                    <label for="phrase">Search: </label>
                    <input type="search" name="phrase" id="phrase" class="rounded-full m-2" value="{{ $phrase ?? '' }}" placeholder="Search for Tasks...">

                    <div class="mb-2">
                        <div class="font-bold">Sort by:</div>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="id" @if ($sortBy == 'id') checked @endif> ID</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="priority" @if ($sortBy == 'priority') checked @endif> Priority</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="status" @if ($sortBy == 'status') checked @endif> Status</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="due_date" @if ($sortBy == 'due_date') checked @endif> Due date</label>
                    </div>

                    <div class="mb-2">
                        <div class="font-bold">Sort order:</div>
                        <label for="sort_order" class="pr-2"><input type="radio" name="sort_order" value="asc" @if ($sortOrder == 'asc') checked @endif> Ascending</label>
                        <label for="sort_order" class="pr-2"><input type="radio" name="sort_order" value="desc" @if ($sortOrder == 'desc') checked @endif> Descending</label>
                    </div>

                    <div class="mb-2">
                        <div class="font-bold">Tasks per page:</div>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="5" @if ($pageSize == '5') checked @endif> 5</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="10" @if ($pageSize == '10') checked @endif> 10</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="25" @if ($pageSize == '25') checked @endif> 25</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="50" @if ($pageSize == '50') checked @endif> 50</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="100" @if ($pageSize == '100') checked @endif> 100</label>
                    </div>

                    <div class="mb-2 mt-5">
                        <input type="checkbox" name="show_closed" @if ($showClosed == 'on') checked @endif>
                        <label for="show_closed"> Show closed Tasks</label>
                    </div>

                    <div class="mb-2">
                        <button type="submit" class="mt-4 bg-button text-white rounded-md p-3 inline-block">
                            <i class="fas fa-search mr-3"></i>
                            Search
                        </button>
                    </div>
                </form>
            </div>

        @unless(count($tasks) == 0)
            <table class="w-full h-2 bg-white table-fixed">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-[30%] py-3 px-4 uppercase font-semibold text-sm">Title</th>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">Category</th>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">Customer</th>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">Priority</th>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">Assignee</th>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">Due date</th>
                    </tr>
                </thead>

                <tbody class="border-b border-gray-300">
                    @foreach($tasks as $task)
                        <tr class="even:bg-gray-200 clickable-row hover:bg-gray-300 hover:cursor-pointer" onclick="window.location.href='{{ route('tasks.show', $task->id) }}'">
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap">{{ $task->id }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap">{{ $task->title }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap w-full">{{ $task->category->name }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap">{{ $task->customer->name ?? '' }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap first-letter:capitalize">{{ $task->priority }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap">{{ $task->assignee->name ?? '' }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap first-letter:capitalize">{{ $task->status }}</td>
                            <td class="p-1 border-x border-gray-300 overflow-hidden text-ellipsis whitespace-nowrap">{{ date("d-m-Y", strtotime($task->due_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br/>
            {{ $tasks->links() }}

        @else
            <p>No tasks to show</p>
        @endunless
    </div>
</x-app-layout>
