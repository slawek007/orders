<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;

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
        $customers=session()->get('customers');
        if (!isset($customers)){
            $customers = Customers::orderBy('orders_quantity', 'desc')->get(['id', 'company']);
            session()->put('customers', $customers);
        }

        if ($order = session()->get('order')){
            if (false !== array_search($request->productId, array_column($order, 'productId')) ){
                return redirect()->back()->withErrors(['produkt był już dodany i próbujesz dodać produkt od innego dostawcy']);
            }
            elseif( false === array_search($request->supplierId, array_column($order, 'supplierId'))){
                return redirect()->back()->withErrors(['Próbujesz dodać produkt od innego dostawcy!']);
            }
            else{
                $order[] = $request->except('_token');
                session()->put('order', $order);
                return redirect()->back()->with('success', 'Product dodany ale już coś było!');
            }
        }
        else{
            $order[] = $request->except('_token');
            session()->put('order', $order);
            return redirect()->back()->with('success', 'Product dodany po raz pierwszy!');
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
        return redirect()->back()->with('success', 'Element usunięty');
    }
}
