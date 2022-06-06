<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest as Store;
use App\Http\Requests\Product\UpdateProductRequest as Update;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\view\Recusive;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($this->productRepository->oke('Quang'));
        // $products = $this->productRepository->getAll();
        // dd($this->productRepository->getAll());
        // dd($this->productRepository->loadProductFromShoppe());
        $products = Product::search()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $recusive = new Recusive($categories);
        $htmlOption = $recusive->show('');
        return view('admin.product.create', compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        // $product = Product::create($request->all());
        // $product->update(['slug' => Str::slug($request->name) . '-' . $product->id]);
        toast('Product Created name: ' . $request->name, 'Successfully');
        // $this->productRepository->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = Category::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->show($product->category_id);
        return view('admin.product.edit', compact('product', 'htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Product $product)
    {
        $product->update($request->all());
        $product->update(['slug' => Str::slug($request->name) . '-' . $product->id]);
        toast('Updated product name: ' . $request->name, 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toast('Deleted successfully', 'success')->autoClose(1500)->timerProgressBar();
        return redirect()->back();
    }
}
