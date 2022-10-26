<x-app-layout>
    <h1 class="text-3xl text-black pb-8">Tasks</h1>

    @unless(count($tasks) == 0)
        <table class="min-w-full bg-white">
            <thead class="bg-black text-white">
                <tr>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Category</th>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Customer</th>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Priority</th>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Assignee</th>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                    <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Due date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                    <tr class="odd:bg-gray-200 clickable-row hover:bg-gray-300 hover:cursor-pointer" onclick="window.location.href='{{ route('tasks.show', $task->id) }}'">
                        <td class="p-1 border-x border-gray-300">{{ $task->id }}</td>
                        <td class="p-1 border-x border-gray-300">{{ $task->title }}</td>
                        <td class="p-1 border-x border-gray-300">{{ $task->category->name }}</td>
                        <td class="p-1 border-x border-gray-300">{{ $task->customer->name }}</td>
                        <td class="first-letter:capitalize p-1 border-x border-gray-300">{{ $task->priority }}</td>
                        <td class="p-1 border-x border-gray-300">{{ $task->assignee->name }}</td>
                        <td class="first-letter:capitalize p-1 border-x border-gray-300">{{ $task->status }}</td>
                        <td class="p-1 border-x border-gray-300">{{ date("d-m-Y", strtotime($task->due_date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks to show</p>
    @endunless

</x-app-layout>
