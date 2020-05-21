@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="display-5">Dodaj dostawcę</h4>
        <div class="container-fluid mt-5">
        <h4 class="display-5">Dane dostawcy:</h4>
        <form action='{{ action('Orders\SuppliersController@store') }}' method='POST'>
            @csrf
            <div class="form-group">
                <label for="short_name">Krótka nazwa</label>
                <input type="text" class="form-control col-lg-6 {{ $errors->has('short_name') ? 'is-invalid':'' }}" id="short_name" name="short_name" value="{{ old('short_name') }}">
            </div>
            <div class="form-group">
                <label for="code">Kod dostawcy</label>
                <input type="text" class="form-control col-lg-6 {{ $errors->has('code') ? 'is-invalid':'' }}" id="code" name="code" value="{{ old('code') }}">
            </div>
            <div class="form-group">
                <label for="company">Nazwa firmy</label>
                <input type="text" class="form-control col-lg-6" id="company" name="company" value="{{ old('company') }}">
            </div>
            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" class="form-control col-lg-6" id="street" name="street" value="{{ old('street') }}">
            </div>
            <div class="form-group">
                <label for="zip_code">Kod pocztowy</label>
                <input type="text" class="form-control col-lg-6" id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
            </div>
            <div class="form-group">
                <label for="city">Miasto</label>
                <input type="text" class="form-control col-lg-6" id="city" name="city" value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label for="city">Państwo</label>
                <input type="text" class="form-control col-lg-6" id="county" name="country" value="{{ old('country') }}">
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control col-lg-6" id="nip" name="nip" value="{{ old('nip') }}">
            </div>
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text" class="form-control col-lg-6" id="phone" name="phone" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="e-mail">E-mail</label>
                <input type="email" class="form-control col-lg-6" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="payment">Forma płatności</label>
                <input type="text" class="form-control col-lg-6" id="payment" name="payment" value="{{ old('payment') }}">
            </div>
            <div class="form-group">
                <label for="comments">Komentarz/uwagi</label>
                <textarea class="form-control col-lg-6" id="comments" name="comments" rows="3">{{ old('comments') }}</textarea>
            </div>

                <button type="submit" class="btn btn-danger">DODAJ DOSTAWCĘ</button>
                </form>
    </div>

</div>
@endsection
