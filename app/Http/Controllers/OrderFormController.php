<?php

namespace App\Http\Controllers;

use App\Products;
use App\Customers;
use Illuminate\Http\Request;

class OrderFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('order form index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $supplierId = $request->orderSupplierId;
        $productsId = $request->addedProduct;
        $purchaseOrder = Products::whereIn('id', $productsId)->
                            with(["productsSupplierWithPrice" => function($q) use ($supplierId){
                            $q->where('purchase_prices.suppliers_id', '=', $supplierId);
                            }, "productType", "productsMaterial"])->get();

        $customers = Customers::all('id','company', 'street', 'city');
        return view('purchaseOrders.createPurchaseOrder', compact('purchaseOrder', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('order form show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('order form edit');
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
        dd('order form create update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('order form destroy');
    }
}
