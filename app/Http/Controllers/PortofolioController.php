<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPortofolio'] = Portofolio::all();
		return view('admin.portofolio.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portofolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['Judul'] = $request->Judul;
		$data['Deskripsi'] = $request->Deskripsi;
		$data['Tahun'] = $request->Tahun;
		$data['Link'] = $request->Link;
		$data['Foto'] = $request->Foto;

        if ($request->hasFile('Foto')) {
            $data['Foto'] = $request->file('Foto')->store('portofolio', 'public');
        }

		Portofolio::create($data);

		return redirect()->route('portofolio.index')->with('success','Penambahan Data Berhasil!');
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
    public function edit(string $id)
    {
        $data['dataPortofolio'] = Portofolio::findOrFail($id);
        return view('admin.portofolio.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $porto = Portofolio::findOrFail($id);

        $porto->Judul     = $request->Judul;
        $porto->Deskripsi = $request->Deskripsi;
        $porto->Tahun     = $request->Tahun;
        $porto->Link      = $request->Link;

        if ($request->hasFile('Foto')) {
            if ($porto->Foto && Storage::disk('public')->exists($porto->Foto)) {
                Storage::disk('public')->delete($porto->Foto);
            }

            $porto->Foto = $request->file('Foto')->store('portofolio', 'public');
        }

        $porto->save();

        return redirect()->route('portofolio.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $porto = Portofolio::findOrFail($id);

        $porto->delete();
        return redirect()->route('portofolio.index')->with('success','Data berhasil dihapus');
    }
}
