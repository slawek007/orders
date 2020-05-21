<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Customers;
use Illuminate\Http\Request;
use App\Http\Requests\validateSupplierAndCustomer;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::all();
        return view('customers.customers', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.addCustomer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(validateSupplierAndCustomer $request)
    {
        customers::create($request->validated());
        return redirect(action('Orders\CustomersController@show', customers::get()->last()->id))->with('success', 'Odbiorca został dodany do bazy !.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customers::with('purchaseOrders')->where('id',$id)->firstOrFail();
        return view('customers.showCustomer', compact('customer'));
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
    public function update(customers $customer)
    {
        $customer->update(request()->all());

        return redirect(action('Orders\CustomersController@show', $customer->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(customers $customer)
    {
        $customer->delete();
        return redirect(action('Orders\CustomersController@index'))->with('success', 'Usunięto rekord z bazy !.');
    }
}
