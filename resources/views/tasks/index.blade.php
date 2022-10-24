<x-app-layout>
    @unless(count($tasks) == 0)
        <table class="w-full border-collapse border-spacing-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Customer</th>
                    <th>Priority</th>
                    <th>Assignee</th>
                    <th>Status</th>
                    <th>Due date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr class="odd:bg-white clickable-row hover:bg-gray-200 hover:cursor-pointer" onclick="window.location.href='{{ route('tasks.show', $task->id) }}'">
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

jQuery(document).ready(function($) {
$(".clickable-row").click(function() {
window.location = $(this).data("href");
});
});
