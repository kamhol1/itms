<x-app-layout>
    <div class="content-center w-full rounded-sm flex flex-col">
        <h1 class="text-3xl text-black pb-8">Customers (Admin options)</h1>

        <div class="bg-white p-4 rounded-sm mb-10">
            <table class="w-full bg-white my-4 table-auto">
                <thead class="bg-black text-white">
                <tr>
                    <th class="w-[10%] py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Phone</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Email</th>
                    <th class="w-[15%] py-3 px-4 uppercase font-semibold text-sm">Options</th>
                </tr>
                </thead>

                <tbody class="border-b border-gray-300">
                    @foreach($customers as $customer)
                        <tr class="even:bg-gray-200">
                            <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <td class="p-1 border-x border-gray-300">{{ $customer->id }}</td>
                                <td class="p-1 border-x border-gray-300">
                                    <input type="text" name="name" id="name" value="{{ $customer->name }}" class="w-full rounded-sm">
                                </td>
                                <td class="p-1 border-x border-gray-300">
                                    <input type="tel" name="phone" id="phone" value="{{ $customer->phone }}" class="w-full rounded-sm">
                                </td>
                                <td class="p-1 border-x border-gray-300">
                                    <input type="email" name="email" id="email" value="{{ $customer->email }}" class="w-full rounded-sm">
                                </td>
                                <td class="p-1 border-x border-gray-300 first-letter:capitalize text-center">
                                    <button type="submit" class="border border-1 px-3 py-1 bg-green-600 text-white rounded-sm hover:bg-green-900">Save</button>
                            </form>
                                    <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this customer: {{ $customer->name }}');"
                                            class="border border-1 px-3 py-1 bg-red-600 text-white rounded-sm hover:bg-red-900">
                                            Delete
                                        </button>
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
