<?php

namespace App\Http\Controllers;

use App\Suppliers;
use Illuminate\Http\Request;
use App\Http\Requests\validateSupplierAndCustomer;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::all();
        return view('suppliers.suppliers', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.addSupplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(validateSupplierAndCustomer $request)
    {
        Suppliers::create($request->validated());
        return redirect(action('SuppliersController@show', Suppliers::get()->last()->id))->with('success', 'Dostawca został dodany do bazy !.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Suppliers::with('purchaseOrders')->where('id',$id)->firstOrFail();
        return view('suppliers.showSupplier', compact('supplier'));
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
    public function update(Suppliers $supplier)
    {
        //$supplier->update(request(['short_name', 'code', 'company', 'street', 'zip_code', 'city', 'country', 'nip', 'phone', 'email', 'payment']));
        $supplier->update(request()->all());

        return redirect(action('SuppliersController@show', $supplier->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $supplier)
    {
        $supplier->delete();
        return redirect(action('SuppliersController@index'))->with('success', 'Usunięto rekord z bazy !.');
    }
}
