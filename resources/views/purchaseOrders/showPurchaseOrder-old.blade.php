@extends('layouts.app')

@section('content')
    <main role="main">
        <div class="container border purchaseOrderCard">
            <div class="row border ">
                <div class="col-md-9" style="padding-top:7px;">
                    <img class="img-fluid" src="{{ asset('img/logo-pareo.png') }}">
                </div>
                <div class="col-md-3" style="padding-top:7px;">
                    <ul class="list-unstyled">
                        <li>BOROWA 465</li>
                        <li>PL – 39305 BOROWA</li>
                        <li>TEL :  00 48 (0) 17 581 53 41</li>
                        <li>FAX :  00 48 (0) 17 583 13 52</li>
                        <li style="margin-top:10px;">http://www.pareo-polska.com</li>
                        <li>e-mail: info@pareo-polska.com</li>
                        <li style="margin-top:10px;">NIP : PL 8171607813</li>
                    </ul>
                </div>
            </div>
            <h4 class="purchaseOrderH4">@lang('purchaseOrders.purchaseOrder')</h4>
            <div class="purchaseData">
                <span class="purchaseNumber"><strong>N<sup>o</sup></strong> {{ $purchaseOrder->order_code }}</span>
                <span class="purchaseDate">Borowa, {{ $purchaseOrder->created_at->format('Y-m-d') }}</span>
            </div>

            <div class="row justify-content-between">
                    <div class="col-5 border customer">
                      <span>@lang('purchaseOrders.deliveryAddress')</span>
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
                    </div>
                    <div class="col-5 border supplier">
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
                    </div>
                  </div>
            <div class="orderedProducts">
                <table>
                    <tbody>
                        <tr>
                            <th style='width:3vw'>@lang('purchaseOrders.productsNo')</th>
                            <th style='width:17vw'>@lang('purchaseOrders.productsPN')</th>
                            <th style='width:35vw'>@lang('purchaseOrders.productsDescription')</th>
                            <th style='width:5vw'>@lang('purchaseOrders.productsMU')</th>
                            <th style='width:5vw'>@lang('purchaseOrders.productsQty')</th>
                            <th style='width:17vw'>@lang('purchaseOrders.productsUnitPrice')</th>
                            <th style='width:18vw'>@lang('purchaseOrders.productsCost')</th>
                        </tr>
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
                    </tbody>
                </table>
                <div class="orderTotal">
                    <p>@lang('purchaseOrders.subTotal'): {{ $purchaseOrder->billing_subtotal }}{{ $purchaseOrder->currency_extension }} {{ $purchaseOrder->products[0]->pivot->currency_extension }}</p>
                    <p>@lang('purchaseOrders.vat'): {{ $purchaseOrder->billing_tax }}{{ $purchaseOrder->currency_extension }} {{ $purchaseOrder->products[0]->pivot->currency_extension }}</p>
                    <p>@lang('purchaseOrders.total'): {{ $purchaseOrder->billing_total }}{{ $purchaseOrder->currency_extension }} {{ $purchaseOrder->products[0]->pivot->currency_extension }}</p>
                </div>
            </div>
                <div class="row justify-content-between">
                    <div class="col-5 border commercialConditions">
                      <span>@lang('purchaseOrders.commercialConditions')</span>
                      <ul class="list-unstyled">
                          <li>@lang('purchaseOrders.deliveryDate') 15-06-2019</li>
                          <li><p></p></li>
                          <li>@lang('purchaseOrders.incoterms') loco, magazyn odbiorcy</li>
                          <li><p></p></li>
                          <li>@lang('purchaseOrders.paymentTerms') przelew 14 dni</li>
                          <li><p></p></li>
                          <li>@lang('purchaseOrders.remarks')</li>
                          <li>@lang('purchaseOrders.remarksText')</li>
                      </ul>
                    </div>
                    <div class="col-5 border invoiceAddress">
                        <span>@lang('purchaseOrders.invoiceAddress')</span>
                        <ul class="list-unstyled">
                            <li>PAREO POLSKA Sztuka Grzegorz</li>
                            <li>Borowa 465</li>
                            <li>39-305 Borowa</li>
                            <li>POLSKA</li>
                            <li>NIP: PL8171607813 </li>
                            <li><p></p></li>
                            <li>tel.: +48 (0) 17 583 13 52</li>
                        </ul>
                    </div>
            </div>
            <div>
                @lang('purchaseOrders.approvedBy'): G.Sztuka
            </div>

        </div>
    </main>
    <br/>
    {{ dump( $purchaseOrder) }}
@endsection
