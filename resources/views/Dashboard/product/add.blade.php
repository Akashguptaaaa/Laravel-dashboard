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
				<h2>Add Product</h2>
				<div class="card-body">						
				 <a href="{{ route('view.product') }}" class="mb-1 btn btn-info float-right">Back</a>
			   </div>
			</div>
			<div class="card-body">
				<form  action="{{ route('store.product') }}" method="post" id="categoryForm">
					@csrf
					<div class="form-row">

						<div class="col-md-12 mb-3">
							<label for="validationServer01">Category</label>
							<div class="form-group">
								<select class="js-example-basic form-control" name="category_id" id="validationServer01">
									<option>Select the Category</option>
									@foreach($categories as $key=>$cagtegory)
									<option value="{{$cagtegory->id}}">{{$cagtegory->category_name}}</option>
									@endforeach
									
								</select>
							</div>
						</div>
						<div class="col-md-12 mb-3">
							<label for="validationServer02">Product Name</label>
							<input type="text" class="form-control is-valid" id="validationServer02" name="product_name" placeholder="Product Name">
						</div>

						<div class="col-md-12 mb-3">
							<label for="validationServer03">Product Description</label>
							<input type="text" class="form-control is-valid" id="validationServer03" name="product_description" placeholder="Product Description">
						</div>

						<div class="col-md-12 mb-3">
							<label for="validationServer04">Product Price</label>
							<input type="text" class="form-control is-valid" id="validationServer04" name="product_price" placeholder="Product Price">
						</div>
 
                       <div class="row">
                       	
							<div class="col-md-4 mb-3">
								<label for="validationServer05">Product Color</label>
								<input type="text" class="form-control is-valid" id="validationServer05" name="product_color[]" placeholder="Product Color">
							</div>

							<div class="col-md-4 mb-3">
								<label for="validationServer06">Product Size</label>
								<input type="text" class="form-control is-valid" id="validationServer06" name="product_size[]" placeholder="Product Size">
							</div>

							
							<div class="col-md-4 mb-3" id="add_delete_buttons">
                                    <a style="margin-top: 25px;" href="javascript:void(0)" class="btn btn-info add_color_size pull-right">Add</a>
							</div>


                       </div>
							<div class="add_multiple_color_size_text_field">
	                               <input type="hidden" value="1" id="total_count">
	                        </div>

						

						<div class="col-md-12 mb-3">
							<label for="validationServer08">Status</label>
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
	            category_id: {
	                required: true,
	            },
	            product_name: {
	                required: true,
	            },
	            product_description: {
	                required: true,
	            },
	            product_price: {
	                required: true,
	            },
	            'product_color[]': {
	                required: true,
	            },
	            'product_size[]': {
	                required: true,
	            },
	            
	        },

	        messages:
	        {
	            category_id: {
	                required:"{{trans('Select the category Name Required')}}",
	            },
	            product_name: {
	                required:"{{trans('Product Name is Required')}}",
	            },
	            product_description: {
	                required:"{{trans('Product Description is Required')}}",
	            },
	            product_price: {
	                required:"{{trans('Product Price is Required')}}",
	            },
	            'product_color[]': {
	                required:"{{trans('Product Color is Required')}}",
	            },
	            'product_size[]': {
	                required:"{{trans('Product Size is Required')}}",
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


        $('.add_color_size').on('click', add_multiple_color_size);

         function add_multiple_color_size() {
         	var total_count = parseInt($('#total_count').val()) + 1;

         	var row_start ='<div class="row">'+ 
			   '<div class="col-md-4 mb-3">'+
			   '<input type="text" class="form-control is-valid" id="validationServer01" name="product_color[]" placeholder="Product Color">'+
			   '</div>'+
			   '<div class="col-md-4 mb-3">'+
			   '<input type="text" class="form-control is-valid" id="validationServer01" name="product_size[]" placeholder="Product Size">'+
			   '</div>'+
			    '<div class="col-md-4 mb-3" id="add_delete_buttons">'+
                    ' <a class="btn btn-danger remove_award_festival pull-right" href="javascript:void(0)" margin-top: 25px;">Delete</a>'+
                '</div>'+
                '</div>'
	

			  $('.add_multiple_color_size_text_field').append(row_start);
			  //$('.start_end').append(row_end);

			  $('#total_count').val(total_count);

			  $(document).on('click', '.remove_award_festival', function(){
		        var last_chq_no = $('#total_count').val();
		        $('#total_count').val(last_chq_no - 1);
		        $(this).parent().parent().remove();
		    });
         }	
	});	
</script>
@endsection