@extends('layouts.app') 
@section('script','product-edit')
@section('content') 
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" class="form" action="{{ route('api.product.update',$product->id) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('put') }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product['name'] }}"
                 placeholder="Enter name">
            </div>
            <br/>
            <div class="form-group">
                <label for="sku">Sku</label>
                <input type="text" name="sku" class="form-control" value="{{ $product['sku'] }}" 
                placeholder="Enter sku">
            </div>
            <br/>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control" value="{{ $product['price'] }}" 
                placeholder="Enter price">
            </div>
            <br/>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" value="{{ $product['image'] }}" placeholder="Enter image">
                <br/>
                <img src="{{ url('/').'/images/'.$product['image'] }}" class="img-responsive" width="80" height="80"/>
            </div>
            <br/>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" @if($product['status'] == 'Active') selected='selected' @endif>Yes</option>
                    <option value="0" @if($product['status'] == 'Disabled') selected='selected' @endif>No</option>
                </select>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </div>
</div>
@endsection