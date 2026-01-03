<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaundryType;

class LaundryTypeController extends Controller
{
    public function index()
    {
        $data = LaundryType::all();
        return view('web.laundry_types.index', compact('data'));
    }

    public function create()
    {
        return view('web.laundry_types.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:laundry_types',
            'name' => 'required',
        ]);

        LaundryType::create([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'is_weight_based' => $request->is_weight_based
        ]);

        return redirect()->route('laundry-types.index')
            ->with('success', 'Tipe laundry berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = LaundryType::findOrFail($id);
        return view('web.laundry_types.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = LaundryType::findOrFail($id);

        $data->update([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'is_weight_based' => $request->is_weight_based
        ]);

        return redirect()->route('laundry-types.index')
            ->with('success', 'Tipe laundry berhasil diupdate');
    }

    public function destroy($id)
    {
        LaundryType::findOrFail($id)->delete();

        return redirect()->route('laundry-types.index')
            ->with('success', 'Tipe laundry berhasil dihapus');
    }
}
