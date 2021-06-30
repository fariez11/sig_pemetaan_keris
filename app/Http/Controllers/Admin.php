<?php

namespace App\Http\Controllers;

use Session;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\keris;
use App\det_keris;
use App\pemilik;
use App\akun;
use App\galeri;


class Admin extends Controller
{
   public function map()
    {
        $data = DB::select("SELECT*FROM keris k, det_keris d,pemiliks p where k.KERIS_ID = d.DETAIL_ID and p.PEMILIK_ID = d.PEMILIK_ID");
        return view('/map',['data'=>$data]);
    }

    public function dash()
    {
    	return view('home');
    }

    public function login()
    {
    	return view('login');
    }

    public function logact(Request $request){
        $username = $request->user;
        $password = $request->pass;
        
        Session::flush();
        $data = DB::table('akuns')->where([['USERNAME',$username],['PASSWORD',$password]])->get();
        foreach ($data as $key) {
            $akun = $key->AKUN_ID;
            $nama = $key->NAMA;
            $level = $key->LEVEL;
        };
        if (count($data) == 0){
            return redirect('/login')->with('error','.');
         }//else if($username AND $password == 0){
        //     return redirect('/login')->with('error2','.');
        // }
        else if($level == 0) {

            Session::put('USERNAME',$username);
            Session::put('PASSWORD',$password);
            Session::put('NAMA',$nama);


            return view('/admin/home',[]);
        }
        else if($level == 1 ) {

            Session::put('USERNAME',$username);
            Session::put('PASSWORD',$password);
            Session::put('NAMA',$nama);
            Session::put('AKUN',$akun);


            $data = DB::table('keris')->get();
            return view('/pemilik/home',['data'=>$data]);
        }
    }

    public function adhome()
    {
        return view('/admin/home');
    }

    public function dtkeris()
    {
        $data = DB::table('keris')->get();
        return view('/admin/dt_keris',['data'=>$data]);
    }

    public function dtmap($id)
    {
        $data = DB::select("SELECT*FROM keris k, det_keris d,pemiliks p where k.KERIS_ID = d.DETAIL_ID and p.PEMILIK_ID = d.PEMILIK_ID and k.KERIS_ID = '$id'");
        return view('/admin/mapid',['data'=>$data]);
    }

    public function tmbker(Request $request)
    {
      $ker_id = $request->id_ker;
      $namk = $request->namak;
      $kec = $request->kec;
      $long = $request->long;
      $lati = $request->lati;

      $namp = $request->nam;
      $jen = $request->jen;
      $ala = $request->alam;
      $gambar = $request->file('gam');
      $namagambar = $gambar->getClientOriginalName();
      $request->file('gam')->move("images/", $namagambar);


    $data = new keris();
        $data->KERIS_ID = $ker_id;
        $data->NAMA = strtoupper($namk);
        $data->KECAMATAN = strtoupper($kec);
        $data->LONGITUDE = $long;
        $data->LATITUDE = $lati;
        $data->save(); 

    $data = new det_keris();
        $data->DETAIL_ID = $ker_id;
        $data->PEMILIK_ID = $namp;
        $data->JENIS = strtoupper($jen);
        $data->ALAMAT = $ala;
        $data->FOTO = $namagambar;
        $data->save();

        return redirect('/data_keris');
    }

    public function edker(Request $request,$id)
    {
        $id = $request->id_ker;
        $nam = $request->nama;
        $kec = $request->kec;
        $long = $request->long;
        $lati = $request->lati;

        $namp = $request->namap;
        $jen = $request->jen;
        $ala = $request->alam;
        $nom = $request->no;

        $gam = DB::SELECT("select*from det_keris where DETAIL_ID = $id");
        foreach ($gam as $key) {
            $image_path = "images/$key->FOTO";  
            if(File::exists($image_path)) {
            File::delete($image_path);
            }
        }

            $photo_path=$request->file('gam');

            $m_path=$photo_path->getClientOriginalName();
            $photo_path->move('images/',$m_path);


        $data = DB::table('keris')->where('KERIS_ID',$id)->update(['NAMA'=>strtoupper($nam),'KECAMATAN'=>strtoupper($kec),'LONGITUDE'=>$long,'LATITUDE'=>$lati]);

        $data = DB::table('det_keris')->where('DETAIL_ID',$id)->update(['PEMILIK_ID'=>strtoupper($namp),'JENIS'=>strtoupper($jen),'ALAMAT'=>$ala,'FOTO'=>"$m_path"]);
        return redirect('/data_keris');
    }

    public function delker($id)
    {
        $gam = DB::SELECT("select*from det_keris where DETAIL_ID = $id");
        foreach ($gam as $key) {
            $image_path = "images/$key->FOTO";  
            if(File::exists($image_path)) {
            File::delete($image_path);
            }
        }

        DB::table('det_keris')->where('DETAIL_ID',$id)->delete();
        DB::table('keris')->where('KERIS_ID',$id)->delete();

        
        return redirect('/data_keris');
    }

    public function dtmilik()
    {
        $data = DB::table('pemiliks')->get();
        return view('/admin/dt_pemilik',['data'=>$data]);
    }

    public function tmbpem(Request $request)
    {
      $pem_id = $request->id_pem;
      $nam = $request->nama;
      $ge = $request->gen;
      $no = $request->no;
      $em = $request->email;

      $us = $request->user;
      $pa = $request->pass;

    $data = new akun();
        $data->AKUN_ID = $pem_id;
        $data->USERNAME = $us;
        $data->PASSWORD = $pa;
        $data->NAMA = ucfirst($nam);
        $data->LEVEL = 1;
        $data->save();

    $data = new pemilik();
        $data->PEMILIK_ID = $pem_id;
        $data->AKUN_ID = $pem_id;
        $data->NAMA_LENGKAP = strtoupper($nam);
        $data->GENDER = $ge;
        $data->NO_TELP = $no;
        $data->EMAIL = $em;
        $data->save(); 

        return redirect('/data_pemilik');
    }

