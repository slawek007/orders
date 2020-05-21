<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AddToOrderController extends Controller
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

        $supplierId = $request->supplierId;
        $productId = $request->productId;
        $productShortDescription = $request->productShortDescription;

        $customers=session()->get('customers');
        if (!isset($customers)){
            $customers = Customers::orderBy('orders_quantity', 'desc')->get(['id', 'company']);
            session()->put('customers', $customers);
        }

        if ($checkOrder = session()->get('order')){
            if (false !== array_search($productId, array_column($checkOrder, 'productId')) ){
                return redirect()->back()->withErrors(['produkt był już dodany i próbujesz dodać produkt od innego dostawcy HA']);
            }
            elseif( false === array_search($supplierId, array_column($checkOrder, 'supplierId'))){
                return redirect()->back()->withErrors(['Próbujesz dodać produkt od innego dostawcy! HA']);
            }
            else{
                //dd($request->get());
                dd(session()->get('order'));
                $order[] = $request->all();
                var_dump($order);
                session()->push('order', $order);

                return response()->json_encode($order);
            }
        }
        else{
            print_r($request->session()->get('order'));
            print_r('jestem tu');
            $order[] = $request->all();
            print_r($order);
            session(['order' => 'value']);
            dd($request->session()->get('order'));
            return response()->json_encode($order);
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
        $order = array_values(session()->get('order'));
        unset($order[$id]);
        session()->put('order',array_values($order));
        return redirect()->back()->with('success', 'Element usunięty1');
    }
}
