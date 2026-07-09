<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Query Builder
        // $list = DB::table('products')
        //     ->join('categories', 'products.cateid', '=', 'categories.cateid')
        //     ->leftJoin('brands', 'products.brand_id', '=', 'brands.brand_id')
        //     ->select(
        //         'products.id',
        //         'products.productname',
        //         'products.price',
        //         'products.pricediscount',
        //         'products.image',
        //         'products.status',
        //         'categories.catename',
        //         'brands.brandname'
        //     )
        //     ->orderBy('products.productname')
        //     ->get();
        // return view('admin.products.index', ['list' => $list]);

        // ==== ORM Eloquent ====
        $list = Product::with([
            'category:cateid,catename',
            'brand:brand_id,brandname'
        ])
            ->select(
                'id',
                'productname',
                'price',
                'pricediscount',
                'image',
                'status',
                'cateid',
                'brand_id'
            )
            ->orderBy('productname')
            ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('brand_id', 'brandname')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            // Upload hình ảnh chính
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }
            // Lưu sản phẩm vào cơ sở dữ liệu
            $product = Product::create([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'cateid' => $request->cateid,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $fileName

            ]);
            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time(); // cùng timestamp
                foreach ($request->file('imgs') as $file) {
                    // 15_1751363000_1.jpg
                    $fileName = $product->id
                        . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $fileName, 'public');
                    // Lưu vào bảng product_images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                    $i++;
                }
            }
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Chi tiết sản phẩm có id: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->findOrfail($id);
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('brand_id', 'brandname')->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $product->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('products/' . $product->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)

                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }

            // Thực hiện cập nhật sản phẩm
            $product->update([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'cateid' => $request->cateid,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $fileName
            ]);

            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time(); // cùng timestamp
                foreach ($request->file('imgs') as $file) {
                    // 15_1751363000_1.jpg
                    $fileName = $product->id
                        . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $fileName, 'public');
                    // Lưu vào bảng product_images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                    $i++;
                }
            }

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }

    public function test2()
    {
        return redirect('/admin/dashboard');
    }

    /**
     * Delete a single product image (AJAX or normal request).
     */
    public function deleteImage(Product $product, ProductImage $image, Request $request)
    {
        try {
            if ($image->product_id != $product->id) {
                return response()->json(['success' => false, 'message' => 'Ảnh không thuộc sản phẩm này.'], 403);
            }

            // Remove file from public storage
            if ($image->image && Storage::disk('public')->exists('products/' . $image->image)) {
                Storage::disk('public')->delete('products/' . $image->image);
            }

            // Delete DB record
            ProductImage::destroy($image->id);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Xóa ảnh thành công']);
            }

            return redirect()->back()->with('success', 'Xóa ảnh thành công');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
