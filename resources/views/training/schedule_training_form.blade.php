                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Select Staff(s)' ) }}
                                               {{ Form::select('StaffID', [ ' ' =>  'Select Staff'] + $staffs->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Agency Name", 'data-init-plugin' => "select2",'multiple' =>'multiple', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Training' ) }}
                                               {{ Form::text('TrainingType', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Input Training Type', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Start Date' ) }}
                                               <div class="input-group date dp">
                                                   {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
                                                   <span class="input-group-addon">
                                                       <i class="fa fa-calendar">
                                                         </i>
                                                   </span>
                                               </div>
                                       </div>
                                  </div>
                              </div><div class="clearfix"></div>

                                <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('End Date' ) }}
                                               <div class="input-group date dp">
                                                   {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
                                                   <span class="input-group-addon">
                                                       <i class="fa fa-calendar">
                                                         </i>
                                                   </span>
                                               </div>
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-8">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Training Venue' ) }}
                                               {{ Form::text('Venue', null, ['class' => 'form-control', 'placeholder' => 'Training Venue', 'required']) }}
                                       </div>
                                  </div>
                              </div><div class="clearfix"></div>
                              <div class="row">
                              {{--  <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('State' ) }}
                                               {{ Form::select('State', [ 0 =>  'Select Company State'] + $states->pluck('State', 'StateRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Company State", 'data-init-plugin' => "select2"]) }}
                                       </div>
                                  </div>
                              </div> --}}


                               {{-- <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Country' ) }}
                                               {{ Form::select('Country', [ 0 =>  'Select Company Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Company Country", 'data-init-plugin' => "select2"]) }}
                                       </div>
                                  </div>
                              </div> --}}

                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Upload Course Outline' ) }}
                                               {{ Form::file('CourseOutLine', null, ['class' => 'form-control', 'placeholder' => 'Upload Course Outline']) }}
                                       </div>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_course"  value="Add New Course">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="edit_course" data-dismiss="modal" value="Save Course">
                                <input type="submit" class="btn btn-sm btn-danger pull-right hide" id="delete_course" data-dismiss="modal" value="Delete Course">
                              </div><p id="xyz" class="hide"></p>