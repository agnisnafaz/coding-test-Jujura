<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{

    //get user
    public function index()
    {
        # code...
        $data['http_code'] = 200;
        $data['items'] = \App\Models\Pengguna::all();
        return $data;
    }

    //register user
    public function register(request $request)
    {
        # code...

        //proses pembuatan unique signature
        $random = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $signature = '';
        for ($i = 0; $i < 10; $i++) {
            $signature .= $random[rand(0, strlen($random) - 1)];
        }

        //input data
        $pengguna = new Pengguna;
        $pengguna->user_name = $request->user_name;
        $pengguna->user_email = $request->user_email;
        $pengguna->signature_key = $signature;

        //proses simpan
        $simpan = $pengguna->save();
        if ($simpan) { //jika data berhasil disimpan
            # code...
            $data['http_code'] = 201;
            $data['message'] = "Register success, please remember you SIGNATURE KEY";
            $data['signature_key'] = $signature;
        } else { //jika data gagal disimpan
            $data['http_code'] = 500;
            $data['message'] = "Register failed";
        }

        return $data;
    }
}
