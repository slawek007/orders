@extends('layouts.app')

@section('content')
@yield('PurchaseOrderGenerate')
    <main role="main">
        @yield('formStart')
        <div class="container border purchaseOrderCard">
            <div class="row border mt-3">
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
                @yield('purchaseData')
            </div>
            <div class="row justify-content-between">
                    <div class="col-5 border customer">
                      <span>@lang('purchaseOrders.deliveryAddress')</span>
                      @yield('deliveryAddress')
                    </div>
                    <div class="col-5 border supplier">
                            @yield('supplier')
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
                        @yield('orderedProducts')
                    </tbody>
                </table>
                <div class="orderTotal">
                    @yield('orderTotal')
                </div>
            </div>
                <div class="row justify-content-between">
                    <div class="col-5 border commercialConditions">
                      <span>@lang('purchaseOrders.commercialConditions')</span>
                      <ul class="list-unstyled">
                          <li>@lang('purchaseOrders.deliveryDate') @yield('deliveryDate')</li>
                          <li><p></p></li>
                          <li>@lang('purchaseOrders.incoterms') @yield('incoterms')</li>
                          <li><p></p></li>
                          <li>@lang('purchaseOrders.paymentTerms') @yield('paymentTerms')</li>
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
                @lang('purchaseOrders.approvedBy') G.Sztuka
            </div>

        </div>
        @yield('formStop')
    </main>
    <br/>
@endsection
