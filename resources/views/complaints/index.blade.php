<!-- resources/views/complaints/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Complaints</h1>
        {{-- <a href="{{ route('complaints.create') }}" class="btn btn-primary">Add Complaint</a> --}}
        <a href="#" class="btn btn-primary">Add Complaint</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->customer_name }}</td>
                        <td>{{ $complaint->contact1 }}</td>
                        <td>{{ $complaint->product_category }}</td>
                        <td>{{ $complaint->status }}</td>
                        <td>
                            <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection