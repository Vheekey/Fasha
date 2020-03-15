<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    //vendor creates product
    public function uploadProduct(Request $request){
        // $vendorID = $user->id;
        $vendorID = 1;
        $productName = $request->prodName;
        $productDesc = $request->prodDesc;
        $productPrice = $request->prodAmount;
        $productStatus = 'Pending';
        $prodImage = $request->file('prodImage');
        $productImage = rand().'.'.$prodImage->getClientOriginalExtension();
        $prodImage->move(public_path("images"), $productImage);
        $token = $request->_token;

        $validator = \Validator::make($request->all(),[
            'productName' => 'required',
            'productDesc' => 'required',
            'productPrice' => 'required',
            'productImage' => 'required'
        ], [
            'productName.required' => 'Product Name is required',
            'productDesc.required' => 'Describe Product',
            'productPrice.required' => 'Input Price',
            'productImage.required' => 'Choose Image'
        ]);

        $inserted = \DB::table('products')->insert(
            ['vendor_id' => $vendorID, 'productName' => $productName, 'productDesc' => $productDesc, 'productPrice' => $productPrice, 'productStatus' => $productStatus, 'productImage' => $productImage]
        );

        if($inserted < 1){
            return back()->with('error', 'Operation Failed');
        }else{
            return back()->with('success', "Successfully Created");
        }

        
    }

    //Each Vendor Get Product
    public function getProducts(Request $request){
        // $vendorID = $user->id;
        return json_encode($request);
        
        $vendorID = 1;
        
        $token = $request->_token;

        $products = \DB::table('products')->where('vendor_id', '=', '1')
                                            ->get();
        if(empty($products)){
            return back()->with('error', 'No records Found');
        }else{
            return json_encode($products, true);
        }

        
    }
}
