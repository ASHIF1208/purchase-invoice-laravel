@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert-box error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-card">
    <h4>Edit Purchase Invoice</h4>
    <form action="{{ route('purchase.update', $purchase->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Category & Supplier --}}
        <div class="section">
            <div class="section-header">
                <span>Category & Supplier</span>
                <input type="date" name="date" class="input-date" value="{{ $purchase->date }}">
            </div>
            <div class="section-body two-column">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_name" class="input-select">
                        <option value="Civil Materials" {{ $purchase->category_name == 'Civil Materials' ? 'selected' : '' }}>Civil Materials</option>
                        <option value="Electrical Materials" {{ $purchase->category_name == 'Electrical Materials' ? 'selected' : '' }}>Electrical Materials</option>
                        <option value="Plumbing Materials" {{ $purchase->category_name == 'Plumbing Materials' ? 'selected' : '' }}>Plumbing Materials</option>
                        <option value="Finishing Materials" {{ $purchase->category_name == 'Finishing Materials' ? 'selected' : '' }}>Finishing Materials</option>
                        <option value="Structural Steel" {{ $purchase->category_name == 'Structural Steel' ? 'selected' : '' }}>Structural Steel</option>
                        <option value="Concrete & Cement" {{ $purchase->category_name == 'Concrete & Cement' ? 'selected' : '' }}>Concrete & Cement</option>
                        <option value="Insulation Materials" {{ $purchase->category_name == 'Insulation Materials' ? 'selected' : '' }}>Insulation Materials</option>
                        <option value="Paint & Coatings" {{ $purchase->category_name == 'Paint & Coatings' ? 'selected' : '' }}>Paint & Coatings</option>
                        <option value="Flooring Materials" {{ $purchase->category_name == 'Flooring Materials' ? 'selected' : '' }}>Flooring Materials</option>
                        <option value="Roofing Materials" {{ $purchase->category_name == 'Roofing Materials' ? 'selected' : '' }}>Roofing Materials</option>
                        <option value="Wood & Carpentry" {{ $purchase->category_name == 'Wood & Carpentry' ? 'selected' : '' }}>Wood & Carpentry</option>
                        <option value="Glass & Windows" {{ $purchase->category_name == 'Glass & Windows' ? 'selected' : '' }}>Glass & Windows</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Supplier Name</label>
                    <select name="supplier_name" class="input-select">
                        <option value="">Select Supplier</option>
                        <option value="BuildMart" {{ $purchase->supplier_name == 'BuildMart' ? 'selected' : '' }}>BuildMart</option>
                        <option value="CemCo" {{ $purchase->supplier_name == 'CemCo' ? 'selected' : '' }}>CemCo</option>
                        <option value="SteelHub" {{ $purchase->supplier_name == 'SteelHub' ? 'selected' : '' }}>SteelHub</option>
                        <option value="Plumbex" {{ $purchase->supplier_name == 'Plumbex' ? 'selected' : '' }}>Plumbex</option>
                        <option value="TileMax" {{ $purchase->supplier_name == 'TileMax' ? 'selected' : '' }}>TileMax</option>
                        <option value="PaintPro" {{ $purchase->supplier_name == 'PaintPro' ? 'selected' : '' }}>PaintPro</option>
                        <option value="HardZone" {{ $purchase->supplier_name == 'HardZone' ? 'selected' : '' }}>HardZone</option>
                        <option value="FixIt Co." {{ $purchase->supplier_name == 'FixIt Co.' ? 'selected' : '' }}>FixIt Co.</option>
                        <option value="GripTraders" {{ $purchase->supplier_name == 'GripTraders' ? 'selected' : '' }}>GripTraders</option>
                        <option value="ProMat" {{ $purchase->supplier_name == 'ProMat' ? 'selected' : '' }}>ProMat</option>
                        <option value="NovaBuild" {{ $purchase->supplier_name == 'NovaBuild' ? 'selected' : '' }}>NovaBuild</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- New Products --}}
        <div class="section">
            <div class="section-header">New Products</div>
            <div class="section-body three-column">
                <div class="form-group">
                    <label>Material Type</label>
                    <select class="input-select">
                        <option value="Cement">Cement</option>
                        <option value="Bricks">Bricks</option>
                        <option value="Sand">Sand</option>
                        <option value="Steel">Steel</option>
                        <option value="Gravel">Gravel</option>
                        <option value="Tiles">Tiles</option>
                        <option value="Marble">Marble</option>
                        <option value="Wood">Wood</option>
                        <option value="Paint">Paint</option>
                        <option value="Pipes">Pipes</option>
                        <option value="Glass">Glass</option>
                        <option value="Electrical">Electrical</option>
                        <option value="Plumbing">Plumbing</option>
                        <option value="Concrete Blocks">Concrete Blocks</option>
                        <option value="Adhesives">Adhesives</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product</label>
                    <select class="input-select" id="product_name">
                        <option value="Dalmia Cement">Dalmia Cement</option>
                        <option value="ACC Cement">ACC Cement</option>
                        <option value="Ultratech Cement">Ultratech Cement</option>
                        <option value="TMT Steel Bar">TMT Steel Bar</option>
                        <option value="River Sand">River Sand</option>
                        <option value="M-Sand">M-Sand</option>
                        <option value="Red Bricks">Red Bricks</option>
                        <option value="AAC Blocks">AAC Blocks</option>
                        <option value="PVC Pipe">PVC Pipe</option>
                        <option value="Switch Box">Switch Box</option>
                        <option value="Ceramic Tiles">Ceramic Tiles</option>
                        <option value="Wall Putty">Wall Putty</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="button" class="btn-add" onclick="addProduct()">➕</button>
                </div>
            </div>
        </div>

        {{-- Product List --}}
        <div class="section">
            <div class="section-header">Products List</div>
            <div class="section-body">
                <table class="custom-table" id="product_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Gross</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase->details as $index => $detail)
                            <tr>
                                <td>
                                    <input type="hidden" name="products[{{ $index }}][id]" value="{{ $detail->id }}">
                                    <input type="text" name="products[{{ $index }}][product_name]" value="{{ $detail->product_name }}" readonly>
                                </td>
                                <td><input type="number" name="products[{{ $index }}][qty]" class="qty" value="{{ $detail->qty }}"></td>
                                <td><input type="number" name="products[{{ $index }}][price]" class="price" value="{{ $detail->price }}"></td>
                                <td><input type="number" name="products[{{ $index }}][gross_value]" class="gross" value="{{ $detail->gross_value }}" readonly></td>
                                <td><button type="button" class="btn-delete" onclick="removeProduct(this)">🗑️</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Payment Summary --}}
        <div class="section">
            <div class="section-header">Payment</div>
            <div class="section-body payment-grid">
                <div class="form-group">
                    <label>Gross Total</label>
                    <input type="text" name="gross_total" id="gross_total" value="{{ $purchase->gross_total }}" class="input-field crsr-no" readonly>
                </div>
                <div class="form-group">
                    <label>Transport/Freight</label>
                    <input type="text" name="transport_frieght" id="transport_frieght" value="{{ $purchase->transport_frieght }}" class="input-field crsr-no">
                </div>
                <div class="form-group">
                    <label>Loading/Unloading</label>
                    <input type="text" name="loading_unloading_amount" id="loading_unloading" value="{{ $purchase->loading_unloading_amount }}" class="input-field crsr-no">
                </div>
                <div class="form-group">
                    <label>Tax Amount</label>
                    <input type="number" name="tax_amount" id="tax_amount" value="{{ $purchase->tax_amount }}" class="input-field crsr-no" readonly>
                </div>
                <div class="form-group">
                    <label>Net Amount</label>
                    <input type="number" name="net_amount" id="net_amount" value="{{ $purchase->net_amount }}" class="input-field crsr-no" readonly>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="section">
            <div class="section-header">Notes</div>
            <div class="section-body">
                <textarea name="notes" class="input-textarea" rows="3">{{ $purchase->notes }}</textarea>
            </div>
        </div>

        {{-- Submit --}}
        <div class="form-footer">
            <button type="submit" class="btn-submit">Update</button>
        </div>
    </form>
