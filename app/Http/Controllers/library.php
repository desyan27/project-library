<?php

namespace App\Http\Controllers;

use App\Models\Library as ModelsLibrary;
use Illuminate\Http\Request;

class library extends Controller
{
    public function index(){
       $rekening = ModelsLibrary::all();
       return view('library', ['rekening'=>$rekening, 'title'=>'Data Rekening']);
    }

    public function store(Request $request){
        $rekening = new ModelsLibrary();
        $rekening->namaRekening = $request->nmrek;
        $rekening->saldoAwal = $request->sa;
        $rekening->save();
        return back()->with('berhasil', 'Data rekening berhasil ditambahkan');
    }

    public function edit(Request $request){
        $rekening = ModelsLibrary::findOrFail($request->idrek);
        $rekening->namaRekening = $request->nmrek1;
        $rekening->saldoAwal = $request->sa1;
        $rekening->update();
        return back()->with('berhasil','Data rekening berhasil diupdate');
    }

    public function delete(Request $request){
        $rekening = ModelsLibrary::findOrFail($request->id);
        $rekening->delete();
        return back()->with('berhasil','Data rekening berhasil dihapus');
    }
}
