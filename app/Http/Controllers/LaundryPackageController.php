<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaundryPackage;

class LaundryPackageController extends Controller
{
    public function index()
    {
        $data = LaundryPackage::all();
        return view('web.laundry_packages.index', compact('data'));
    }

    public function create()
    {
        return view('web.laundry_packages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'duration_day'  => 'required|integer',
        ]);

        LaundryPackage::create([
            'name'          => $request->name,
            'duration_day'  => $request->duration_day,
            'price_per_kg'  => $request->price_per_kg,
            'price_per_pcs' => $request->price_per_pcs,
        ]);

        return redirect()->route('laundry-packages.index')
            ->with('success', 'Paket laundry berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = LaundryPackage::findOrFail($id);
        return view('web.laundry_packages.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = LaundryPackage::findOrFail($id);

        $data->update([
            'name'          => $request->name,
            'duration_day'  => $request->duration_day,
            'price_per_kg'  => $request->price_per_kg,
            'price_per_pcs' => $request->price_per_pcs,
        ]);

        return redirect()->route('laundry-packages.index')
            ->with('success', 'Paket laundry berhasil diupdate');
    }

    public function destroy($id)
    {
        LaundryPackage::findOrFail($id)->delete();

        return redirect()->route('laundry-packages.index')
            ->with('success', 'Paket laundry berhasil dihapus');
    }
}
