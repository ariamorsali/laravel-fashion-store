<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AmazingSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $amazingSales = AmazingSale::all();
        return view('admin.market.discount.amazing_sale.index', compact('amazingSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing_sale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AmazingSaleRequest $request)
    {
        $inputs = $request->validated();
        if (Carbon::parse($inputs['end_date'])->isPast()) {
            $inputs['status'] = 2; // expired
        }
        $amazingSale = AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with(
            'alert-section-success',
            'Your new common discount was successfully registered.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing_sale.edit', compact('amazingSale' , 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs = $request->validated();
        if (Carbon::parse($inputs['end_date'])->isPast()) {
            $inputs['status'] = 2; // expired
        }
        $amazingSale->update($inputs);
        return redirect(route('admin.market.discount.amazingSale'))->with(
            'alert-section-success',
            'Common discount successfully updated.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale')->with(
            'alert-section-success',
            'Common discount successfully deleted.'
        );
    }
}
