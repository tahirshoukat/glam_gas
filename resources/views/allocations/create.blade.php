<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Inventory Allocation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('inventories.allocations.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="technician" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Technician</label>
                            <select id="technician" name="technician_id" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                                @foreach($technicians as $technician)
                                    <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="inventory" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Inventory Item</label>
                            <select id="inventory" name="inventory_id" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                                @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="mt-1 block w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Allocate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>