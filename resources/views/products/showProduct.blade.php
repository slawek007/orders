@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <main role="main">
            <div class="jumbotron bg-info text-white py-4 my-1">
              <div class="container-fluid">
                <h4 class="display-5">{{ $product->short_description }}
                @if ($productWeight)
                    (Waga produktu: {{ $productWeight }}{{ $product->unit_to_buy }})
                @endif
                </h4>
                <table class="table">
                    <thead>
                      <tr>
                        <th>Opis</th>
                        <th>Cena</th>
                        <th>Cena/ilość</th>
                        <th>Dostawca</th>
                        <th>Kod dostawcy</th>
                        <th>Aktualizacja</th>
                        <th>AKCJE</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->productsSupplierWithPrice[$supplier-1]->pivot->price }} {{ $product->productsSupplierWithPrice[$supplier-1]->pivot->currency_extension }}</td>
                            <td>{{ $product->unit_multiplier }} {{ $product->unit_to_buy }}</td>
                            <td>{{ $product->productsSupplierWithPrice[$supplier-1]->company }}</td>
                            <td>{{ $product->productsSupplierWithPrice[$supplier-1]->code }}</td>
                            <td>{{ $product->productsSupplierWithPrice[$supplier-1]->pivot->created_at }}</td>
                            <td>
                                <a class="text-white" href="#">Zamów</a>
                                <a class="text-white" href="#">Edycja</a>
                            </td>
                        </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="jumbotron py-2 my-1">
            <div class="container-fluid">
                <h5 class="display-5">Pozostali dostawcy:</h5>
                @foreach ($product->productsSupplierWithPrice as $additionalProductSupplier)
                    @if ($additionalProductSupplier->id != $supplier)
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Nazwa dostawcy</th>
                                <th>Cena</th>
                                <th>Cena/ilość</th>
                                <th>Kod dostawcy</th>
                                <th>AKCJE</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $additionalProductSupplier->company }}</td>
                                    <td>{{ $additionalProductSupplier->pivot->price }} {{ $additionalProductSupplier->pivot->currency_extension }}</td>
                                    <td>{{ $product->unit_multiplier }} {{ $product->unit_of_measure }}</td>
                                    <td>{{ $additionalProductSupplier->code }}</td>
                                    <td>
                                        <a href="#">Zamów</a>
                                        <a href="#">Edycja</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @elseif(!$additionalProductSupplier)
                        <h5 class="display-5 color:red">Produkt nie ma innych dostawców</h5>
                        @endif

                    @endforeach
            </div>
        </div>
            <div class="jumbotron py-2 my-1">
                <div class="container-fluid">
                      <h5 class="display-5">Historia zamówień produktu/usługi:</h5>
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Numer zamówienia</th>
                                <th>Ilość</th>
                                <th>Cena zakupu</th>
                                <th>Dostawca</th>
                                <th>Odbiorca</th>
                                <th>Data zamówienia</th>
                                <th>AKCJE</th>
                            </tr>
                            </thead>
                            @foreach ($orderHistory as $order)
                            <tbody>
                                <tr>
                                    <td>{{ $order->PurchaseOrders->order_code }}</td>
                                    <td>{{ $order->quantity }} {{ $product->unit_of_measure }}</td>
                                    <td>{{ $order->subtotal }} {{ $order->currency_extension }}</td>
                                    <td>{{ $order->PurchaseOrders->Supplier['company'] }}</td>
                                    <td>{{ $order->PurchaseOrders->Customer['company'] }}</td>
                                    <td>{{ $order->PurchaseOrders->created_at }}</td>
                                    <td>
                                        <a href="#">Podgląd</a>
                                        <a href="#">Edycja</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>


                </div>
            </div>

        </main>
    </div>
@endsection
