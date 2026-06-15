<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // ================= CREATE =================
    public function create()
    {
        $clients = Client::all();
        return view('invoice.create', compact('clients'));
    }

    // ================= STORE =================
    public function store(Request $req)
    {
        $req->validate([
            'client_id' => 'required',
            'invoice_no' => 'required|unique:invoices,invoice_no',
            'invoice_date' => 'required|date', // ✅ date validation
            'amount' => 'required|numeric|min:1',
            'description' => 'required',
        ]);

        $total = $req->amount;

        Invoice::create([
            'client_id' => $req->client_id,
            'invoice_no' => $req->invoice_no,
            'invoice_date' => $req->invoice_date, // ✅ save date
            'amount' => $req->amount,
            'description' => $req->description,
            'gst' => 0,
            'total' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Invoice generated!');
    }

    // ================= EDIT FORM =================
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $clients = Client::all();
        return view('invoice.edit', compact('invoice', 'clients'));
    }

    // ================= UPDATE =================
    public function update(Request $req, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $req->validate([
            'client_id' => 'required',
            'invoice_no' => 'required|unique:invoices,invoice_no,' . $invoice->id,
            'invoice_date' => 'required|date', // ✅ date validation
            'amount' => 'required|numeric|min:1',
            'description' => 'required',
        ]);

        $total = $req->amount;

        $invoice->update([
            'client_id' => $req->client_id,
            'invoice_no' => $req->invoice_no,
            'invoice_date' => $req->invoice_date, // ✅ save date
            'amount' => $req->amount,
            'description' => $req->description,
            'total' => $total,
        ]);

        return redirect()->route('dashboard')->with('success', 'Invoice updated successfully!');
    }

    // ================= DESTROY (DELETE) =================
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('dashboard')->with('success', 'Invoice deleted successfully!');
    }

    // ================= MARK AS PAID =================
    public function paid($id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->status = 'paid';
        $inv->save();
        return back()->with('success', 'Invoice marked as paid!');
    }

    // ================= DOWNLOAD PDF =================
    public function download($id)
    {
        $invoice = Invoice::with('client')->findOrFail($id);
        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_no . '.pdf');
    }
}