@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="display-5">{{ $supplier->company }}</h4>
    @if (!$supplier->purchaseOrders->isEmpty())
    <div class="jumbotron py-2 my-1">
        <div class="container-fluid">
            <h5 class="display-5">Historia zamówień u dostawcy:</h5>
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>Numer zamówienia</th>
                    <th>Kwota zamówienia</th>
                    <th>Odbiorca</th>
                    <th>Data zamówienia</th>
                    <th>AKCJE</th>
                </tr>
                </thead>
                @foreach ($supplier->purchaseOrders as $order)
                <tbody>
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->billing_subtotal }}</td>
                        <td>{{ $order->customer['company'] }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ action('Orders\PurchaseOrdersController@show', ['id' => $order->id]) }}">Podgląd</a>
                            <a href="#">Edycja</a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    @endif

    <div class="container-fluid mt-5">
        <h4 class="display-5">Dane dostawcy:</h4>
        <form actions='{{ action('Orders\SuppliersController@update', $supplier->id) }}' method='POST'>
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="short_Name">Krótka nazwa</label>
                <input type="text" class="form-control col-lg-6" id="shortName" name="short_Name" value="{{ $supplier->short_name }}">
            </div>
            <div class="form-group">
                <label for="code">Kod dostawcy</label>
                <input type="text" class="form-control col-lg-6" id="code" name="code" value="{{ $supplier->code }}">
            </div>
            <div class="form-group">
                <label for="company">Nazwa firmy</label>
                <input type="text" class="form-control col-lg-6" id="company" name="company" value="{{ $supplier->company }}">
            </div>
            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" class="form-control col-lg-6" id="street" name="street" value="{{ $supplier->street }}">
            </div>
            <div class="form-group">
                <label for="zip_code">Kod pocztowy</label>
                <input type="text" class="form-control col-lg-6" id="zip_code" name="zip_code" value="{{ $supplier->zip_code }}">
            </div>
            <div class="form-group">
                <label for="city">Miasto</label>
                <input type="text" class="form-control col-lg-6" id="city" name="city" value="{{ $supplier->city }}">
            </div>
            <div class="form-group">
                <label for="city">Państwo</label>
                <input type="text" class="form-control col-lg-6" id="county" name="country" value="{{ $supplier->country }}">
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control col-lg-6" id="nip" name="nip" value="{{ $supplier->nip }}">
            </div>
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text" class="form-control col-lg-6" id="phone" name="phone" value="{{ $supplier->phone }}">
            </div>
            <div class="form-group">
                <label for="e-mail">E-mail</label>
                <input type="email" class="form-control col-lg-6" id="email" name="email" value="{{ $supplier->email }}">
            </div>
            <div class="form-group">
                <label for="payment">Forma płatności</label>
                <input type="text" class="form-control col-lg-6" id="payment" name="payment" value="{{ $supplier->payment }}">
            </div>
            <div class="form-group">
                <label for="comments">Komentarz/uwagi</label>
                <textarea class="form-control col-lg-6" id="comments" name="comments" rows="3">{{ $supplier->comments }}</textarea>
            </div>

                <button type="submit" class="btn btn-danger">Edytuj</button>
                </form>
    </div>
</div>
@endsection
