<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zakat;
use App\Models\AkadZakat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AkadZakatExport;
use App\Exports\StockExport;


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

    public function transaksi()  {
        $stock_beras = Zakat::all();
        return view('zakat.transaksi-zakat',['type_menu'=>'transaksi-zakat'],compact('stock_beras'));
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

    
    public function api_edit(Request $request)
    {
        try {
            
            $data = $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required|string',
            'harga_beras' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        // dd("hello");
            $zakat = Zakat::find(request('id'));
            if (!$zakat) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            $data                   = Zakat::find(request('id'));
            $data->id         = intval(request('id'));
            $data->nama            = request('nama');
            $data->harga_beras  = request('harga_beras');
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

    public function api_delete(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|numeric',
            ]);

            Zakat::find(request('id'))->delete();

            return response()->json([
                'status' => 'Data Stock Beras Berhasil Dihapus',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ]);
        }
    }

    public function insertAkadZakat(Request $request)
{
    // Validate the form data
    $request->validate([
        // Add validation rules for your form fields
    ]);
    try{
        // Create a new AkadZakat instance
        $akadZakat = new AkadZakat();

        // Set the values based on the form input
        $akadZakat->id_akad = $request->id_akad;
        $akadZakat->nama_muzzaki = $request->nama;
        $akadZakat->tanggal_akad = now(); // or use your preferred timestamp

        // Handle different cases based on jenis_zakat
        switch ($request->jenis_zakat) {
            case 'Fidyah':
                $akadZakat->nama_amil = $request->nama_amil;
                $akadZakat->harga_beras = null;
                $akadZakat->jumlah_keluarga = $request->jumlah_keluarga;
                $akadZakat->jumlah_literan = null;
                $akadZakat->jumlah_uang = $request->jumlah_uang;
                $akadZakat->jenis_akad = $request->jenis_akad;
                $akadZakat->jenis_zakat = $request->jenis_zakat;
                break;

            case 'Fitrah':
                if ($request->jenis_akad === 'Tunai') {
                    $akadZakat->harga_beras = $request->harga_beras;
                    $akadZakat->jumlah_keluarga = $request->jumlah_keluarga;
                    $akadZakat->jumlah_literan = null;
                    $akadZakat->jumlah_uang = $request->jumlah_uang;
                    $akadZakat->jenis_akad = $request->jenis_akad;
                    $akadZakat->jenis_zakat = $request->jenis_zakat;
                    $akadZakat->nama_amil = $request->nama_amil;
                    
                    // Update stock_beras
                    $stockBeras = Zakat::where('harga_beras', $request->harga_beras)->first();
                    if ($stockBeras) {
                        $stockBeras->stock -= $request->jumlah_literan;
                        $stockBeras->save();
                    }
                } elseif ($request->jenis_akad === 'Beras') {
                    $akadZakat->jenis_zakat = $request->jenis_zakat;
                    $akadZakat->nama_amil = $request->nama_amil;
                    $akadZakat->harga_beras = null;
                    $akadZakat->jumlah_keluarga = $request->jumlah_keluarga;
                    $akadZakat->jumlah_literan = $request->jumlah_literan;
                    $akadZakat->jenis_akad = $request->jenis_akad;
                }
                break;
        }

        // Save the AkadZakat instance
        // dd($akadZakat);
        $akadZakat->save();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }catch(Exception $error){
        return redirect()->back()->withInput()->withErrors($error, 'default');
    }
}

    public function api_renderTransaksi()
    {
        try {
            $akad = AkadZakat::all();
            return response()->json([
                'akad' => $akad,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function exportExcel()
    {

        // return Excel::download(new AkadZakatExport, 'akad_zakat.xlsx');
        $headers = [
            'ID Akad',
            'Nama Muzzaki',
            'Nama Amil',
            'Harga Beras',
            'Jumlah Jiwa',
            'Jumlah Literan',
            'Tanggal Akad',
            'Jumlah Uang',
            'Jenis Zakat',
            'Jenis Akad',
        ];
    
        $export = new AkadZakatExport($headers);
    
        return Excel::download($export, 'akad_zakat.xlsx');
    }

    public function exportExcelStock()
    {

        // return Excel::download(new AkadZakatExport, 'akad_zakat.xlsx');
        $headers = [
            'No',
            'Nama',
            'Harga Beras',
            'Stock',
            'Tanggal Masuk'
        ];
    
        $export = new StockExport($headers);
    
        return Excel::download($export, 'stock_beras.xlsx');
    }





}
