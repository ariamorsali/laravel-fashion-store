<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\WarehouseTransaction;
use Illuminate\Http\Request;

class WarehouseTransactionController extends Controller
{
   public function index()
   {
    $transactions = WarehouseTransaction::all();
        return view('admin.market.warehouse.warehouse-transaction.index', compact('transactions'));
   }
}
