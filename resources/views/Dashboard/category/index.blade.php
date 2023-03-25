@extends('Dashboard.master')
@section('content')

<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>View Category</h2>
		   <div class="card-body">						
			 <a href="{{ route('add.category') }}" class="mb-1 btn btn-info float-right">Add Category</a>
		   </div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lists as $key=>$list)
					<tr class="table-secondary">
						<td scope="row">{{$key+1}}</td>
						<td>{{$list->category_name}}</td>
						@if($list->status == 1)
						<td>Active</td>
						@else
						<td>De-Active</td>
						@endif
						<td><a href="{{ route('edit.category',$list->id) }}" class="btn btn-info sm" title="Edit Data"><span class="mdi mdi-square-edit-outline"></a>
                        <a href="{{route('destroy.category',$list->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"><span class="mdi mdi-delete-forever-outline"></span></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection