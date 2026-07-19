<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //
    public function show($slug)
    {
        $product = Product::select(
            'id',
            'cateid',
            'brand_id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image',
            'description'
        )
            ->with([
                'category:cateid,catename',
                'brand:brand_id,brandname',
                'images:id,product_id,image'
            ])
            ->where('slug', $slug)
            ->firstOrFail();
        // sản phẩm liên quan cùng danh muc
        $relatedProducts = Product::select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image'
        )
            ->where('cateid', $product->cateid)
            ->where('id', '<>', $product->id)
            ->take(4)
            ->get();
        return view('client.products.show', compact(
            'product',
            'relatedProducts'
        ));
    }

    public function category($slug, $limit = 12)
    {
        $products = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'products.brand_id',
            'categories.catename'
        )
            ->join('categories', 'products.cateid', 'categories.cateid')
            ->where('categories.slug', $slug)
            ->where('products.status', 1)
            ->paginate($limit);
        return view('client.products.category', compact('products'));
    }

    public function brand($slug, $limit = 12)
    {
        $brand = Brand::where('slug', $slug)->where('status', 1)->firstOrFail();

        $products = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'products.brand_id',
            'brands.brandname',
            'brands.slug as brand_slug'
        )
            ->join('brands', 'products.brand_id', 'brands.brand_id')
            ->where('brands.slug', $slug)
            ->where('products.status', 1)
            ->paginate($limit);

        return view('client.products.brand', compact('products', 'brand'));
    }

    public function search(Request $request, $limit = 12)
    {
        $keyword = trim($request->input('keyword', ''));
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'name_asc');

        $query = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'products.brand_id',
            'products.status'
        )
            ->where('products.status', 1);

        if ($keyword !== '') {
            $query->where('products.productname', 'like', "%{$keyword}%")
                ->orWhere('products.description', 'like', "%{$keyword}%")
                ->where('products.status', 1);
        }

        if ($minPrice !== null && $minPrice !== '') {
            $query->where('products.price', '>=', (float) $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('products.price', '<=', (float) $maxPrice);
        }

        if ($sort === 'price_asc') {
            $query->orderBy('products.price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('products.price', 'desc');
        } else {
            $query->orderBy('products.productname', 'asc');
        }

        $products = $query->paginate($limit)->appends($request->query());

        return view('client.products.search', compact('products', 'keyword', 'minPrice', 'maxPrice', 'sort'));
    }
}
