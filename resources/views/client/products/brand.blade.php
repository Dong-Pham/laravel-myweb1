@extends('client.layouts.app')
@section('title', $brand->brandname)
@section('content')
    <div class="container py-4">
        <h3 class="mb-4">
            Thương hiệu: {{ $brand->brandname }}
        </h3>

        @if ($products->isEmpty())
            <div class="alert alert-warning">
                Không có sản phẩm nào thuộc thương hiệu này.
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
