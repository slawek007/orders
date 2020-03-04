
@extends('layouts.purchaseOrder')

@section('purchaseData')
    <span class="purchaseNumber"><strong>N<sup>o</sup></strong> {{ $purchaseOrder->order_code }}</span>
    <span class="purchaseDate">Borowa, {{ $purchaseOrder->created_at->format('Y-m-d') }}</span>
@endsection

@section('deliveryAddress')
    <ul class="list-unstyled">
        @if ($purchaseOrder->customer->contact_person)
        <li>{{ $purchaseOrder->customer->contact_person }}</li>
        @endif
        <li>{{ $purchaseOrder->customer->company }}</li>
        <li>ul. {{ $purchaseOrder->customer->street }}</li>
        <li>{{ $purchaseOrder->customer->city }}</li>
        @if ($purchaseOrder->customer->country)
        <li>{{ $purchaseOrder->customer->country }}</li>
        @endif
        <li>tel.: {{ $purchaseOrder->customer->phone }}</li>
    </ul>
@endsection

@section('supplier')
<span>@lang('purchaseOrders.supplier')</span><span style="float:right">{{ $purchaseOrder->supplier->code }}</span>
    <ul class="list-unstyled">
        @if ($purchaseOrder->supplier->contact_person)
        <li>{{ $purchaseOrder->supplier->contact_person }}</li>
        @endif
        <li>{{ $purchaseOrder->supplier->company }}</li>
        <li>ul. {{ $purchaseOrder->supplier->street }}</li>
        <li>{{ $purchaseOrder->supplier->city }}</li>
        @if ($purchaseOrder->supplier->country)
        <li>{{ $purchaseOrder->supplier->country }}</li>
        @endif
        <li>tel.: {{ $purchaseOrder->supplier->phone }}</li>
    </ul>
    @endsection

    @section('orderedProducts')
    @foreach ($purchaseOrder->products as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td style="text-align:left;">{{ $product->short_description }}</td>
        <td style="text-align:left;">{{ $product->description }}</td>
        <td>{{ $product->unit_of_measure }}</td>
        <td>{{ $product->pivot->quantity }}</td>
        <td>{{ $product->pivot->purchase_price }} {{ $product->pivot->currency_extension }}</td>
        <td>{{ $product->pivot->subtotal }} {{ $product->pivot->currency_extension }}</td>
    </tr>
        @endforeach
    @endsection

    @section('orderTotal')
    <p>@lang('purchaseOrders.subTotal'): {{ $purchaseOrder->billing_subtotal }}{{ $purchaseOrder->currency_extension }} {{ $purchaseOrder->products[0]->pivot->currency_extension }}</p>
    <p>@lang('purchaseOrders.vat'): {{ $purchaseOrder->billing_tax }}{{ $purchaseOrder->currency_extension }} {{ $purchaseOrder->products[0]->pivot->currency_extension }}</p>
    <p>@lang('purchaseOrders.total'): {{ $purchaseOrder->billing_total }}{{ $purchaseOrder->currency_extension }} {{ $purchaseOrder->products[0]->pivot->currency_extension }}</p>
    @endsection

    @section('deliveryDate', $purchaseOrder->delivery_date)
    @section('incoterms', $purchaseOrder->supplier->incoterms)
    @section('paymentTerms', $purchaseOrder->supplier->payment)
