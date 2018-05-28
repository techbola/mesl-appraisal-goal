@extends('layouts.master')

@section('buttons')
  <a href="{{ route('create_call_memo', $contact->CustomerRef) }}" class="btn btn-sm btn-info btn-rounded">New Memo</a>
@endsection

@section('title')

@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">
      Call Memo - {{ $contact->Customer }} {{ ($contact->Organization)? '- '.$contact->Organization : '' }}
    </div>
  </div>
@endsection
