<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zakat;
use Illuminate\Support\Carbon;

class ZakatController extends Controller
{
    public function index()
    {
        return view('zakat.dashboard-zakat',['type_menu'=>'dashboard']);
    }

    public function stock()
    {
        return view('zakat.stock-zakat',['type_menu'=>'stock-beras']);
    }

    public function api_insert(Request $request) {
        $data = $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required|string',
            'harga_beras' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        try{
            $data['tanggal_masuk'] = Carbon::now();
            Zakat::create($data);
            return response()->json(['message' => 'Data Stock Beras berhasil ditambahkan'], 201);
        }
        catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage(),
            ]);
        }
    }
    
    public function insert(Request $request) {
        $data = $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required|string',
            'harga_beras' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
    
        try{
            $data['tanggal_masuk'] = Carbon::now();
            Zakat::create($data);
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        }catch(Exception $error){
            return redirect()->back()->withInput()->withErrors($error, 'default');
        }
    }

    public function api_render()
    {
        try {
            $stock = Zakat::all();
            return response()->json([
                'stock' => $stock,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function api_update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'harga_beras' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $zakat = Zakat::find($id);

        if (!$zakat) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $zakat->update($data);

        return response()->json(['message' => 'Data Stock Beras berhasil diperbarui'], 200);
    }

    
    public function api_edit()
    {
        try {

            $this->validate(
                request(),
                [
                    'id_panjang' => 'required',
                    'id_prodi' => 'required|numeric',
                    'prodi' => 'required',
                    'kelompok_bidang' => 'required',
                    'kuota' => 'required|numeric',
                ]
            );

            $zakat = Zakat::find(request('id'));
            if (!$zakat) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            $data                   = ProdiPres::find(request('id'));
            $data->id         = intval(request('id'));
            $data->nama            = request('nama');
            $data->harga_barang  = request('harga_barang');
            $data->stock            = intval(request('stock'));
            $data->save();
            return response()->json([
                'status' => 'Data Stock Beras Berhasil Diedit',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ]);
        }
    }


}
