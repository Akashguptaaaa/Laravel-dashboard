@extends('Dashboard.master')
@section('css')
<style>
	.error{
		color: red;
	}
</style>
@endsection
@section('content')
	<div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Add Category</h2>
				<div class="card-body">						
				 <a href="{{ route('view.category') }}" class="mb-1 btn btn-info float-right">Back</a>
			   </div>
			</div>
			<div class="card-body">
				<form  action="{{ route('store.category') }}" method="post" id="categoryForm">
					@csrf
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="validationServer01">Category</label>
							<input type="text" class="form-control is-valid" id="validationServer01" name="category_name" placeholder="Category Name">
						</div>

						<div class="col-md-12 mb-3">
							<label for="validationServer01">Status</label>
							<div class="form-group">
								<select class="js-example-basic form-control" name="status">
									<option>Select the Status</option>
									<option value="1">Active</option>
									<option value="0">De-Active</option>
								</select>
							</div>
						</div>
						
					</div>
					<button class="btn btn-primary" type="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
@endsection

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js" defer></script>
@section('js')
<script type="text/javascript">
	$(document).ready(function(){

		$('#categoryForm').validate({
	        rules:
	        {
	            category_name: {
	                required: true,
	            },
	        },

	        messages:
	        {
	            category_name: {
	                required:"{{trans('Category Name is Required')}}",
	            },
	        },
	        errorPlacement: function(error, element) {

	            error.appendTo(element.parent("div"));

	            if (element.attr('name') == 'question[]') {

	                error.insertAfter('#questionTable');

	            }
	        },
	        submitHandler: function(form) {

	            $(':button[type="submit"]').prop('disabled', true);

	            form.submit();
	        },

        });
	});	
</script>
@endsection