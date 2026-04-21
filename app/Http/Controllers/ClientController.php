<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

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
        // વેલિડેશનમાં નવા ફિલ્ડ્સ ઉમેર્યા છે
        $req->validate([
            'name'           => 'required',
            'phone'          => 'required',
            'address'        => 'nullable',
            'account_holder' => 'nullable',
            'bank_name'      => 'nullable',
            'account_no'     => 'nullable',
            'ifsc_code'      => 'nullable',
        ]);

        // $req->all() વાપરવાથી બધા ફિલ્ડ્સ ઓટોમેટિક સેવ થઈ જશે
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
        // અપડેટ વખતે પણ વેલિડેશન જરૂરી છે
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
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}