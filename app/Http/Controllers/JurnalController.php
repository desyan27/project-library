<?php

namespace App\Http\Controllers;

use App\Models\jurnal;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function index(){
        $jurnal = DB::table('jurnals')
                ->leftJoin('libraries','jurnals.id_rekening','=','libraries.id')
                ->select('jurnals.*','libraries.namaRekening')->get();
        return view('jurnal', ['title'=>'Data Jurnal', 'jurnal'=> $jurnal]);
    }

    public function addJurnal(){
        $rekening = Library::all();
        return view('addjurnal', ['title'=>'Add Jurnal', 'rekening'=> $rekening]);
    }

    public function create(Request $request){
        $request->validate([
            'addmore.*.idrek'=>'required',
        ]);

        foreach ($request->addmore as $key => $value) {
            jurnal::create([
                'tgl_jurnal'=> $request->tgl_jurnal,
                'id_rekening'=>$value['idrek'],
                'keterangan'=> $request->keterangan,
                'debet'=> $value['debet'],
                'kredit'=>$value['kredit']
            ]);
        }
        return back()->with('berhasil','Data jurnal berhasil disimpan');
    }

    public function delete(Request $request){
        $jurnal = jurnal::findOrFail($request->id);
        $jurnal->delete();
        return back()->with('berhasil', 'Data jurnal berhasil dihapus');
    }
}
