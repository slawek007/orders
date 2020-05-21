@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="display-5 d-inline">Odbiorcy</h4>
    <a href="{{ action('Orders\CustomersController@create') }}" class="btn btn-success d-inline-block float-right mb-2" >Dodaj odbiorcę</a>
     <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('messages.shortName')</th>
              <th>@lang('messages.code')</th>
              <th>@lang('messages.companyName')</th>
              <th>@lang('messages.street')</th>
              <th>@lang('messages.zipCode')</th>
              <th>@lang('messages.city')</th>
              <th>@lang('messages.country')</th>
              <th>@lang('messages.nip')</th>
              <th>@lang('messages.payment')</th>
              <th>@lang('messages.createdAt')</th>
              <th>@lang('messages.actions')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->short_name }}</td>
                        <td>{{ $customer->code  }}</td>
                        <td>{{ $customer->company }}</td>
                        <td>{{ $customer->street }}</td>
                        <td>{{ $customer->zip_code }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->country }}</td>
                        <td>{{ $customer->nip }}</td>
                        <td>{{ $customer->payment }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>
                            <a href="{{ action('Orders\CustomersController@show',$customer->id) }}">@lang('messages.show')</a>
                            <form method="POST" action="{{ action('Orders\CustomersController@destroy',$customer->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('@lang('messages.deleteConfirmation')');">@lang('messages.delete')</button>
                            </form>
                        </td>
                    </tr>
            @endforeach
        </tbody>
        </table>
      </div>

</div>
@endsection
