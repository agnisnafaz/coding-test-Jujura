<?php

namespace App\Http\Controllers;

use App\Models\DetailSales;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    //sales insert
    public function salesinsert(Request $request)
    {
        # code...
        //insert data
        $sales = new Sales();
        $sales->sales_id = $request->sales_id;
        $sales->signature_key = $request->signature_key;
        $sales->payment_type = $request->payment_type;
        $sales->currency = $request->currency;
        $sales->gross_amount = $request->gross_amount;


        $simpan_sales = $sales->save(); //menyimpan data

        if ($simpan_sales) { //jika penyimpanan berhasil
            # code...
            $detail = $request->detail_sales;
            $final_data = [];

            if ($detail) { //jika datanya ada maka akan diambil
                # code...
                foreach ($detail as $item) {
                    if ($item != null) {
                        # code...
                        array_push($final_data, array(
                            "sales_id" => $sales->sales_id,
                            "item_id" => $item['item_id'],
                            "qty" => $item['qty'],
                            "price" => $item['price'],
                            "total" => $item['total'],
                        ));
                    } //push data ke array
                }

                $simpan_detailsales = DetailSales::insert($final_data);
                if ($simpan_detailsales) { //jika penyimpanan berhasil
                    # code...
                    $data['htpp_code'] = 201;
                    $data['sales_id'] = $sales->sales_id;
                    $data['message'] = "Sales was inserted";
                } else { //jika gagal menyimpan
                    $data['htpp_code'] = 500;
                    $data['message'] = "Sales was not inserted";
                }
            } else { //jika datanya tidak ada
                $data['status'] = 500;
                $data['message'] = "No Data";
            }
        } else { //penyimpanan gagal
            $data['htpp_code'] = 500;
            $data['message'] = "Try Again";
        }
        return $detail;
    }
}
