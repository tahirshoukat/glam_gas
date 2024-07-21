<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complaint Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Complaint Details</h3>
                    <div class="mb-4">
                        <strong>Complaint Number:</strong> {{ $complaint->complaint_number }}
                    </div>
                    <div class="mb-4">
                        <strong>Customer Name:</strong> {{ $complaint->customer_name }}
                    </div>
                    <div class="mb-4">
                        <strong>Contact Number:</strong> {{ $complaint->contact1 }}
                    </div>
                    @if($complaint->contact2)
                    <div class="mb-4">
                        <strong>Secondary Contact Number:</strong> {{ $complaint->contact2 }}
                    </div>
                    @endif
                    <div class="mb-4">
                        <strong>Address:</strong> {{ $complaint->address }}
                    </div>
                    <div class="mb-4">
                        <strong>Product:</strong> {{ $complaint->product }}
                    </div>
                    <div class="mb-4">
                        <strong>Problem:</strong> {{ $complaint->problem }}
                    </div>
                    <div class="mb-4">
                        <strong>Warranty Status:</strong> <a href="{{ asset('storage/' . $complaint->warranty_status) }}" target="_blank">View File</a>
                    </div>
                    <div class="mb-4">
                        <strong>Purchased From:</strong> {{ $complaint->purchased_from }}
                    </div>
                    @if($complaint->cancel_reason)
                    <div class="mb-4">
                        <strong>Cancel Reason:</strong> {{ $complaint->cancel_reason }}
                    </div>
                    @endif
                    <div class="mb-4">
                        <strong>Model Photo/Video:</strong> <a href="{{ asset('storage/' . $complaint->model_photo) }}" target="_blank">View File</a>
                    </div>
                    <div class="mb-4">
                        <strong>Status:</strong> {{ $complaint->status }}
                    </div>

                    <div class="mb-4">
                        <strong>Assigned Technician:</strong>
                        @if($complaint->technician)
                            {{ $complaint->technician->name }}
                        @else
                            Not Assigned
                        @endif
                    </div>

                    <form method="POST" action="{{ route('complaints.assignTechnician', $complaint->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="technician_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Assign Technician</label>
                            <select name="technician_id" id="technician_id" class="mt-1 block w-full" required>
                                <option value="">Select Technician</option>
                                @foreach($technicians as $technician)
                                    <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="p-2 bg-blue-500 text-white rounded">Assign Technician</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>