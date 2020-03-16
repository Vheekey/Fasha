<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
     
    public function adminPending(){
        $products = \DB::table('products')->where('productStatus', '=', 'Pending')
                                            ->get();
        if(empty($products)){
            return back()->with('error', 'No records Found');
        }else{
            $products = json_decode($products, true);
            return response()->view('admin', compact('products'), 200);            
        }
    }


    //admin approve or reject products
    public function adminAction($action, $id){
        
        $stat = \DB::table('products')->where('id', $id)
                                    ->update(['productStatus' => $action]);
        
        if(empty($stat)){
            // return  redirect('admin')->with('error', 'Product already '.$action);
            return  back()->with('error', 'Product already '.$action);
        }else{
            // return  redirect('admin')->with('success', 'Product '.$action);
            return  back()->with('success', 'Product '.$action);
        }
    }

    //admin change product Status
    public function adminAllProducts(){
        $products = \DB::table('products')->get();
        if(empty($products)){
            return response()->view('products', 'No records Found', 200);
        }else{
            $products = json_decode($products, true);
            return response()->view('products', compact('products'), 200);
        }
    }
}
