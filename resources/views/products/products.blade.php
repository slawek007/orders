@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col">
                    <form method="GET" action="{{ action('OrderFormController@create') }}" >


                            <ul class="listOfaddedProducts">
                            </ul>
                            <button class="btn btn-success mt-2" type="submit">@lang('products.goToOrder')</button>
                        </form>

            </div>
        </div>
        {{--dd(Cookie::get('order')) --}}
    @if ($order)
        <div class="row">
            <div class="col-md-6">
                <p>@lang('products.orderedProduct')</p>
                <ul>
                @foreach ($order as $orderedProduct)
                    <li>
                        {{ $orderedProduct['productShortDescription'] }}
                        <form class="d-inline" method="POST" action="{{ action('AddToOrderController@destroy', $loop->index) }}" >
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="id" value="{{ $loop->index }}">
                                <button class="btn-sm btn-danger" type="submit">Usuń</button>
                        </form>
                    </li>
                @endforeach
                </ul>
            </div>
            @if(session('customers'))
            <div class="form-group col-md-6">
                <label for="sel1">@lang('products.PickDeliveryAdress')</label>
                <form method="GET" action="{{ action('PurchaseOrdersController@create') }}" >
                    <select class="selectCustomer form-control" name="customerId">
                        @foreach(session('customers') as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->company }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success mt-2" type="submit">@lang('products.goToOrder')</button>
                </form>
            </div>
            @endif
        <a href="{{ action('PurchaseOrdersController@create') }}"></a>
    @endif
    </div>
     <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Kod produktu</th>
              <th>Opis</th>
              <th>Cena</th>
              <th>Cena/ilość</th>
              <th>Dostawca</th>
              <th>AKCJE</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
                @foreach ($product->productsSupplierWithPrice as $productSupplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->short_description }}</td>
                        <td>{{ $product->description  }}</td>
                        <td>
                            <form class="changePriceValueForm ps-{{ $product->id }}{{ $productSupplier->id }}">
                                <input type="text" name="productNewPrice" class="changePriceValue" onkeyup="showSavebutton(this.form)" value="{{ $productSupplier->pivot->price }}">{{ $productSupplier->pivot->currency_extension }}
                                <button class="changePriceValueButton btn-sm btn-success d-none" type="submit"
                                        onclick="updateDatabase(
                                                    event,
                                                    '{{ action('ProductsController@update',$product->id)}}',
                                                    '{{csrf_token()}}',
                                                    '{{ $productSupplier->id }}')">
                                            @lang('products.changePrice')
                                </button>
                            </form>
                        </td>
                        <td>{{ $product->unit_multiplier }} {{ $product->unit_to_buy }}</td>
                        <td>{{ $productSupplier->company }}</td>
                        <td>
                            <a class="btn-sm btn-info" href="/products/{{ $product->id }}?supplier={{ $productSupplier->id }}">@lang('products.show')</a>
                            <a class="btn-sm btn-warning" href="#">@lang('products.edit')</a>
                            <form id="addToOrderForm">
                                <button class="btn-sm btn-success" type="submit"
                                        onclick="addToOrder(
                                        event,
                                        '{{ action('AddToOrderController@store') }}',
                                        '{{csrf_token()}}',
                                        '{{ $productSupplier->id }}',
                                        '{{ $product->short_description }}',
                                        '{{ $product->id }}')">
                                        @lang('products.addToOrder')
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        </table>
      </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/productsSiteFunctions.js') }}"></script>

@endpush

@section('endSiteFunctions')
<script type="text/javascript" src="{{ asset('js/addToOrder.js') }}"></script>
@endsection
