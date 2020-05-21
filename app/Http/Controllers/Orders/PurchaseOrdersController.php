<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Products;
use App\Customers;
use App\PurchaseOrders;
use App\PurchaseOrdersProducts;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrders::with('Customer', 'Supplier', 'User')->take(40)->get();
        return view('purchaseOrders.purchaseOrders', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        dd('hallo');
        /*Session::forget('subTotalPrice');
        Session::forget('totalPrice');
        $orders = session()->get('order');
        $supplierId = $orders[0]['supplierId'];
        $productsId = Arr::pluck($orders, 'productId');
        $purchaseOrder = Products::whereIn('id', $productsId)->
                            with(["productsSupplierWithPrice" => function($q) use ($supplierId){
                            $q->where('purchase_prices.suppliers_id', '=', $supplierId);
                            }, "productType", "productsMaterial"])->get();

        $customer = Customers::where('id', $_GET['customerId'])->firstOrFail();
        return view('purchaseOrders.createPurchaseOrder', compact('purchaseOrder', 'customer'));

*/
return 'Hello World';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $purchaseOrder = PurchaseOrders::with('customer', 'supplier','user')->where('id',$id)->firstOrFail();
        $purchaseProducts = PurchaseOrdersProducts::with('productsDetail')->where('purchase_orders_id',$id)->get();

        return view('purchaseOrders.showPurchaseOrder', compact('purchaseOrder', 'purchaseProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrders $purchaseOrder)
    {
        //
    }
}
