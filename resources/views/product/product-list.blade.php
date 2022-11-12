@extends('layouts.app') 
@section('script','product-list')
@section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12" style="text-align: right;">
      <a href="{{ route('products.create') }}" class="btn btn-info" style="color: white;">+ Add</a>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Product List') }}</div>
        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">ID#</th>
              <th class="th-sm">Image</th>
              <th class="th-sm">Name</th>
              <th class="th-sm">Sku</th>
              <th class="th-sm">Price</th>
              <th class="th-sm">Status</th>
              <th class="th-sm">Action</th>
            </tr>
          </thead>
          @if($products)
          <tbody>
            @foreach($products as $product)
            <tr>
              <td>{{ $product['id'] }}</td>
              <td>
                @if($product['image'] != '')
                  <img src="{{ url('/').'/images/'.$product['image'] }}" class="img-responsive" width="80" height="80"/>
                @else
                  <p>No image uploaded!</p>
                @endif
              </td>
              <td>{{ $product['name'] }}</td>
              <td>{{ $product['sku'] }}</td>
              <td>{{ $product['price'] }}</td>
              <td>{{ $product['status'] }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route('products.show',$product->id) }}">View</a>
                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                <form action="{{route('api.product.destroy',$product->id)}}" class="delete-product" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>               
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          @else
          <tbody>
            <tr>
              <td colspan="7"></td>
            </tr>
          </tbody>
          @endif
        </table>
      </div>
    </div>
  </div>
</div> @endsection