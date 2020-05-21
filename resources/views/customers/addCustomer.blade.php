@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="display-5">@lang('customers.addCustomer')</h4>
        <div class="container-fluid mt-5">
        <h4 class="display-5">@lang('customers.customerData')</h4>
        <form action='{{ action('Orders\CustomersController@store') }}' method='POST'>
            @csrf
            <div class="form-group">
                <label for="short_name">@lang('messages.shortName')</label>
                <input type="text" class="form-control col-lg-6 {{ $errors->has('short_name') ? 'is-invalid':'' }}" id="short_name" name="short_name" value="{{ old('short_name') }}">
            </div>
            <div class="form-group">
                <label for="code">@lang('messages.code')</label>
                <input type="text" class="form-control col-lg-6 {{ $errors->has('code') ? 'is-invalid':'' }}" id="code" name="code" value="{{ old('code') }}">
            </div>
            <div class="form-group">
                <label for="company">@lang('messages.companyName')</label>
                <input type="text" class="form-control col-lg-6" id="company" name="company" value="{{ old('company') }}">
            </div>
            <div class="form-group">
                <label for="street">@lang('messages.street')</label>
                <input type="text" class="form-control col-lg-6" id="street" name="street" value="{{ old('street') }}">
            </div>
            <div class="form-group">
                <label for="zip_code">@lang('messages.zipCode')</label>
                <input type="text" class="form-control col-lg-6" id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
            </div>
            <div class="form-group">
                <label for="city">@lang('messages.city')</label>
                <input type="text" class="form-control col-lg-6" id="city" name="city" value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label for="city">@lang('messages.country')</label>
                <input type="text" class="form-control col-lg-6" id="county" name="country" value="{{ old('country') }}">
            </div>
            <div class="form-group">
                <label for="nip">@lang('messages.nip')</label>
                <input type="text" class="form-control col-lg-6" id="nip" name="nip" value="{{ old('nip') }}">
            </div>
            <div class="form-group">
                <label for="phone">@lang('messages.phone')</label>
                <input type="text" class="form-control col-lg-6" id="phone" name="phone" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="e-mail">@lang('messages.email')</label>
                <input type="email" class="form-control col-lg-6" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="payment">@lang('messages.payment')</label>
                <input type="text" class="form-control col-lg-6" id="payment" name="payment" value="{{ old('payment') }}">
            </div>
            <div class="form-group">
                <label for="comments">@lang('messages.comments')</label>
                <textarea class="form-control col-lg-6" id="comments" name="comments" rows="3">{{ old('comments') }}</textarea>
            </div>

                <button type="submit" class="btn btn-danger">@lang('customers.addCustomer')</button>
                </form>
    </div>

</div>
@endsection
