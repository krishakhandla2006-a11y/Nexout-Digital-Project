<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class InvoiceController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        return view('invoice.create', compact('clients'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'client_id' => 'required',
            'invoice_no' => 'required|unique:invoices,invoice_no', // ✅ add
            'amount' => 'required|numeric|min:1',
            'description' => 'required',
        ]);

        $total = $req->amount;

        Invoice::create([
            'client_id' => $req->client_id,
            'invoice_no' => $req->invoice_no, // ✅ manual
            'amount' => $req->amount,
            'description' => $req->description,
            'gst' => 0,
            'total' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Invoice generated!');
    }

    public function paid($id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->status = 'paid';
        $inv->save();
        return back()->with('success', 'Invoice marked as paid!');
    }

    public function download($id)
    {
        $invoice = Invoice::with('client')->findOrFail($id);
        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_no . '.pdf');
    }
}