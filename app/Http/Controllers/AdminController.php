<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin get pending products
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


    //admin approve pending products
    public function adminAction($action, $id){
        
        $stat = \DB::table('products')->where('id', $id)
                                    ->update(['productStatus' => $action]);
        
        if(empty($stat)){
            return  redirect('admin')->with('error', 'Product already '.$action);
        }else{
            return  redirect('admin')->with('success', 'Product '.$action);
        }
    }
}
