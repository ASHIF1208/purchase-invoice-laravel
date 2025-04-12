<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseMain;
use App\Models\PurchaseDetail;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = PurchaseMain::orderBy('id', 'desc')->get();
        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'category_name' => 'required|string',
            'supplier_name' => 'required|string',
            'products' => 'required|array',
            'products.*.product_name' => 'required|string',
            'products.*.qty' => 'required|numeric',
            'products.*.price' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Calculate totals
            $grossTotal = 0;
            foreach ($request->products as $product) {
                $grossTotal += $product['qty'] * $product['price'];
            }

            $transport = 3000;
            $loading = 2000;
            $tax = $grossTotal * 0.18;
            $netAmount = $grossTotal + $transport + $loading + $tax;

            // Create Purchase Main
            $purchaseMain = PurchaseMain::create([
                'date' => $request->date,
                'category_name' => $request->category_name,
                'supplier_name' => $request->supplier_name,
                'gross_total' => $grossTotal,
                'transport_frieght' => $transport,
                'loading_unloading_amount' => $loading,
                'tax_amount' => $tax,
                'status' => 0,
                'notes' => $request->notes,
            ]);

            // Save purchase details
            foreach ($request->products as $product) {
                PurchaseDetail::create([
                    'purchase_main_id' => $purchaseMain->id,
                    'product_name' => $product['product_name'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                ]);
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('success', 'Purchase saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = PurchaseMain::with('details')->findOrFail($id);
        return view('purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = PurchaseMain::with('details')->findOrFail($id);
        return view('purchase.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category_name' => 'required|string',
            'supplier_name' => 'required|string',
            'products' => 'required|array',
            'products.*.product_name' => 'required|string',
            'products.*.qty' => 'required|integer',
            'products.*.price' => 'required|numeric',
        ]);

        $purchaseMain = PurchaseMain::findOrFail($id);

        // Update the main purchase record
        $purchaseMain->update([
            'date' => $request->date,
            'category_name' => $request->category_name,
            'supplier_name' => $request->supplier_name,
            'gross_total' => $request->gross_total,
            'transport_frieght' => $request->transport_frieght,
            'loading_unloading_amount' => $request->loading_unloading_amount,
            'tax_amount' => $request->tax_amount,
            'notes' => $request->notes,
        ]);

        // Keep track of updated detail IDs
        $updatedIds = [];

        foreach ($request->products as $product) {
            if (isset($product['id'])) {
                // Update existing row
                $detail = PurchaseDetail::find($product['id']);
                if ($detail && $detail->purchase_main_id == $purchaseMain->id) {
                    $detail->update([
                        'product_name' => $product['product_name'],
                        'qty' => $product['qty'],
                        'price' => $product['price'],
                    ]);
                    $updatedIds[] = $detail->id;
                }
            } else {
                // Add new product row
                $newDetail = $purchaseMain->details()->create([
                    'product_name' => $product['product_name'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                ]);
                $updatedIds[] = $newDetail->id;
            }
        }

        // Delete rows not included in updated input
        $purchaseMain->details()->whereNotIn('id', $updatedIds)->delete();

        return redirect()->route('purchase.index')->with('success', 'Purchase updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchase = PurchaseMain::findOrFail($id);
        $purchase->details()->delete(); // delete child rows first
        $purchase->delete(); // then delete main row

        return redirect()->route('purchase.index')->with('success', 'Purchase deleted successfully!');
    }
}
