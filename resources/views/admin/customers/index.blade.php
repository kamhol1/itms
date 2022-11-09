<x-app-layout>
    <div class="content-center w-full rounded-sm flex flex-col">
        <h1 class="text-3xl text-black pb-8">Customers (Admin options)</h1>

        <div class="bg-white p-4 rounded-sm mb-10">
            <table class="min-w-full bg-white mb-8">
                <thead class="bg-black text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm">Phone</th>
                    <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm">Email</th>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Options</th>
                </tr>
                </thead>

                <tbody class="border-b border-gray-300">
                    @foreach($customers as $customer)
                        <tr class="even:bg-gray-200">
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')

                                <td class="p-1 border-x border-gray-300">{{ $customer->id }}</td>
                                <td class="p-1 border-x border-gray-300">
                                    <input type="text" name="name" id="name" value="{{ $customer->name }}" class="w-full">
                                </td>
                                <td class="p-1 border-x border-gray-300">
                                    <input type="tel" name="phone" id="phone" value="{{ $customer->phone }}" class="w-full">
                                </td>
                                <td class="p-1 border-x border-gray-300">
                                    <input type="email" name="email" id="email" value="{{ $customer->email }}" class="w-full">
                                </td>
                                <td class="p-1 border-x border-gray-300 first-letter:capitalize">
                                    <button type="submit" class="border border-1 px-3 py-2 bg-black text-white rounded-md hover:bg-gray-700">Save</button>
                            </form>
                                    <form action="" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="border border-1 px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-400">Delete</button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.customers.create') }}" class="bg-button text-white rounded-md p-3 mb-4 inline-block">
                <i class="fas fa-plus mr-3"></i>
                Add new customer
            </a>
        </div>
    </div>
</x-app-layout>
