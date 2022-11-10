<x-app-layout>
    <div class="content-center w-full rounded-sm flex flex-col">
        <h1 class="text-3xl text-black pb-8">Users (Admin options)</h1>

        <div class="bg-white p-4 rounded-sm mb-10">
            <table class="min-w-full bg-white my-4">
                <thead class="bg-black text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm">Username</th>
                    <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm">Email</th>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Email verified at</th>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Is admin</th>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Options</th>
                </tr>
                </thead>

                <tbody class="border-b border-gray-300">
                @foreach($users as $user)
                    <tr class="even:bg-gray-200">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <td class="p-1 border-x border-gray-300">{{ $user->id }}</td>
                            <td class="p-1 border-x border-gray-300">
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full rounded-sm">
                            </td>
                            <td class="p-1 border-x border-gray-300">
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full rounded-sm">
                            </td>
                            <td class="p-1 border-x border-gray-300">{{ $user->email_verified_at }}</td>
                            <td class="p-1 border-x border-gray-300 text-center">
                                <input type="checkbox" name="admin" id="admin" @if($user->admin == 1) checked @endif>
                            </td>
                            <td class="p-1 border-x border-gray-300 first-letter:capitalize">
                                <button type="submit" class="border border-1 px-3 py-1 bg-green-600 text-white rounded-sm hover:bg-green-900">Save</button>
                        </form>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user: {{ $user->name }}');"
                                    class="border border-1 px-3 py-1 bg-red-600 text-white rounded-sm hover:bg-red-900">
                                Delete
                            </button>
                        </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.users.create') }}" class="bg-button text-white rounded-md p-3 mb-4 inline-block">
                <i class="fas fa-plus mr-3"></i>
                Add new user
            </a>
        </div>
    </div>
</x-app-layout>
