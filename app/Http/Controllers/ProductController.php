<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::paginate(10);
        return view('product/product-list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('product/product-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request){
        $proObject = new Product();
        $proObject->name = $request->post('name');
        $proObject->sku = $request->post('sku');
        $proObject->price = $request->post('price');
        $proObject->status = $request->post('status');
        if($request->hasfile('image')){
            $image = $request->file('image');
            $name  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/', $name);
            $proObject->image = $name;
        }
        $proObject->save();
        return response()->json(
            ['success' => 'Product Added Successfully!','redirect' => route('products.list')]
        , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $product = $this->getProductById($id);
        return view('product/product-view',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $product = $this->getProductById($id);
        return view('product/product-edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id){
        $proObject = Product::findorfail($id);
        $proObject->name    = $request->post('name');
        $proObject->sku     = $request->post('sku');
        $proObject->price   = $request->post('price');
        $proObject->status  = $request->post('status');
        if($request->hasfile('image')){
            $image = $request->file('image');
            $name  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/', $name);
            $proObject->image = $name;
        }
        $proObject->save();
        return response()->json(
            ['success' => 'Product Edit Successfully!','redirect' => route('products.list')]
        , 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $product = $this->getProductById($id);
        $product->delete();
        return response()->json(
            [
                'success' => 'Product Deleted Successfully!',
                'redirect' => route('products.list')
            ]
        , 201);
    }

    public function list(){
        $products = Product::paginate(5);
        return response()->json([
            'message' => 'Products fetch Successfully!',
            'data' => $products
        ], 201);
    }

    /**
     * Get Product From ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductById($id){
        return Product::findorfail($id);
    }

}
