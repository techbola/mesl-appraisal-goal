@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
        textarea {
        max-height: 50px;
        resize: none;
    }
    </style>
    @endpush
@include('errors.list')
   <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('PostingTypeID', 'Posting Type') }}
                        {{ Form::select('PostingTypeID', [ 0 =>  'Select Posting Type'] + $posting_types->pluck('Posting Type', 'SecurityRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('GLID', 'GL') }}
                        {{ Form::select('GLID', [ 0 =>  'Select GL'] + $gls->pluck('GL', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>

        </div>

    <div class="row">
        <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                    {{ Form::label('PostDate', 'Post Date') }}
                    <div class="input-group date dp">
                     {{ Form::text('PostDate', null, ['class' => 'form-control', 'placeholder' => 'Post Date']) }}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </span>

                </div>
            </div>
                </div>
        </div>
        <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                    {{ Form::label('ValueDate', 'Value Date') }}
                    <div class="input-group date dp">
                     {{ Form::text('ValueDate', null, ['class' => 'form-control', 'placeholder' => 'Value Date']) }}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </span>

                </div>
            </div>
                </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Amount' ) }}
                        {{ Form::text('Amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('TransactionTypeID', 'Transaction Type') }}
                        {{ Form::select('TransactionTypeID', [ 0 =>  'Select Transaction Type'] + $transaction_types->pluck('TransactionType', 'TransactionTypeRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
    </div>
    <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('Narration', 'Narration') }}
                        {{ Form::textarea('Narration', null, ['class' => 'form-control', 'placeholder' => 'Enter Narration']) }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- action buttons -->
        <div class="row">
            <div class="pull-right">
                {{ Form::hidden('InputterID',auth()->user()->id) }}
                {{ Form::hidden('ModifierID',auth()->user()->id) }}
            {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
                {{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
            </div>
        </div>
        @push('scripts')
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
        </script>
        <script>
        $(function(){
            var options = {
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            };
            $('.dp').datepicker(options);
        })
    </script>
        @endpush