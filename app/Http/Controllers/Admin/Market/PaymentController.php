<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(20);
        return view('admin.market.payment.index', compact('payments'));
    }


    public function show(Payment $payment)
    {
        return view('admin.market.payment.show', compact('payment'));
    }

    public function filter(Request $request)
    {
        if ($request->has('sort')) {
            switch ($request->sort) {
                case '1':
                    $payments = Payment::where('status', 'paid')->paginate(20);
                    break;
                case '2':
                    $payments = Payment::where('status', 'unpaid')->paginate(20);
                    break;
                case '3':
                    $payments = Payment::where('status', 'failed')->paginate(20);
                    break;
                case '4':
                    $payments = Payment::where('status', 'returned')->paginate(20);
                    break;
                default:
                    $payments = Payment::orderBy('created_at', 'DESC')->paginate(20);
                    break;
            }
        } else {
            $payments = Payment::orderBy('created_at', 'DESC')->paginate(20);
        }
        return  view("admin.market.payment.index", compact('payments'));
    }

    public function changePaymentStatus(Payment $payment)
    {
        switch ($payment->status) {
            case 'unpaid':
                $payment->status = 'paid';
                break;
            case 'paid':
                $payment->status = 'failed';
                break;
            case 'failed':
                $payment->status = 'returned';
                break;
            default:
                $payment->status = 'unpaid';
                break;
        }
        $payment->save();
        return back()->with(
            'alert-section-success',
            'Payment status successfully updated.'
        );
    }
}
