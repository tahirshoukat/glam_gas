<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Inventories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- CSV Upload Form -->
                    <form method="POST" action="{{ route('inventories.upload') }}" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <input type="file" name="csv_file" class="border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">Upload CSV</button>
                    </form>

                    <!-- Add Inventory Button -->
                    <div class="mb-4">
                        <a href="{{ route('inventories.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Add Inventory</a>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('inventories') }}" class="mb-4 flex">
                        <input type="text" name="search" value="{{ $search }}" class="border rounded-l-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search items...">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Search</button>
                    </form>

                    <!-- Inventories Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Item Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">UOM</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Closing Stock</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Item Avg Rate</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->location }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->item_description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->uom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->closing_stock }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->item_avg_rate }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->total_amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $inventories->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>