    public function edpem(Request $request,$id)
    {
        $id = $request->id_pem;
        $us = $request->user;
        $pas = $request->pass;
        $nam = $request->namp;

        $id_p = $request->id_pem;
        $namp = $request->namp;
        $ge = $request->gender;
        $no = $request->no;
        $em = $request->email;

        $data = DB::table('akuns')->where('AKUN_ID',$id)->update(['username'=>$us,'PASSWORD'=>$pas,'NAMA'=>ucfirst($nam)]);

        $data = DB::table('pemiliks')->where('PEMILIK_ID',$id_p)->update(['NAMA_LENGKAP'=>strtoupper($namp),'GENDER'=>strtoupper($ge),'NO_TELP'=>$no,'EMAIL'=>$em]);

        return redirect('/data_pemilik');
    }

    public function delpem($id)
    {

        DB::table('pemiliks')->where('PEMILIK_ID',$id)->delete();
        DB::table('akuns')->where('AKUN_ID',$id)->delete();

        
        return redirect('/data_pemilik');
    }



    public function dtgaleri()
    {
        $data = DB::table('galeris')->get();
        return view('/admin/dt_galeri',['data'=>$data]);
    }

    public function tmbgal(Request $request)
    {
      $pem_id = $request->id_gal;
      $nam = $request->nama;
      $gambar = $request->file('gam');
      $namagambar = $gambar->getClientOriginalName();
      $request->file('gam')->move("galeri/", $namagambar);

    $data = new galeri();
        $data->AKUN_ID = $gal_id;
        $data->NAMA = $nama;
        $data->
        $data->save();

        return redirect('/data_galeri');
    }

    public function edgal(Request $request,$id)
    {
        $id = $request->id_gal;
        $nam = $request->nama;

        $gam = DB::SELECT("select*from galeris where GALERU_ID = $id");
        foreach ($gam as $key) {
            $image_path = "galeri/$key->FOTO";  
            if(File::exists($image_path)) {
            File::delete($image_path);
            }
        }

            $photo_path=$request->file('gam');

            $m_path=$photo_path->getClientOriginalName();
            $photo_path->move('galeri/',$m_path);

        $data = DB::table('galeris')->where('GALERI_ID',$id)->update(['ALAMAT'=>$ala,'FOTO'=>"$m_path"]);
        return redirect('/data_pemilik');
    }

    public function delgal($id)
    {

        DB::table('galeris')->where('GALERI_ID',$id)->delete();

        
        return redirect('/data_galeri');
    }






    public function pehome()
    {
        return view('/pemilik/home');
    }

    public function pdtkeris()
    {
        $data = DB::table('keris')->get();
        return view('/pemilik/dt_keris_pem',['data'=>$data]);
    }

    public function ptmbker(Request $request)
    {
      $ker_id = $request->id_ker;
      $namk = $request->namak;
      $kec = $request->kec;
      $long = $request->long;
      $lati = $request->lati;

      $namp = $request->nam;
      $jen = $request->jen;
      $ala = $request->alam;
      $gambar = $request->file('gam');
      $namagambar = $gambar->getClientOriginalName();
      $request->file('gam')->move("images/", $namagambar);


    $data = new keris();
        $data->KERIS_ID = $ker_id;
        $data->NAMA = strtoupper($namk);
        $data->KECAMATAN = strtoupper($kec);
        $data->LONGITUDE = $long;
        $data->LATITUDE = $lati;
        $data->save(); 

    $data = new det_keris();
        $data->DETAIL_ID = $ker_id;
        $data->PEMILIK_ID = $namp;
        $data->JENIS = strtoupper($jen);
        $data->ALAMAT = $ala;
        $data->FOTO = $namagambar;
        $data->save();

        return redirect('/pdata_keris');
    }


    public function pedker(Request $request,$id)
    {
        $id = $request->id_ker;
        $nam = $request->nama;
        $kec = $request->kec;
        $long = $request->long;
        $lati = $request->lati;

        $namp = $request->namap;
        $jen = $request->jen;
        $ala = $request->alam;
        $nom = $request->no;

        $gam = DB::SELECT("select*from det_keris where DETAIL_ID = $id");
        foreach ($gam as $key) {
            $image_path = "images/$key->FOTO";  
            if(File::exists($image_path)) {
            File::delete($image_path);
            }
        }

            $photo_path=$request->file('gam');

            $m_path=$photo_path->getClientOriginalName();
            $photo_path->move('images/',$m_path);


        $data = DB::table('keris')->where('KERIS_ID',$id)->update(['NAMA'=>strtoupper($nam),'KECAMATAN'=>strtoupper($kec),'LONGITUDE'=>$long,'LATITUDE'=>$lati]);

        $data = DB::table('det_keris')->where('DETAIL_ID',$id)->update(['PEMILIK_ID'=>strtoupper($namp),'JENIS'=>strtoupper($jen),'ALAMAT'=>$ala,'FOTO'=>"$m_path"]);
        
        return redirect('/pdata_keris');
    }

    public function pdelker($id)
    {
        $gam = DB::SELECT("select*from det_keris where DETAIL_ID = $id");
        foreach ($gam as $key) {
            $image_path = "images/$key->FOTO";  
            if(File::exists($image_path)) {
            File::delete($image_path);
            }
        }

        DB::table('det_keris')->where('DETAIL_ID',$id)->delete();
        DB::table('keris')->where('KERIS_ID',$id)->delete();

        
        return redirect('/pdata_keris');
    }

}
