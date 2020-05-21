<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;
use App\PurchaseOrdersProducts;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::with('productsSupplierWithPrice')->get();
        $order = session()->get('order');
        return view('products.products', compact('products', 'order'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $supplier = ($_GET['supplier']);
        $product = Products::with('productsSupplierWithPrice', 'productType', 'productsMaterial')->where('id',$id)->firstOrFail();
        $productWeight = $product->dimension1*$product->dimension2/1000*$product->dimension3/1000*$product->productsMaterial->density;
        $orderHistory = PurchaseOrdersProducts::with('PurchaseOrders')->where('products_id',$id)->get();


        return view('products.showProduct', compact('product', 'supplier', 'orderHistory', 'productWeight'));
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
        $jsonData = json_decode($request->getContent(), true);
        $supplierId = $jsonData['supplierId'];
        $productNewPrice = $jsonData['newPrice'];

        if ($productNewPrice > 0){
            $changePriceValue = Products::where('id', $id)->
                                with(["productsSupplierWithPrice" => function($q) use ($supplierId){
                                $q->where('purchase_prices.suppliers_id', '=', $supplierId);
                                }])->FirstOrFail();
                                //dd($changePriceValue);
                                $changePriceValue->productsSupplierWithPrice[0]->pivot->update(['price' => $productNewPrice]);

            return response()->json([
                'success' => true,
                'productChangedName' => $changePriceValue->short_description
            ]);
        }

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
