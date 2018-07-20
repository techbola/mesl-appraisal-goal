@extends('layouts.master')

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div style="background: #fff; padding: 40px">
						<h3>Upload Documents</h3><hr>
						<div class="row">
							{{ Form::open(['action' => 'MergingController@store_files', 'autocomplete' => 'off', 'role' => 'form', 'files'=>'true']) }}
                               <div class="form-group">
                                     <div class="controls">
                                          {{ Form::label( 'Upload Document 1') }}
					                 	{{ Form::file('file1', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch Name']) }}
                                     </div>
                              </div>
                              <div class="form-group">
                                     <div class="controls">
                                          {{ Form::label( 'Upload Document 2') }}
					                 	{{ Form::file('file2', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch Name']) }}
                                     </div>
                              </div>
                              <div class="form-group">
                                     <div class="controls">
                                          {{ Form::label( 'Upload Document 3') }}
					                 	{{ Form::file('file3', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch Name']) }}
                                     </div>
                              </div>
                              <div class="form-group">
                                     <div class="controls">
                                          {{ Form::label( 'Upload Document 4') }}
					                 	{{ Form::file('file4', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch Name']) }}
                                     </div>
                              </div>
                              <div class="form-group">
                                     <div class="controls">
                                          {{ Form::label( 'Upload Document 5') }}
					                 	{{ Form::file('file5', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch Name']) }}
                                     </div>
                              </div>

                              <div class="pull-right">
                              	<input type="submit" class="btn btn-primary" value="Upload">
                              </div>
                              {{ Form::close() }}
                          </div>
					   </div>
					</div>
				</div>
			</div>


		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection

@push('scripts')

@endpush
