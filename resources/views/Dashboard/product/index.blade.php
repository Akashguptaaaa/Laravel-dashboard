@extends('Dashboard.master')
@section('content')

<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>View Product</h2>
			<div class="card-body">						
			 <a href="{{ route('add.product') }}" class="mb-1 btn btn-info float-right">Add Product</a>
		   </div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Category Name</th>
						<th scope="col">Name</th>
						<th scope="col">Description</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $key=>$product)
					<tr class="table-secondary">
						<td scope="row">{{$key+1}}</td>
						<td>{{$product->Category->category_name}}</td>
						<td>{{isset($product->product_name) && $product->product_name !='' ? $product->product_name : ''}}</td>
						<td>{{isset($product->product_description) && $product->product_description != '' ? $product->product_description:'' }}</td>
						<td><a href="{{ route('edit.product',$product->id) }}" class="btn btn-info sm" title="Edit Data"><span class="mdi mdi-square-edit-outline"></a>
                        <a href="{{route('destroy.product',$product->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"><span class="mdi mdi-delete-forever-outline"></span></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection