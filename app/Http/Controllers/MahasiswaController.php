<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();
        return view('dashboard', compact('mahasiswa'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:mahasiswas',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('dashboard')->with([
            'message' => 'Data Mahasiswa Berhasil Ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id){
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('dashboard')->with([
            'message' => 'Data Mahasiswa Berhasil Dihapus',
            'alert-type' => 'warning'
        ]);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|numeric|digits:9|unique:mahasiswa,nim,' . $id,
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
        ]);

        return redirect()->route('dashboard')->with('message', 'Data mahasiswa berhasil diperbarui!');
    }
}
