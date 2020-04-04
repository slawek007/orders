
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
    @foreach ($purchaseProducts as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td style="text-align:left;">{{ $product->productsDetail->short_description }}</td>
        <td style="text-align:left;">
            {{ $product->productsDetail->description }}
            @if ($product->productsDetail->product_types_id != '1')
                ({{ number_format($product->purchase_price, 2,',','') }} {{ $product->currency_extension }})
            @endif
        </td>
        <td>{{ $product->productsDetail->unit_of_measure }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ number_format($product->subtotal,2,',','') }} {{ $product->currency_extension }}</td>
        <td>{{ number_format($product->total,2,',','') }} {{ $product->currency_extension }}</td>
    </tr>
        @endforeach
    @endsection

    @section('orderTotal')
    <p>@lang('purchaseOrders.subTotal'): {{ number_format($purchaseOrder->billing_subtotal,2,',','') }}{{ $purchaseOrder->currency_extension }}</p>
    <p>@lang('purchaseOrders.vat'): {{ number_format($purchaseOrder->billing_tax,2,',','') }}{{ $purchaseOrder->currency_extension }}</p>
    <p>@lang('purchaseOrders.total'): {{ number_format($purchaseOrder->billing_total,2,',','') }}{{ $purchaseOrder->currency_extension }}</p>
    @endsection

    @section('deliveryDate', $purchaseOrder->delivery_date)
    @section('incoterms', $purchaseOrder->supplier->incoterms)
    @section('paymentTerms', $purchaseOrder->supplier->payment)
