
@extends('layouts.purchaseOrder')
@section('PurchaseOrderGenerate')

@endsection

@section('formStart')
<form id="order-form" action='{{ action('OrderFormController@store') }}' method='POST'>
    @csrf;
@endsection

@section('purchaseData')
    <span class="purchaseNumber">N<sup>o</sup></span><span class="generatedPurchaseNumber">PPL/___/__/__/PO</span>
    <input type="hidden" class="description" name="purchaseNumber" value="">
    <span class="PurchaseNumberSubmit btn btn-success">rezerwój nr zamówienia</span>
    <span class="PurchaseNumberDestroy btn btn-danger" style="display:none;">zwolnij nr zamówienia</span>
    <span class="purchaseDate">Borowa, {{ date('d-m-Y') }}</span>
@endsection

@section('deliveryAddress')
            <select class="w-50" id="selectCustomer" onchange="getCustomerData(event, '{{ csrf_token() }}')">
                <option value="0" selected>(wybierz)</option>
                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}"><strong>{{$customer->company}},</strong> {{$customer->street}}, {{$customer->city}}</option>
                @endforeach
              </select>
        <ul class="list-unstyled customerData"></ul>
@endsection

@section('supplier')
    <span>
        @lang('purchaseOrders.supplier')
    </span>
    <span style="float:right">
        {{ $purchaseOrder[0]->productsSupplierWithPrice[0]->code }}
    </span>

    <ul class="list-unstyled supplierData">
        @if ($purchaseOrder[0]->productsSupplierWithPrice[0]->contact_person)
            <li>{{ $purchaseOrder[0]->productsSupplierWithPrice[0]->contact_person }}</li>
        @endif
            <li>{{ $purchaseOrder[0]->productsSupplierWithPrice[0]->company }}</li>
            <li>ul. {{ $purchaseOrder[0]->productsSupplierWithPrice[0]->street }}</li>
            <li>{{ $purchaseOrder[0]->productsSupplierWithPrice[0]->city }}</li>
        @if ($purchaseOrder[0]->productsSupplierWithPrice[0]->phone)
            <li>{{ $purchaseOrder[0]->productsSupplierWithPrice[0]->phone }}</li>
        @endif
    </ul>
@endsection

