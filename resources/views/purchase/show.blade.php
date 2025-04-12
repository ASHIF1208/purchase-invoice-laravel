@extends('layouts.app')

@section('content')
<div class="container">
    <h2>View Purchase Invoice</h2>

    <div class="card">
        <div class="section">
            <div class="section-header">
                <span>Purchase Details</span>
            </div>
            <div class="section-body d-flex j-cnt-sb">
                <div class="col-4"><strong>Date:</strong> {{ $purchase->date }}</div>
                <div class="col-4"><strong>Category:</strong> {{ $purchase->category_name }}</div>
                <div class="col-4"><strong>Supplier:</strong> {{ $purchase->supplier_name }}</div>
            </div>
            <div class="section-body d-flex j-cnt-sb">
                <div class="col-4"><strong>Gross Total:</strong> ₹{{ number_format($purchase->gross_total, 2) }}</div>
                <div class="col-4"><strong>Freight:</strong> ₹{{ number_format($purchase->transport_frieght, 2) }}</div>
                <div class="col-4"><strong>Loading/Unloading:</strong> ₹{{ number_format($purchase->loading_unloading_amount, 2) }}</div>
            </div>
            <div class="section-body d-flex j-cnt-sb">
                <div class="col-4"><strong>Tax (18%):</strong> ₹{{ number_format($purchase->tax_amount, 2) }}</div>
                <div class="col-4"><strong>Net Amount:</strong> ₹{{ number_format($purchase->net_amount, 2) }}</div>
                <div class="col-4"><strong>Status:</strong>
                    @if ($purchase->status == 0)
                        <span class="badge warning">Pending</span>
                    @else
                        <span class="badge success">Completed</span>
                    @endif
                </div>
            </div>
            <div class="section-body d-flex j-cnt-sb"><strong>Notes:</strong> {{ $purchase->notes }}</div>
        </div>
    </div>

    {{-- Product List --}}
    <div class="section">
        <div class="section-header">Products List</div>
        <div class="section-body">
            <table class="custom-table" id="product_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Gross Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase->details as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>₹{{ number_format($item->qty * $item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-secondary">← Back to List</a>
    <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('purchase.destroy', $purchase->id) }}" method="POST" class="delete-form d-inline">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
    </form>
        
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
