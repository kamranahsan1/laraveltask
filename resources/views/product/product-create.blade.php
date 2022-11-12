@extends('layouts.app') 
@section('script','product-create')
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
        <form method="POST" class="form" action="{{ route('api.product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter name">
            </div>
            <br/>
            <div class="form-group">
                <label for="sku">Sku</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="Enter sku">
            </div>
            <br/>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="Enter price">
            </div>
            <br/>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" value="{{ old('image') }}" placeholder="Enter image">
            </div>
            <br/>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" @if(old('status') == 1) selected='selected' @endif>Yes</option>
                    <option value="0" @if(old('status') == 0) selected='selected' @endif>No</option>
                </select>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </div>
</div>
@endsection