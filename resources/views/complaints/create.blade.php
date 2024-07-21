<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Register Complaint') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Register Complaint</h3>
                    <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="contact1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                                <input type="text" name="contact1" id="contact1" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <input type="text" name="address" id="address" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="problem" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Problem</label>
                                <textarea name="problem" id="problem" class="mt-1 block w-full" required></textarea>
                            </div>
                            <div>
                                <label for="warranty_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warranty Status (Upload Photo)</label>
                                <input type="file" name="warranty_status" id="warranty_status" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="purchased_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Purchased From</label>
                                <input type="text" name="purchased_from" id="purchased_from" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="cancel_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Complaint Cancel Reason</label>
                                <input type="text" name="cancel_reason" id="cancel_reason" class="mt-1 block w-full">
                            </div>
                            <div>
                                <label for="model_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model (Upload Photo/Video)</label>
                                <input type="file" name="model_photo" id="model_photo" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="product" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product</label>
                                <select name="product" id="product" class="mt-1 block w-full" required>
                                    <option value="Hood">Hood</option>
                                    <option value="Hob">Hob</option>
                                    <option value="Sink">Sink</option>
                                    <option value="Faucet">Faucet</option>
                                    <option value="Microwave">Microwave</option>
                                    <option value="Built in Oven">Built in Oven</option>
                                    <option value="Cooking range">Cooking range</option>
                                    <option value="Infrared ceramic cooker">Infrared ceramic cooker</option>
                                    <option value="Geyser">Geyser</option>
                                    <option value="Electric Geyser">Electric Geyser</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="p-2 bg-blue-500 text-white rounded">Register Complaint</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
