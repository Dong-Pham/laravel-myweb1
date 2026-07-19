@extends('client.layouts.app')
@section('title', 'Tìm kiếm sản phẩm')
@section('content')
    <div class="container py-4">
        <form action="{{ route('products.search') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Từ khóa</label>
                <input type="text" name="keyword" class="form-control" value="{{ old('keyword', $keyword) }}"
                    placeholder="Nhập tên sản phẩm">
            </div>
            <div class="col-md-2">
                <label class="form-label">Giá từ</label>
                <input type="number" name="min_price" class="form-control" value="{{ old('min_price', $minPrice) }}"
                    min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Đến</label>
                <input type="number" name="max_price" class="form-control" value="{{ old('max_price', $maxPrice) }}"
                    min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Sắp xếp</label>
                <select name="sort" class="form-select">
                    <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                    <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
            </div>
        </form>

        <h3 class="mb-3">
            Kết quả tìm kiếm: "{{ $keyword }}"
        </h3>

        @if ($keyword === '' && $minPrice === null && $maxPrice === null)
            <div class="alert alert-warning">
                Vui lòng nhập từ khóa hoặc khoảng giá để tìm kiếm sản phẩm.
            </div>
        @elseif ($products->isEmpty())
            <div class="alert alert-warning">
                Không tìm thấy sản phẩm phù hợp với bộ lọc hiện tại.
            </div>
        @else
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <x-client.product :product="$product" />
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
