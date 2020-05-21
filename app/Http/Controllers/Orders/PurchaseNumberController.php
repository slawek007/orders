<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\PurchaseOrders;
use Illuminate\Http\Request;

class PurchaseNumberController extends Controller
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
     * AJAX for creating a new Purchase Order.
     *
     * @return $purchaseNumber nad $lastPurchaseOrderId for delete function in blade template
     */
    public function create()
    {
        $lastNumber = explode('/',PurchaseOrders::latest()->firstorFail()->order_code);

        if ((int)date('m') == $lastNumber[2]){
            $lastNumber[1]++;
            $lastNumber[1] = str_pad($lastNumber[1], 3, 0, STR_PAD_LEFT);
            $lastNumber[2] = str_pad(date('m'), 2, 0, STR_PAD_LEFT);
            $lastNumber[3] = substr(date('Y'), 2);
            $NextPurchaseNumber=implode('/',$lastNumber);
        }
        else{
            $lastNumber[1] = 1;
            $lastNumber[1] = str_pad($lastNumber[1], 3, 0, STR_PAD_LEFT);
            $lastNumber[2] = str_pad(date('m'), 2, 0, STR_PAD_LEFT);
            $lastNumber[3] = substr(date('Y'), 2);
            $NextPurchaseNumber=implode('/',$lastNumber);
        }

        $newPurchaseNumber = new PurchaseOrders();
        $newPurchaseNumber->order_code = $NextPurchaseNumber;
        if(!$newPurchaseNumber->save()){
            abort(500, 'Application Error when try to save Purchase Number contact with Developer');
        }
        $lastPurchaseOrderId=PurchaseOrders::latest()->firstOrFail()->id;
        return response()->json(['purchaseNumber'=>[$NextPurchaseNumber,$lastPurchaseOrderId]]);
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

        PurchaseOrders::destroy($id);
        dd('OK');

    }
}
