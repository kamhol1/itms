<x-app-layout>
    <div class="content-center w-full rounded-sm flex flex-col">
        <h1 class="text-3xl text-black pb-8">All Tasks</h1>

        @unless(count($tasks) == 0)
            <div class="bg-white p-4 rounded-sm mb-10">
                <form action="" method="POST">
                    <div class="mb-2">
                        <div class="font-bold">Sort by:</div>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="id"> ID</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="title"> Title</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="category"> Category</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="customer"> Customer</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="priority"> Priority</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="assignee"> Assignee</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="status"> Status</label>
                        <label for="sort_by" class="pr-2"><input type="radio" name="sort_by" value="due_date"> Due date</label>
                    </div>

                    <div class="mb-2">
                        <div class="font-bold">Sort order:</div>
                        <label for="sort_order" class="pr-2"><input type="radio" name="sort_order" value="title"> Ascending</label>
                        <label for="sort_order" class="pr-2"><input type="radio" name="sort_order" value="title"> Descending</label>
                    </div>

                    <div class="mb-2">
                        <div class="font-bold">Tasks per page:</div>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="5"> 5</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="10"> 10</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="25"> 25</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="50"> 50</label>
                        <label for="page_size" class="pr-2"><input type="radio" name="page_size" value="100"> 100</label>
                    </div>

                    <div class="mb-2">
                        <button type="submit" class="mt-3 px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest button active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Send
                        </button>
                    </div>
                </form>
            </div>

            <table class="min-w-full bg-white">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-5/12 py-3 px-4 uppercase font-semibold text-sm">Title</th>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Category</th>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Customer</th>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Priority</th>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Assignee</th>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Due date</th>
                    </tr>
                </thead>

                <tbody class="border-b border-gray-300">
                    @foreach($tasks as $task)
                        <tr class="even:bg-gray-200 clickable-row hover:bg-gray-300 hover:cursor-pointer" onclick="window.location.href='{{ route('tasks.show', $task->id) }}'">
                            <td class="p-1 border-x border-gray-300">{{ $task->id }}</td>
                            <td class="p-1 border-x border-gray-300">{{ $task->title }}</td>
                            <td class="p-1 border-x border-gray-300">{{ $task->category->name }}</td>
                            <td class="p-1 border-x border-gray-300">{{ $task->customer->name ?? '' }}</td>
                            <td class="p-1 border-x border-gray-300 first-letter:capitalize">{{ $task->priority }}</td>
                            <td class="p-1 border-x border-gray-300">{{ $task->assignee->name ?? '' }}</td>
                            <td class="p-1 border-x border-gray-300 first-letter:capitalize">{{ $task->status }}</td>
                            <td class="p-1 border-x border-gray-300">{{ date("d-m-Y", strtotime($task->due_date)) }}</td>
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
