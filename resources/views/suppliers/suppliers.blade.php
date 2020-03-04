@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="display-5 d-inline">Dostawcy</h4>
    <a href="{{ action('SuppliersController@create') }}" class="btn btn-success d-inline-block float-right mb-2" >Dodaj dostawcę</a>
     <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Skrót</th>
              <th>Kod</th>
              <th>Nazwa</th>
              <th>Ulica</th>
              <th>Kod pocztowy</th>
              <th>Miasto</th>
              <th>Państwo</th>
              <th>NIP</th>
              <th>Płatności</th>
              <th>Dodano</th>
              <th>AKCJE</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->short_name }}</td>
                        <td>{{ $supplier->code  }}</td>
                        <td>{{ $supplier->company }}</td>
                        <td>{{ $supplier->street }}</td>
                        <td>{{ $supplier->zip_code }}</td>
                        <td>{{ $supplier->city }}</td>
                        <td>{{ $supplier->country }}</td>
                        <td>{{ $supplier->nip }}</td>
                        <td>{{ $supplier->payment }}</td>
                        <td>{{ $supplier->created_at }}</td>
                        <td>
                            <a href="{{ action('SuppliersController@show',$supplier->id) }}">Podgląd</a>
                            <form method="POST" action="{{ action('SuppliersController@destroy',$supplier->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Czy na pewno chcesz usunąć rekord z bazy?');">USUŃ</button>
                            </form>
                        </td>
                    </tr>
            @endforeach
        </tbody>
        </table>
      </div>

</div>
@endsection
