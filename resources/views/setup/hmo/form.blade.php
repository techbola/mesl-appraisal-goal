        {{ csrf_field() }}
        <div class="row">
             <div class="col-md-6">
                 <div class="controls">
                     <div class="form-group">
                         {{ Form::label('HMO', 'HMO title' ) }}
                         {{ Form::text('HMO', null, ['class' => 'form-control', 'placeholder' => 'Enter HMO Name', 'required']) }}
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="controls">
                     <div class="form-group">
                         {{ Form::label('HMOCode', 'HMO Code' ) }}
                         {{ Form::text('HMOCode', null, ['class' => 'form-control', 'placeholder' => 'Enter HMO code', 'required']) }}
                     </div>
                 </div>
             </div>
        </div>

        <div class="row">
             <div class="pull-right">
                 <button class="btn btn-info" type="submit">Submit</button>
             </div>
        </div>