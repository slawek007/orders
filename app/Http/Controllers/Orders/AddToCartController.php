<?php

namespace App\Http\Controllers\Orders;

use App\PurchaseCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AddToCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = PurchaseCart::where(['user_id'=>$user->id])->get();
        if ($cart == false){
            //dodajemy
        }
        //dd($cart->firstWhere('product_id',$request->productId)->count());
        //dd($cart->first()->supplier_id);
        //dd(Lang::get('products.otherSupplier'));
        if (($cart->count()>0) && ($cart->first()->supplier_id !== $request->supplierId)){
            //dd('Nie mogę dodać bo w bazie jest inny dostawca');
            return response()->json([
                'status' => 'error',
                'statusDescription' => Lang::get('products.otherSupplier')
            ]);
        }

        if (($cart->count()>0) && ($cart->firstWhere('product_id',$request->productId))){
           // dd('sorry the same product in database');
            return response()->json([
                'status' => 'success',
                'statusDescription' => Lang::get('products.sameProduct')
            ]);
        }
        $addTocart = PurchaseCart::create([
            'user_id'=>$user->id,
            'product_id'=>$request->productId,
            'product_short_description'=>$request->productShortDescription,
            'supplier_id'=>$request->supplierId
        ]);

        if ($addTocart->save()){
            return response()->json([
                'status' => 'success',
                'statusDescription' => Lang::get('products.addedProductToCart')
            ]);
        }
        else{
            return response()->json([
                'status' => 'erorr',
                'statusDescription' => Lang::get('products.notAddedProductToCart')
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
