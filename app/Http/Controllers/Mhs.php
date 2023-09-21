<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Modelmhs;
use Illuminate\Http\Request;

class Mhs extends Controller{
    public function index(Request $request){
        $cari = $request->query('cari');
        
        if(!empty($cari)){
            $dataMahasiswa = Modelmhs::sortable()
            ->where('mahasiswa.mhsnim', 'like', '%'.$cari.'%')
            ->orWhere('mahasiswa.mhsnama', 'like', '%'.$cari.'%')
            ->paginate(10)->onEachSide(3)->fragment('mahasiswa');
        }else{
            $dataMahasiswa = Modelmhs::sortable()->paginate(10)->onEachSide(3)->fragment('mahasiswa');
        }

        // $data=[
        //     'dataMhs' => Modelmhs::sortable()->paginate(10)->onEachSide(3)->fragment('mahasiswa'),
        // ];
        return View('mahasiswa.data')->with([
            'dataMhs' => $dataMahasiswa,
            'cari' => $cari,
        ]);
    }

    public function add(){
        return View('mahasiswa.formtambah');
    }
    
    public function save(Request $r){
        $nim = $r->nim;
        $nama = $r->nama;
        $telp = $r->telp;
        $alamat = $r->alamat;

        try{

            $validateData = $r->validate([
                'nim' => 'required|unique:mahasiswa,mhsnim',
                'nama' => 'required',
                'telp' => 'required',
                'alamat' => 'required',
                'foto' => 'required|mimes:jpg,png|image|max:2048|dimensions:min_width=500,min_height=500,max_width=1000,max_height=1000',
            ],
            [
                'nim.required' => 'NIM tidak boleh kosong!',
                'nim.unique' => 'NIM sudah ada!',
                'nama.required' => 'Nama Mahasiswa tidak boleh kosong!',
                'telp.required' => 'Nomor Telp tidak boleh kosong!',
                'alamat.required' => 'Alamat tidak boleh kosong!',
                'foto.mimes' => 'File harus berformat jpg atau png!',
                'foto.dimensions' => 'Foto harus berukuran 500x500 pixel!',
                'foto.required' => 'Wajib upload foto!!'
            ]);

            if($r->hasFile('foto')){
                $path = $r->file('foto')->store('uploads');
            }else{
                $path = '';
            }

            $mhs = new Modelmhs;
            $mhs->mhsnim = $nim;
            $mhs->mhsnama = $nama;
            $mhs->mhstelp = $telp;
            $mhs->mhsalamat = $alamat;
            $mhs->mhsfoto = $path;
            $mhs->save();

            $r->session()->flash('msg', "Data dengan $nama Berhasil Tersimpan!");
            return redirect('/mhs/tambah');
            // echo 'Data Sukses Tersimpan';
        } catch (Throwable $e){
            echo $e;
        }
    }

    public function edit($nim){
        $mhs = Modelmhs::find($nim);
        $data = [
            'nim' => $nim,
            'nama' => $mhs->mhsnama,
            'telp' => $mhs->mhstelp,
            'alamat' => $mhs->mhsalamat,
            'foto' => $mhs->mhsfoto,
        ];

        return View('mahasiswa.edit', $data);
    }

    public function update(Request $r){
        $nim = $r->nim;
        $nama = $r->nama;
        $telp = $r->telp;
        $alamat = $r->alamat;

        if($r->hasFile('foto')){
            $path = $r->file('foto')->store('uploads');
        }else{
            $path = '';
        }

        try{
            $mhs = Modelmhs::find($nim);
            $pathFoto = $mhs->mhsfoto;

        if($pathFoto != null || $pathFoto != ''){
            Storage::delete($pathFoto);
        }
            $mhs->mhsnama = $nama;
            $mhs->mhstelp = $telp;
            $mhs->mhsalamat = $alamat;
            $mhs->mhsfoto = $path;
            $mhs->save();

            $r->session()->flash('msg', "Data dengan $nama Berhasil Diupdate!");
            return redirect('/mhs/index');
        } catch (Throwable $e){
            echo $e;
        }
    }

    public function hapus($nim){
        Modelmhs::find($nim)->delete();
        return redirect()->back();
    }
}
