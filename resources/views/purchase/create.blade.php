@extends('layouts.app')

@section('content')
    <div class="text-end">
        <h2>Purchase Invoice List</h2>
    </div>
@if ($errors->any())
    <div class="custom-alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('purchase.store') }}" method="POST" class="purchase-form">
    @csrf

    {{-- Category & Supplier --}}
    <div class="section">
        <div class="section-header">
            <span>Category & Supplier</span>
            <input type="date" name="date" class="input-date" value="{{ date('Y-m-d') }}">
        </div>
        <div class="section-body two-column">
            <div class="form-group">
                <label>Category</label>
                <select name="category_name" class="input-select">
                    <option value="Civil Materials">Civil Materials</option>
                    <option value="Electrical Materials">Electrical Materials</option>
                    <option value="Plumbing Materials">Plumbing Materials</option>
                    <option value="Finishing Materials">Finishing Materials</option>
                    <option value="Structural Steel">Structural Steel</option>
                    <option value="Concrete & Cement">Concrete & Cement</option>
                    <option value="Insulation Materials">Insulation Materials</option>
                    <option value="Paint & Coatings">Paint & Coatings</option>
                    <option value="Flooring Materials">Flooring Materials</option>
                    <option value="Roofing Materials">Roofing Materials</option>
                    <option value="Wood & Carpentry">Wood & Carpentry</option>
                    <option value="Glass & Windows">Glass & Windows</option>
                </select>
            </div>
            <div class="form-group">
                <label>Supplier Name</label>
                <select name="supplier_name" class="input-select">
                    <option value="">Select Supplier</option>
                    <option value="BuildMart">BuildMart</option>
                    <option value="CemCo">CemCo</option>
                    <option value="SteelHub">SteelHub</option>
                    <option value="Plumbex">Plumbex</option>
                    <option value="TileMax">TileMax</option>
                    <option value="PaintPro">PaintPro</option>
                    <option value="HardZone">HardZone</option>
                    <option value="FixIt Co.">FixIt Co.</option>
                    <option value="GripTraders">GripTraders</option>
                    <option value="ProMat">ProMat</option>
                    <option value="NovaBuild">NovaBuild</option>
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

    {{-- Products List --}}
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
                    <!-- Dynamic Rows -->
                </tbody>
            </table>
        </div>
    </div>

    {{-- Payment --}}
    <div class="section">
        <div class="section-header">Payment</div>
        <div class="section-body payment-grid">
            <div class="form-group">
                <label>Gross Total</label>
                <input type="text" name="gross_total" id="gross_total" class="input-field crsr-no" readonly>
            </div>
            <div class="form-group">
                <label>Transport/Freight</label>
                <input type="text" name="transport_frieght" id="transport_frieght" class="input-field crsr-no" value="3000" readonly>
            </div>
            <div class="form-group">
                <label>Loading/Unloading</label>
                <input type="text" name="loading_unloading_amount" id="loading_unloading" class="input-field crsr-no" value="2000" readonly>
            </div>
            <div class="form-group">
                <label>Tax Amount</label>
                <input type="number" name="tax_amount" id="tax_amount" class="input-field crsr-no" readonly>
            </div>
            <div class="form-group">
                <label>Net Amount</label>
                <input type="number" name="net_amount" id="net_amount" class="input-field input-bold crsr-no" readonly>
            </div>
        </div>
    </div>

    {{-- Notes --}}
    <div class="section">
        <div class="section-header">Notes</div>
        <div class="section-body">
            <textarea name="notes" class="input-textarea" rows="3" placeholder="No Notes"></textarea>
        </div>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn-save">Save</button>
    </div>
</form>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let rowIndex = 0;

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
            <td><input type="text" name="products[${rowIndex}][product_name]" class="" value="${product}" readonly></td>
            <td><input type="number" name="products[${rowIndex}][qty]" class="qty" value="${qty}"></td>
            <td><input type="number" name="products[${rowIndex}][price]" class="price" value="${price}"></td>
            <td><input type="number" name="products[${rowIndex}][gross_value]" class="gross" value="${gross}" readonly></td>
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

        const transport = 3000;
        const loading = 2000;
        const tax = grossTotal * 0.18;

        document.getElementById('transport_frieght').value = transport;
        document.getElementById('loading_unloading').value = loading;
        document.getElementById('tax_amount').value = tax.toFixed(2);

        const net = grossTotal + transport + loading + tax;
        document.getElementById('net_amount').value = net.toFixed(2);
    }
</script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33'
        });
    @endif
</script>

@endsection
