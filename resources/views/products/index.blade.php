@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="/home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Products</h3>
        <div class="card-tools">
            @can('product-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('products.create') }}"><i class="fa fa-plus"></i> Create New Product</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->detail }}</td>
                <td>
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                        @can('product-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')

                        @can('product-delete')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="card-footer">
        <div id="data-table-button-tools" class=""></div>
    </div>
</div>

@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession



{!! $products->links() !!}


@endsection
