<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zakat;
use App\Models\User;
use App\Models\AkadZakat;
use App\Models\RecapZakat;
use App\Models\MustahikZakat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AkadZakatExport;
use App\Exports\StockExport;
use App\Exports\RekapExport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ZakatController extends Controller
{
    public function index()
    {
        return view('zakat.dashboard-zakat',['type_menu'=>'dashboard']);
    }

    public function stock()
    {
        // return view('',['type_menu'=>'stock-beras']);
        $lastStockBeras = Zakat::orderBy('id', 'desc')->first();
        $newId = $lastStockBeras ? $lastStockBeras->id + 1 : 1;
        // dd($newId);
        return view('zakat.stock-zakat', [
            'type_menu'=>'stock-beras',
            'newId' => $newId,
        ]);
    }

    public function transaksi()  {
        $stock_beras = Zakat::orderBy('harga_beras', 'asc')->get();
        $lastAkad = AkadZakat::orderBy('id_akad', 'desc')->first();
        $newIdAkad = $lastAkad ? $this->generateNextIdAkad($lastAkad->id_akad) : 'ZMAH-001';
        // return view('zakat.transaksi-zakat',['type_menu'=>'transaksi-zakat'],compact('stock_beras'));
        return view('zakat.transaksi-zakat', [
            'type_menu' => 'transaksi-zakat',
            'stock_beras' => $stock_beras,
            'newIdAkad' => $newIdAkad,
        ]);
    }

    public function amil()
    {
        $userDivision = Session::get('divisi');

        // Retrieve users with the same division
        $users = User::where('divisi', $userDivision)->get();
        // dd($users);
        $lastUsers = User::orderBy('id', 'desc')->first();
        $newIdAmil = $lastUsers ? $this->generateNextIdAmil($lastUsers->id) : 'MAH-001';
        // dd($newIdAmil);
        return view('zakat.amil-zakat',[
            'type_menu'=>'amil',
            'newIdAmil'=>$newIdAmil,
        ]);
    }

    public function mustahik() {
        $lastUsers = MustahikZakat::orderBy('id_mustahik', 'desc')->first();
        $newIdMustahik = $lastUsers ? $this->generateNextIdMustahik($lastUsMustahik>id) : 'MMAH-001';
        return view('zakat.mustahik-zakat',[
            'type_menu' => 'mustahik-zakat',
            'newIdMustahik'=>$newIdMustahik,
        ]);
    }
    
    public function rekap()  {
        // $stock_beras = Zakat::orderBy('harga_beras', 'asc')->get();
        // $lastAkad = AkadZakat::orderBy('id_akad', 'desc')->first();
        // $newIdAkad = $lastAkad ? $this->generateNextIdAkad($lastAkad->id_akad) : 'ZMAH-001';
        // return view('zakat.transaksi-zakat',['type_menu'=>'transaksi-zakat'],compact('stock_beras'));
        $years = RecapZakat::distinct('tahun')->pluck('tahun');
        return view('zakat.rekap-zakat', [
            'type_menu' => 'rekap',
            'years' => $years,
            // 'stock_beras' => $stock_beras,
            // 'newIdAkad' => $newIdAkad,
        ]);
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
            $stock = Zakat::orderBy('harga_beras')->get();
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
        
        // Create a new AkadZakat instance
        $recapZakat = new RecapZakat();
    
        // Set the values based on the form input
        $recapZakat->id_akad = $request->id_akad;
        $recapZakat->nama_muzzaki = $request->nama;
        $recapZakat->tanggal_akad = now(); // or use your preferred 
        $recapZakat->tahun = now()->year;
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
                //recap zakat
                $recapZakat->harga_beras = null;
                $recapZakat->jumlah_keluarga = $request->jumlah_keluarga;
                $recapZakat->jumlah_literan = null;
                $recapZakat->jumlah_uang = $request->jumlah_uang;
                $recapZakat->jenis_akad = $request->jenis_akad;
                $recapZakat->jenis_zakat = $request->jenis_zakat;
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
                    
                    //recap zakat
                    $recapZakat->harga_beras = $request->harga_beras;
                    $recapZakat->jumlah_keluarga = $request->jumlah_keluarga;
                    $recapZakat->jumlah_literan = null;
                    $recapZakat->jumlah_uang = $request->jumlah_uang;
                    $recapZakat->jenis_akad = $request->jenis_akad;
                    $recapZakat->jenis_zakat = $request->jenis_zakat;

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

                    //recap zakat
                    $recapZakat->jenis_zakat = $request->jenis_zakat;
                    $recapZakat->harga_beras = null;
                    $recapZakat->jumlah_keluarga = $request->jumlah_keluarga;
                    $recapZakat->jumlah_literan = $request->jumlah_literan;
                    $recapZakat->jenis_akad = $request->jenis_akad;
                }
                break;
        }

        // Save the AkadZakat instance
        // dd($akadZakat);
        $akadZakat->save();
        $recapZakat->save();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }catch(Exception $error){
        return redirect()->back()->withInput()->withErrors($error, 'default');
    }
}

    public function api_renderTransaksi()
    {
        try {
            $akad = AkadZakat::orderBy('id_akad')->get();
            // $stock = Zakat::orderBy('harga_beras')->get();
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

    public function exportExcelRekap(Request $request)
    {
        // $selectedYear = $request->query('selectedYear');
        $selectedYear = $request->input('selectedYear');

        // Check if a year is selected
    //    dd($selectedYear);

        // Define the headers for the export
        $headers = [
            'ID Akad',
            'Nama Muzzaki',
            'Jenis Zakat',
            'Jenis Akad',
            'Jumlah Literan',
            'Jumlah Uang',
            'Harga Beras',
            'Jumlah Jiwa',
            'Tanggal Akad',
            'Tahun Rekap',
        ];

        // Get the data based on the selected year
        $data = RecapZakat::where('tahun', $selectedYear)->get();
        // dd($data);
        // Create an instance of the export and download it
        $export = new RekapExport($headers, $selectedYear, $data);
        $filePath = 'exports/Rekap_akad_zakat.xlsx';
        Excel::store($export, $filePath);
    
        // Return a redirect response with success message
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan')->with('file_path', $filePath);
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

    private function generateNextIdAkad($lastIdAkad)
    {
        // Get the highest id_akad from the database
        $lastIdAkad = AkadZakat::max('id_akad');

        // If there are no existing records, start from ZMAH-001
        if (!$lastIdAkad) {
            return 'ZMAH-001';
        }

        // Extract the numeric part
        $numericPart = intval(substr($lastIdAkad, 5));

        // Increment the numeric part
        $numericPart++;

        // Pad the numeric part with leading zeros
        $paddedNumericPart = str_pad($numericPart, 3, '0', STR_PAD_LEFT);

        // Combine with the prefix
        return 'ZMAH-' . $paddedNumericPart;
    }

    private function generateNextIdAmil($lastIdAmil)
    {
        // Get the highest id_akad from the database
        $lastIdAmil = User::max('id');

        // If there are no existing records, start from ZMAH-001
        if (!$lastIdAmil) {
            return 'MAH-001';
        }

        // Extract the numeric part
        $numericPart = intval(substr($lastIdAmil, 5));

        // Increment the numeric part
        $numericPart++;

        // Pad the numeric part with leading zeros
        $paddedNumericPart = str_pad($numericPart, 3, '0', STR_PAD_LEFT);

        // Combine with the prefix
        return 'MAH-' . $paddedNumericPart;
    }

    private function generateNextIdMustahik($lastIdMustahik)
    {
        // Get the highest id_akad from the database
        $lastIdAmil = MustahikZakat::max('id');

        // If there are no existing records, start from ZMAH-001
        if (!$lastIdAmil) {
            return 'MMAH-001';
        }

        // Extract the numeric part
        $numericPart = intval(substr($lastIdAmil, 5));

        // Increment the numeric part
        $numericPart++;

        // Pad the numeric part with leading zeros
        $paddedNumericPart = str_pad($numericPart, 3, '0', STR_PAD_LEFT);

        // Combine with the prefix
        return 'MMAH-' . $paddedNumericPart;
    }

    public function api_renderAmil()
    {
        try {
            $userDivision = Session::get('divisi');

            // Retrieve users with the same division
            $users = User::where('divisi', 'Zakat')->orderBy('id', 'asc')->get();
            // dd($users);
            return response()->json([
                'users' => $users,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function addAmil(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        try {
            // Create a new Amil instance
            $amil = new User([
                'id'=>$request->input('id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 'Anggota Amil',
                'divisi' => 'Zakat',
                'email_verified_at' => null,
                'remember_token' => null,
            ]);

            // Save the Amil instance
            $amil->save();

            return redirect()->back()->with('success', 'Amil berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return redirect()->back()->with('error', 'Gagal menambahkan Amil. ' . $e->getMessage());
        }
    }

    public function api_editAmil(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . request('id') . '|max:255',
                'password' => 'required|string|min:8',
            ]);

            $user = User::find(request('id'));

            if (!$user) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            return response()->json([
                'status' => 'Data Stock Beras Berhasil Diedit',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ]);
        }
    }

    public function api_deleteAmil(Request $request)
    {
        try {
            User::find(request('id'))->delete();

            return response()->json([
                'status' => 'Data Stock Beras Berhasil Dihapus',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ]);
        }
    }

    public function api_renderRekap(Request $request)
    {
        try {
            $selectedYear = $request->input('selectedYear');
            $query = RecapZakat::orderBy('tanggal_akad','asc')->get(); // Replace 'your_column_name' with the actual column name for ordering.

            return response()->json([
                'rekapZakat' => $query,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function downloadRekapExcel()
    {
        $filePath = 'exports/Rekap_akad_zakat.xlsx';

        // Check if the file exists
        $response = new BinaryFileResponse(storage_path('app/' . $filePath));

        // Optionally set the file download name
        // $response->setContentDisposition("attachment; filename=" . basename($filePath));

        return $response;
    }





}
