@extends('layouts.app') 
@section('script','product-view')
@section('content') 
<div class="container">
  <div class="row justify-content-center">
  <div class="col-md-12" style="text-align: right;">
      <a href="{{ route('products.list') }}" class="btn btn-info" style="color: white;">Back to list</a>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product['name'] }}"
                placeholder="Enter name" disabled>
        </div>
        <br/>
        <div class="form-group">
            <label for="sku">Sku</label>
            <input type="text" name="sku" class="form-control" value="{{ $product['sku'] }}" 
            placeholder="Enter sku" disabled>
        </div>
        <br/>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $product['price'] }}" 
            placeholder="Enter price" disabled>
        </div>
        <br/>
        <div class="form-group">
            <img src="{{ url('/').'/images/'.$product['image'] }}" class="img-responsive" width="80" height="80"/>
        </div>
        <br/>
        <div class="form-group">
            <label for="status">Status</label>
            <label>{{$product['status']}}</label>
        </div>
    </div>
  </div>
</div>
@endsection