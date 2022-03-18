<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    //get product
    public function index()
    {
        # code...
        $data['http_code'] = 200;
        $data['items'] = \App\Models\Product::all();
        return $data;
    }

    //insert product
    public function insert(request $request)
    {
        //proses pembuatan unique signature
        $random = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $noproduct = '';
        for ($i = 0; $i < 10; $i++) {
            $noproduct .= $random[rand(0, strlen($random) - 1)];
        }
        # code...
        //input data
        $product = new Product();
        $product->product_id = $noproduct;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;

        //proses simpan
        $simpan = $product->save();
        if ($simpan) {  //jika data berhasil disimpan
            # code...
            $data['http_code'] = 201;
            $data['message'] = "Insert success";
            $data['item'] = $product;
        } else { //jika data gagal disimpan
            $data['http_code'] = 500;
            $data['message'] = "Insert failed";
        }

        return $data;
    }
}
