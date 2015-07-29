<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;

class AdminProductsController extends Controller
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function index()
    {
        $produtos = $this->productModel->paginate(10);

        return view('products.index', compact('produtos'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Requests\ProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productModel->fill($input);

        $product->save();

        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);

        return view('products.edit', compact('product'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $this->productModel->find($id)->update($request->all());

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $this->productModel->find($id)->delete();

        return redirect()->route('admin.products.index');
    }

}
