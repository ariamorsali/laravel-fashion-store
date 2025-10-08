<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function index()
    {
        $colors = ProductColor::all();
        return view('admin.market.product.color.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.market.product.color.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'hex_code' => [
                'required',
                'regex:/^#[0-9A-Fa-f]{6}$/'
            ],
        ]);
        $inputs = $request->all();
        $color = ProductColor::create($inputs);
        return redirect()->route('admin.market.color.index')->with(
            'alert-section-success',
            'Your new color has been successfully registered.'
        );
    }

    public function destroy(ProductColor $color)
    {
        $color->delete();
        return redirect()->route('admin.market.color.index')->with(
            'alert-section-success',
            'Color successfully removed.'
        );
    }
}
