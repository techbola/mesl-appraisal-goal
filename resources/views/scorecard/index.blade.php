@extends('layouts.master')

@section('title')
  Score Card
@endsection

@section('buttons')
  <a href="{{ route('create_scorecard', $staff->StaffRef) }}" class="btn btn-sm btn-info btn-rounded"><i class="fa fa-plus"></i> Create ScoreCard</a>
@endsection

@section('content')

  <div class="card-box">
    <div class="card-title pull-left">Your Score Card</div>
    <div class="pull-right">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
		</div>
    <table class="table table-bordered table-striped tableWithSearch">
    <thead>
      <tr>
        <th>KPI</th>
        <th>Target</th>
        <th>Achievement</th>
        <th>Comment</th>
        <th>PeriodFrom</th>
        <th>PeriodTo</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody id="tx_rows">
      @foreach ($staff->scorecards as $score)
        <tr>
          {{-- KPI --}}
          <td>
            {{ $score->KPI }}
          </td>
          {{-- AMOUNT --}}
          <td>
            {{ $score->Target }}
          </td>
          {{-- ACHIEVEMENT --}}
          <td>
            {{ $score->Achievement }}
          </td>
          {{-- COMMENT --}}
          <td>
            {{ $score->Comment }}
          </td>
          {{-- PERIOD FROM --}}
          <td>
            {{ $score->PeriodFrom }}
          </td>
          {{-- PERIOD TO --}}
          <td>
            {{ $score->PeriodTo }}
          </td>

          <td class="actions">
            <a href="#" class="btn btn-xs btn-inverse" data-toggle="modal" data-target="#edit_item" @click="edit_item({{ $score }})">Edit</a>
            @can ('company-admin')
              <a onclick="confirm2('Delete this item?', '', 'delete_{{ $score->ScoreCardRef }}')" class="btn btn-xs btn-danger">Delete</a>
              <form id="delete_{{ $score->ScoreCardRef }}" class="hidden" action="{{ route('delete_scorecard', $score->ScoreCardRef) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
            @endcan
          </td>

        </tr>
      @endforeach
    </tbody>
    {{-- <tfoot>
      <tr>
        <td id="balance_error" colspan="8" class="text-danger text-center"><i class="fa fa-times m-r-5"></i>Debit and Credit amounts must balance.</td>
        <td id="balance_ok" colspan="8" class="text-success text-center" style="display:none"><i class="fa fa-check m-r-5"></i>Debit and Credit amounts are balanced.</td>
      </tr>
    </tfoot> --}}

  </table>
  </div>


{{-- EDIT MODAL --}}
  <div class="modal fade" id="edit_item" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Edit Score Card Item</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form action="" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            @can ('company-admin')
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>KPI</label>
                    <input type="text" name="KPI" class="form-control" v-model="item.KPI" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Target</label>
                    <input type="text" name="Target" class="form-control" v-model="item.Target" required>
                  </div>
                </div>
              </div>
            @endcan

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Achievement</label>
                  <textarea name="Achievement" class="form-control" v-model="item.Achievement" rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Comment</label>
                  <textarea name="Comment" class="form-control" v-model="item.Comment" rows="3"></textarea>
                </div>
              </div>
            </div>

            @can ('company-admin')
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Period From</label>
                    <div class="input-group date dp">
                      <input type="text" name="PeriodFrom" class="form-control input-sm" v-model="item.PeriodFrom" required>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="form-group">
                    <label>Period To</label>
                    <div class="input-group date dp">
                      <input type="text" name="PeriodTo" class="form-control input-sm" v-model="item.PeriodTo" required>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            @endcan

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Submit</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('vue')
  <script>
    var base = "{{ url('/') }}";
    new Vue({
      el: '#app',
      data: {
        item: {}
      },
      methods: {
        edit_item(item){
          this.item = item;
          console.log(item);
          $('#edit_item form').attr('action', base + '/update_scorecard/' + item.ScoreCardRef);
        }
      }
    });
  </script>
@endpush