</div>

<script>
    let rowIndex = {{ count($purchase->details) }};

    function addProduct() {
        const product = document.getElementById('product_name').value;
        if (!product) {
            alert("Please select a product");
            return;
        }

        const existingProducts = document.querySelectorAll('input[name^="products"]');
        for (let input of existingProducts) {
            if (input.value === product) {
                alert("This product is already added.");
                return;
            }
        }

        const qty = 1;
        const price = 1;
        const gross = qty * price;

        const table = document.getElementById('product_table').getElementsByTagName('tbody')[0];
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="products[${rowIndex}][product_name]" class="form-control" value="${product}" readonly></td>
            <td><input type="number" name="products[${rowIndex}][qty]" class="form-control qty" value="${qty}"></td>
            <td><input type="number" name="products[${rowIndex}][price]" class="form-control price" value="${price}"></td>
            <td><input type="number" name="products[${rowIndex}][gross_value]" class="form-control gross" value="${gross}" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(this)">🗑️</button></td>
        `;
        table.appendChild(row);
        bindEvents(row);
        rowIndex++;
        updateGrossTotal();
    }

    function bindEvents(row) {
        const qtyInput = row.querySelector('.qty');
        const priceInput = row.querySelector('.price');
        qtyInput.addEventListener('input', () => updateGross(row));
        priceInput.addEventListener('input', () => updateGross(row));
    }

    function updateGross(row) {
        const qty = parseFloat(row.querySelector('.qty').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        const gross = qty * price;
        row.querySelector('.gross').value = gross.toFixed(2);
        updateGrossTotal();
    }

    function removeProduct(btn) {
        const row = btn.closest('tr');
        row.remove();
        updateGrossTotal();
    }

    function updateGrossTotal() {
        const grossInputs = document.querySelectorAll('.gross');
        let grossTotal = 0;

        grossInputs.forEach(input => {
            grossTotal += parseFloat(input.value) || 0;
        });

        document.getElementById('gross_total').value = grossTotal.toFixed(2);

        const transport = parseFloat(document.getElementById('transport_frieght').value) || 0;
        const loading = parseFloat(document.getElementById('loading_unloading').value) || 0;
        const tax = grossTotal * 0.18;

        document.getElementById('tax_amount').value = tax.toFixed(2);
        const net = grossTotal + transport + loading + tax;
        document.getElementById('net_amount').value = net.toFixed(2);
    }

    document.querySelectorAll('#product_table tbody tr').forEach(row => bindEvents(row));
    updateGrossTotal();
</script>

@endsection
