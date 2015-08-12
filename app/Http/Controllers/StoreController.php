<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{

    public function index($id = null)
    {
        $categories = Category::all();

        if(isset($id)) {

            $categorie_name = Category::find($id)->name;
            $products = Category::find($id)->products;

            return view('store.index', compact('categories', 'categorie_name', 'products'));

        } else {

            $pFeatured = Product::featured()->get();
            $pRecommended = Product::recommended()->get();

            return view('store.index', compact('categories', 'pFeatured', 'pRecommended'));
        }

    }

}
