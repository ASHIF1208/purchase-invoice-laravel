@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="text-end">
        <h2>Purchase Invoice List</h2>
        <a href="{{ route('purchase.create') }}" class="btn add-product">+ Add New Purchase</a>
    </div>
    @if(session('success'))
        <div class="success-alert">{{ session('success') }}</div>
    @endif

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Gross Total</th>
                    <th>Freight</th>
                    <th>Loading</th>
                    <th>Tax</th>
                    <th>Net Amount</th>
                    <th>Status</th>
                    <th width="140">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $key => $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->date }}</td>
                        <td>{{ $purchase->category_name }}</td>
                        <td>{{ $purchase->supplier_name }}</td>
                        <td>₹{{ number_format($purchase->gross_total, 2) }}</td>
                        <td>₹{{ number_format($purchase->transport_frieght, 2) }}</td>
                        <td>₹{{ number_format($purchase->loading_unloading_amount, 2) }}</td>
                        <td>₹{{ number_format($purchase->tax_amount, 2) }}</td>
                        <td><strong>₹{{ number_format($purchase->net_amount, 2) }}</strong></td>
                        <td>
                            @if ($purchase->status == 0)
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>
                        <td class="d-flex-cen">
                            <a href="{{ route('purchase.show', $purchase->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('purchase.destroy', $purchase->id) }}" method="POST" class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No purchase records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the record.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
