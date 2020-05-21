@extends('layouts.app')

@section('content')
<div class="container-fluid">
     <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('purchaseOrders.orderCode')</th>
              <th>@lang('messages.supplier')</th>
              <th>@lang('messages.customer')</th>
              <th>@lang('messages.purchaser')</th>
              <th>@lang('purchaseOrders.deliveryDate')</th>
              <th>@lang('purchaseOrders.purchaseSubTotal')</th>
              <th>@lang('messages.createdAt')</th>
              <th>@lang('messages.actions')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($purchaseOrders as $purchaseOrder)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchaseOrder->order_code }}</td>
                        <td>{{ $purchaseOrder->supplier['short_name'] }}</td>
                        <td>{{ $purchaseOrder->customer['short_name'] }}</td>
                        <td>{{ $purchaseOrder->user['name'] }}</td>
                        <td>{{ $purchaseOrder->delivery_date }}</td>
                        <td>{{ $purchaseOrder->billing_total }} {{ $purchaseOrder->currency_extension }}</td>
                        <td>{{ $purchaseOrder->updated_at }}</td>
                        <td>
                            <a href="#">Ponów</a>
                            <a href="{{ action("Orders\PurchaseOrdersController@show",$purchaseOrder->id) }}">Podgląd</a>
                        </td>
                    </tr>
            @endforeach
        </tbody>
        </table>
      </div>

</div>
@endsection
