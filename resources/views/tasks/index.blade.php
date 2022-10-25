<x-app-layout>
    @unless(count($tasks) == 0)
        <table class="w-full border-collapse border-spacing-2 text-sm">
            <thead>
                <tr>
                    <th class="pb-4">ID</th>
                    <th class="pb-4">Title</th>
                    <th class="pb-4">Category</th>
                    <th class="pb-4">Customer</th>
                    <th class="pb-4">Priority</th>
                    <th class="pb-4">Assignee</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Due date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                    <tr class="odd:bg-gray-100 clickable-row hover:bg-gray-200 hover:cursor-pointer" onclick="window.location.href='{{ route('tasks.show', $task->id) }}'">
                        <td class="border px-1 py-2">{{ $task->id }}</td>
                        <td class="border px-1 py-2">{{ $task->title }}</td>
                        <td class="border px-1 py-2">{{ $task->category->name }}</td>
                        <td class="border px-1 py-2">{{ $task->customer->name }}</td>
                        <td class="first-letter:capitalize border px-1 py-2">{{ $task->priority }}</td>
                        <td class="border px-1 py-2">{{ $task->assignee->name }}</td>
                        <td class="first-letter:capitalize border px-1 py-2">{{ $task->status }}</td>
                        <td class="border px-1 py-2">{{ $task->due_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks to show</p>
    @endunless


</x-app-layout>
