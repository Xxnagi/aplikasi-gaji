<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Gaji;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Karyawan $karyawan)
    {
        return view('personalia.index', [
            'title' => 'Data Karyawan',
            'data_karyawan' => Karyawan::latest()->filter(request(['search', 'gaji']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personalia.create', [
            'jabatans' => Jabatan::all(),
            'gajis' => Gaji::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => '',
            'nomor_handphone' => 'required',
            'email' => 'required',
            'jabatan_id' => 'required',
            'gaji_id' => 'required'
        ]);

        Karyawan::create($validatedData);

        return redirect('/karyawan')->with('success', 'New karyawan has been added');
        // return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return view('personalia.show', [
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('personalia.edit', [
            'karyawan' => $karyawan,
            'jabatans' => Jabatan::all(),
            'gajis' => Gaji::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $rules = [
            'name' => 'required',
            'nomor_handphone' => 'required',
            'email' => 'required',
            'jabatan_id' => 'required',
            'gaji_id' => 'required'
        ];

        if ($request->slug != $karyawan->slug) {
            $rules['slug'] = '';
        }

        $validatedData = $request->validate($rules);

        Karyawan::where('id', $karyawan->id)->update($validatedData);

        return redirect('/karyawan')->with('success', 'Karyawan has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        Karyawan::destroy($karyawan->id);

        return redirect('/karyawan')->with('success', 'Karyawan has been deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = $slug = SlugService::createSlug(Karyawan::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
