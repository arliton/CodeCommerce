<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;
use CodeCommerce\Category;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');

        return view('products.create', compact('categories'));
    }

    public function store(Requests\ProductRequest $request)
    {
        $input = $request->all();

        $tags_input = array_map('trim', explode(',', $input['tags']));

        $array_new_tags = array();

        foreach($tags_input as $tag) {

            if (!empty($tag)) {
                if (!in_array($tag, Tag::lists('name')->toArray())) {
                    Tag::create(['name' => $tag]);
                }

                array_push($array_new_tags, Tag::lists('id', 'name')->toArray()[$tag]);
            }
        }

        $product = $this->productModel->fill($input);

        $product->save();

        $product->tags()->sync($array_new_tags);

        return redirect()->route('admin.products.index');
    }

    public function edit($id, Category $category)
    {
        $categories = $category->lists('name', 'id');

        $product = $this->productModel->find($id);

        $tags = array();
        for($i = 0; $i < count($product->tags) ; $i++) {
            array_push($tags, $product->tags[$i]->name);
        }
        $tags = implode(', ', $tags);

        return view('products.edit', compact('product', 'categories', 'tags'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $input = $request->all();

        $tags_update = array_map('trim', explode(',', $input['tags']));

        $array_update_tags = array();

        foreach($tags_update as $tag) {

            if (!empty($tag)) {
                if (!in_array($tag, Tag::lists('name')->toArray())) {
                    Tag::create(['name' => $tag]);
                }

                array_push($array_update_tags, Tag::lists('id', 'name')->toArray()[$tag]);
            }
        }

        $this->productModel->find($id)->update($input);

        $this->productModel->find($id)->tags()->sync($array_update_tags);

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $list_images = $this->productModel->find($id)->images;

        foreach($list_images as $image) {
            if(file_exists(public_path() . '/uploads/'.$image->id.'.'.$image->extension)) {
                Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
            }
        }

        $this->productModel->find($id)->delete();

        return redirect()->route('admin.products.index');
    }

    public function images($id)
    {
        $product = $this->productModel->find($id);

        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->productModel->find($id);

        return view('products.create_image', compact('product'));
    }

    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');

        if(file_exists($file)) {
            $extension = $file->getClientOriginalExtension();

            $image = $productImage::create(['product_id' => $id, 'extension' => $extension]);

            Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));
        }

        return redirect()->route('admin.products.images', ['id' => $id]);
    }

    public function destroyImage($id, ProductImage $productImage)
    {
        $image = $productImage->find($id);

        if(file_exists(public_path() . '/uploads/'.$image->id.'.'.$image->extension)) {
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }

        $product = $image->product;

        $image->delete();

        return redirect()->route('admin.products.images', ['id' => $product->id]);
    }

}
