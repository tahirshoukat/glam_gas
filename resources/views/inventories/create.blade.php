<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('inventories.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                            <input type="text" id="location" name="location" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="item_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Description</label>
                            <input type="text" id="item_description" name="item_description" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="uom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">UOM</label>
                            <input type="text" id="uom" name="uom" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="closing_stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Closing Stock</label>
                            <input type="number" id="closing_stock" name="closing_stock" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="item_avg_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Avg Rate</label>
                            <input type="number" id="item_avg_rate" name="item_avg_rate" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Add Inventory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>