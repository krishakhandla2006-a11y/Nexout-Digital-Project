<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name'           => 'required',
            'phone'          => 'required',
            'address'        => 'nullable',
            'account_holder' => 'nullable',
            'bank_name'      => 'nullable',
            'account_no'     => 'nullable',
            'ifsc_code'      => 'nullable',
        ]);

        Client::create($req->all());

        return redirect()->route('clients.index')->with('success', 'Client added successfully!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'name'           => 'required',
            'phone'          => 'required',
            'address'        => 'nullable',
            'account_holder' => 'nullable',
            'bank_name'      => 'nullable',
            'account_no'     => 'nullable',
            'ifsc_code'      => 'nullable',
        ]);

        $client = Client::findOrFail($id);
        $client->update($req->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        try {
            $client->delete();
        } catch (QueryException $e) {
            // Jo client par invoices/related records hoy to delete fail thase
            return redirect()->route('clients.index')
                ->with('error', 'This client cannot be deleted because it has related invoices. Please delete those invoices first.');
        }

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}