<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Query Builder
        // $list = DB::table('categories')
        //     ->select('cateid', 'catename', 'slug', 'image', 'status')
        //     ->where('status', 1)
        //     ->orderBy('catename')
        //     ->get();

        // ==== ORM Eloquent ====
        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->paginate($limit);
        return view('admin.categories.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('cateid', 'catename')->get();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // Query Builder
        // DB::table('categories')->insert([
        //     'catename' => $request->catename,
        //     'slug' => $request->slug,
        // ]);

        // ==== ORM Eloquent ====
        // Category::create([
        //     'catename' => $request->catename,
        //     'slug' => $request->slug,
        //     'status' => $request->status
        // ]);
        // return redirect()->route('admin.categories.index');

        // Thực hiện Validation dữ liệu
        // Tự động lưu lỗi vào $errors và chuyển về trang trước nếu Validation thất bại
        // $request->validate(
        //     // Parram 1: Rules - khai báo các quy tắc kiểm tra dữ liệu
        //     [
        //         'catename' => 'required|min:3|max:100|unique:categories,catename',
        //         'slug' => [
        //             'required',
        //             'min:5',
        //             'max:150',
        //             'unique:categories,slug',
        //             'regex:/^[a-z0-9-]+$/'
        //         ],
        //         'status' => 'required|in:0,1'
        //     ],
        //     // Parram 2: Messages - tùy chỉnh nội dung thông báo lỗi.
        //     [
        //         'required' => ':attribute không được để trống.',
        //         'min' => ':attribute phải từ :min ký tự trở lên.',
        //         'max' => ':attribute không vượt quá :max ký tự.',
        //         'unique' => ':attribute đã tồn tại.',
        //         'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
        //         'status.in' => ':attribute không hợp lệ.'
        //     ],
        //     // Parram 3: Attributes- tên hiển thị của các trường
        //     [
        //         'catename' => 'Tên loại',
        //         'slug' => 'Đường dẫn (Slug)',
        //         'status' => 'Trạng thái'
        //     ]
        // );
        // thêm dữ liệu ... try/catch

        try {
            // upload hình ảnh (nếu có)
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)
                    . '-' . time()
                    . '.' . $file->extension();
                // hình ảnh được lưu vào thư mục storage/app/public/categories
                $file->storeAs('categories', $fileName, 'public');
            }
            // Thực hiện thêm dữ liệu
            Category::create([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $fileName
            ]);
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Thêm danh mục thành công');
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
        return "Chi tiết danh mục có id: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category = DB::table('categories')->where('cateid', $id)->first();
        // return view('admin.categories.edit', compact('category'));
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        // DB::table('categories')
        //     ->where('cateid', $id)
        //     ->update([
        //         'catename' => $request->catename,
        //         'slug' => $request->slug,
        //     ]);
        // return redirect()->route('admin.categories.index');

        // Validate dữ liệu
        // $request->validate(
        //     // Param 1: Rules - khai báo các quy tắc kiểm tra dữ liệu
        //     [
        //         'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id . ',cateid',
        //         'slug' => [
        //             'required',
        //             'min:5',
        //             'max:150',
        //             'regex:/^[a-z0-9-]+$/',
        //             Rule::unique('categories', 'slug')->ignore($id, 'cateid'),
        //         ],
        //         'status' => 'required|in:0,1'
        //     ],
        //     // Param 2: Messages - tùy chỉnh nội dung thông báo lỗi
        //     [
        //         'required' => ':attribute không được để trống.',
        //         'min' => ':attribute phải từ :min ký tự trở lên.',
        //         'max' => ':attribute không vượt quá :max ký tự.',
        //         'unique' => ':attribute đã tồn tại.',
        //         'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
        //         'status.in' => ':attribute không hợp lệ.'
        //     ],
        //     // Param 3: Attributes - tên hiển thị của các trường
        //     [
        //         'catename' => 'Tên loại',
        //         'slug' => 'Đường dẫn (Slug)',
        //         'status' => 'Trạng thái'
        //     ]
        // );

        try {
            // Tìm category theo id
            $category = Category::findOrFail($id);

            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $category->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('categories/' . $category->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)

                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('categories', $fileName, 'public');
            }
            // Cập nhật dữ liệu
            $category->update([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $fileName
            ]);
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('categories')->where('cateid', $id)->delete();
        // return redirect()->route('admin.categories.index');
    }
}
