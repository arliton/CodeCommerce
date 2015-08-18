<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use CodeCommerce\Tag;

class StoreController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        $pFeatured = Product::featured()->get();

        $pRecommended = Product::recommended()->get();

        return view('store.index', compact('categories', 'pFeatured', 'pRecommended'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        if($category) {

            $categories = Category::all();

            $categorie_name = $category->name;

            $products = Category::find($id)->products;
        } else {

            return redirect()->route('store.index');
        }

        return view('store.products', compact('categories', 'categorie_name', 'products'));
    }

    public function product($id)
    {
        $product = Product::find($id);

        if($product) {

            $categories = Category::all();

            return view('store.details', compact('categories', 'product'));
        } else {

            return redirect()->route('store.index');
        }
    }

    public function tags($id)
    {
        $tag = Tag::find($id);

        if($tag) {

            $categories = Category::all();

            $products = $tag->products;

            $tag_name = $tag->name;

            return view('store.tags', compact('categories', 'tag_name', 'products'));
        } else {

            return redirect()->route('store.index');
        }
    }

}
