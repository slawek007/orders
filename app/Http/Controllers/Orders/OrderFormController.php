<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Products;
use App\Customers;
use App\PurchaseOrders;
use Illuminate\Http\Request;
use App\PurchaseOrdersProducts;
use Illuminate\Support\Facades\Auth;


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
        $user = Auth::user();
        //add order data without products
        $orderData = PurchaseOrders::findOrFail($request->purchaseNumberId);

        if ($orderData->success == false){
            $orderData->user_id = $user->id;
            $orderData->suppliers_id = $request->supplier;
            $orderData->customers_id = $request->customer;
            $orderData->delivery_date = $request->deliveryDay;
            $orderData->billing_subtotal = $request->orderSubTotal;
            $orderData->billing_tax = $request->orderVat;
            $orderData->billing_total = $request->orderTotal;
            $orderData->currency_extension = $request->currencyExtension[1];
            $orderData->success = true;
            $orderData->save();

            //add ordered products
            $iteration = 0;
            foreach ($request->product_id as $loop)
            {
                $iteration++;
                $productPurchasePrice = $request->productNewPrice[$iteration] ? $request->productNewPrice[$iteration] : $request->subtotal[$iteration];

                $orderProductData = [
                'purchase_orders_id' => $orderData->id,
                'products_id' =>  $request->product_id[$iteration],
                'quantity' => $request->quantity[$iteration],
                'purchase_price'=> $productPurchasePrice,
                'subtotal' => $request->subtotal[$iteration],
                'total' => $request->total[$iteration],
                'currency_extension' => $request->currencyExtension[$iteration]
                ];
                $orderItems = PurchaseOrdersProducts::create($orderProductData);
            }
            return redirect()->action(
                'Orders\PurchaseOrdersController@show', ['id' => $request->purchaseNumberId]
            );
        }
        else{
            return redirect()->action(
                'Orders\PurchaseOrdersController@show', ['id' => $request->purchaseNumberId]
            );
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
