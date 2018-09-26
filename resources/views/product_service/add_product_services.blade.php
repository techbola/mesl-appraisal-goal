<div class="row">
	 <div class="col-sm-6">
         <div class="form-group">
             {{ Form::label('Category', 'category') }}
                <select name="CategoryID" id="cat_id"   class="form-control select2" data-init-plugin="select2" required>
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
             <input type="text" class="form-control" id="p_Code" name="ProductCode">
         </div>
     </div>

     <div class="col-sm-12">
         <div class="form-group">
            {{ Form::label('Location', 'Location') }}
             <select name="LocationID"  class="form-control select2" data-init-plugin="select2" required>
                <option>Select Location</option>
                 @foreach($locations as $location)
                    <option value="{{ $location->LocationRef }}">{{ $location->Location }}</option>
                 @endforeach
             </select>
        </div>
    </div>


    <div class="col-sm-12">
        <div class="form-group">
            {{ Form::label('Product', 'Product Name') }}
            <input type="text" class="form-control" name="ProductService">
        </div>
     </div>

     <input type="hidden" name="Quantity" value="0">
     <input type="hidden" name="OwnerID" value="1">

     <div class="row">
     	<button class="btn btn-primary btn-sm pull-right" id="submit_new_product_service">Submit</button>
     </div>
</div>