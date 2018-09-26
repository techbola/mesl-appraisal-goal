<div class="row">
	 <div class="col-sm-6">
         <div class="form-group">
             {{ Form::label('Category', 'category') }}
                <select name="CategoryID"  class="form-control select2" data-init-plugin="select2" required>
                 <option value=" ">Select category</option>
                  @foreach($categories as $category)
                      <option value="{{ $category->ProductCategoryRef }}">{{ $category->ProductCategory }}</option>
                  @endforeach
                </select>
         </div>
     </div>

     <div class="col-sm-6">
         <div class="form-group">
             {{ Form::label('Product Code', 'Product Code') }}
             <input type="text" class="form-control" name="ProductCode">
         </div>
     </div>

     <div class="col-sm-12">
         <div class="form-group">
             {{ Form::label('ProductName', 'Product Name') }}
             <input type="text" class="form-control" name="Product">
         </div>
     </div>

     <input type="hidden" name="Quantity" value="0">

     <div class="row">
     	<button class="btn btn-primary btn-sm pull-right" id="submit_new_product">Submit</button>
     </div>
</div>