@section('orderedProducts')
    @foreach ($purchaseOrder as $product)
        <tr>
            {{--NumberProduct --}}
            <td>
                {{ $loop->iteration }}
                <input type="hidden" class="product_id" name="product_id[{{ $loop->iteration }}]" value="{{ $product->id }}">
            </td>
            {{-- P/N --}}
            <td style="text-align:left;">
                {{ $product->short_description }}
                <input type="hidden" class="short_description" name="short_description[{{ $loop->iteration }}]" value="{{ $product->short_description }}">
            </td>
            {{-- Description --}}
            <td style="text-align:left;">
                {{ $product->description }}
                @if ($product->product_types_id != '1')(
                    <input type="text" name="productNewPrice[{{ $loop->iteration }}]" class="changePriceValue priceValue-{{$loop->iteration}}" onkeyup="showSavebutton(this.form)" value="{{$product->productsSupplierWithPrice[0]->pivot->price}}">{{$product->productsSupplierWithPrice[0]->pivot->currency_extension}}/{{ $product->unit_to_buy }}
                       <span class="changePriceValueButton btn-sm btn-success d-none"
                                onclick="changeUnitPrice(
                                            event,
                                            '{{ $loop->iteration }}',
                                            '{{ action('ProductsController@update',$product->id)}}',
                                            '{{ $purchaseOrder[0]->productsSupplierWithPrice[0]->id }}',
                                            '{{ $product->dimension1 }}',
                                            '{{ $product->dimension2 }}',
                                            '{{ $product->dimension3 }}',
                                            '{{ $product->productsMaterial->density }}',
                                            '{{ $product->product_types_id }}'
                                            )">
                            @lang('products.changePrice')
                       </span>)
                @endif
                <input type="hidden" class="description" name="description[{{ $loop->iteration }}]" value="{{ $product->description }}">
            </td>

            <td>
                {{ $product->unit_of_measure }}{{-- Unit --}}
                <input type="hidden" class="unit_of_measure" name="unit_of_measure[{{ $loop->iteration }}]" value="{{ $product->unit_of_measure }}">
            </td>
            {{-- QTY --}}
            <td>
                <input
                type="text"
                class="quantity quantity-{{ $loop->iteration }}"
                name="quantity[{{ $loop->iteration }}]"
                onkeyup="calculateProductPrice(this.value, {{$product->productsSupplierWithPrice[0]->pivot->price}}, {{ $loop->iteration }}, {{ $product->productsSupplierWithPrice[0]->pivot->vatTax }})"
                value="1">
            </td>
            {{-- SubTotal --}}
            <td>
                @if ($product->product_types_id != '1')
                <span class="subtotalText subtotalText-{{ $loop->iteration }}">
                    {{ priceCalculate(
                        $product->dimension1,
                        $product->dimension2,
                        $product->dimension3,
                        $product->productsMaterial->density,
                        $product->product_types_id,
                        null,
                        $product->productsSupplierWithPrice[0]->pivot->price)
                    }}
                </span>
                @else
                    <span class="subtotalText subtotalText-{{ $loop->iteration }}">
                        {{ priceCalculate(
                            $product->dimension1,
                            $product->dimension2,
                            $product->dimension3,
                            $product->productsMaterial->density,
                            $product->product_types_id,
                            null,
                            $product->productsSupplierWithPrice[0]->pivot->price)
                        }}
                    </span>
                @endif

                <span class="currency-extension">
                    {{ $product->productsSupplierWithPrice[0]->pivot->currency_extension }}
                </span>

                <input
                type="hidden"
                class="subtotal"
                name="subtotal[{{ $loop->iteration }}]"
                value="{{ session('subtotalPrice') }}">
            </td>
            {{-- Total --}}
            <td>
                <span class="totalText totalText-{{ $loop->iteration }}">
                        {{ session('subtotalPrice') }}
                </span>
                <input type="hidden" class="totalInput-{{ $loop->iteration }}" name="total[{{ $loop->iteration }}]" value="{{ session('subtotalPrice') }}">
            <span class="currency-extension">{{ $product->productsSupplierWithPrice[0]->pivot->currency_extension }}</span>
            </td>
        </tr>
    @endforeach
@endsection

    {{-- Order Total bottom of Product list --}}
@section('orderTotal')
        <div class="orderSum">
            @lang('purchaseOrders.subTotal'):
            <input
                type="text"
                class="orderSubTotal"
                name="orderSubTotal"
                value="{{ session('totalPrice') }}">
                {{ $product->productsSupplierWithPrice[0]->pivot->currency_extension }}
        </div>

        {{-- VAT Total bottom of Product list --}}
        <div class="orderSum">
            @lang('purchaseOrders.vat')({{ $product->productsSupplierWithPrice[0]->pivot->vatTax }}%):
            <input
                type="text"
                class="orderVat"
                name="orderVat"
                value="{{ round($product->productsSupplierWithPrice[0]->pivot->vatTax*session('totalPrice')/100, 2) }}">
                {{ $product->productsSupplierWithPrice[0]->pivot->currency_extension }}
        </div>

        {{-- SUM Total bottom of Product list --}}
        <div class="orderSum">
            @lang('purchaseOrders.total'):
            <input
                type="text"
                class="orderTotalWithVat"
                name="orderTotal"
                value="{{ round((1+$product->productsSupplierWithPrice[0]->pivot->vatTax/100)*session('totalPrice'), 2) }}">
                {{ $product->productsSupplierWithPrice[0]->pivot->currency_extension }}
        </div>
@endsection

@section('deliveryDate')
    <input type="date" name="bday" max="3000-12-31" min="{{ date('Y-m-d') }}" style="border:none;">
@endsection

@section('incoterms')
    {{ $purchaseOrder[0]->productsSupplierWithPrice[0]->incoterms }}
@endsection

@section('paymentTerms')
    {{ $purchaseOrder[0]->productsSupplierWithPrice[0]->payment }}
@endsection

@section('formStop')
<button>Zapisz zamówienie</button>
    </form>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/createPurchaseOrder.js') }}"></script>

@endpush
@push('endSiteScripts')
    <script type="text/javascript" src="{{ asset('js/productsSiteFunctions.js') }}">

    </script>


@endpush
