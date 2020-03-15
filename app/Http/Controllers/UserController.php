<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //display only approved products
    public function viewProducts(){
        $products = \DB::table('products')->where('productStatus', '=', 'Approved')
                                        ->get();
        if(empty($products)){
            return response()->view('welcome', 'No products Found', 200);
        }else{
            $products = json_decode($products, true);
            return response()->view('welcome', compact('products'), 200);
        }
    }
}
