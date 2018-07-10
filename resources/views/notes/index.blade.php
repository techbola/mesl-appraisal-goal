@extends('layouts.master')

@section('title')

@endsection

@section('content')

  <style>
    #page_content_inner {
      padding: 0px !important;
    }
  </style>

  <div id="page_content">
    <div id="page_content_inner">

        <div class="uk-grid">
            <div class="uk-width-medium-3-5 uk-width-large-2-5 uk-container-center">
                <div class="md-card">
                    <div class="md-card-content">
                        <span class="note_form_text">Add note</span>
                        <div id="note_form"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-container-center uk-margin-large-top" data-uk-grid="{gutter: 20, controls: '#notes_grid_filter'}" id="notes_grid">
          @foreach ($user->sticky_notes as $note)
            <div class="content-editable" @{{#exists labels}}data-uk-filter="@{{#each labels }}@{{#ifCond @key '>' 0}},@{{/ifCond}}@{{ text_safe }}@{{/each}}"@{{/exists}}>
                <div class="md-card {{ $note->Color }}">
                    <div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
                        <a href="#" class="note_action_remove" onclick="confirm2('Delete this note?', '', 'delete_{{ $note->NoteRef }}')"><i class="md-icon material-icons">&#xE5CD;</i></a>

                    </div>
                    <div class="md-card-content">
                        <h2 class="heading_b uk-margin-large-right">{{ $note->Title }}</h2>

                        <p>{!! $note->Body !!}</p>

                        @if (count($note->checklists) > 0)
                          <ul class="uk-list">
                            @foreach ($note->checklists as $check)
                              <li class="uk-margin-small-top">
                                <input type="checkbox" id="checkbox_{{ $check->id }}" data-md-icheck {{ ($check->Checked)? 'checked':'' }}/>
                                <label for="checkbox_{{ $check->id }}" class="inline-label">{{ $check->Title }}</label>
                              </li>
                            @endforeach
                          </ul>
                        @endif

                        {{-- @{{#exists labels}}

                        <div class="uk-margin-medium-top">
                            @{{#each labels }}
                            <span class="uk-badge uk-badge-@{{ type }}">@{{ text }}</span>
                            @{{/each}}
                        </div>
                        @{{/exists}} --}}

                        {{-- @{{#exists time}} --}}
                        <div class="clearfix">

                          <span class="uk-margin-top uk-text-italic uk-text-muted uk-display-block uk-text-small pull-left">{{ $note->created_at->format('jS M Y g:ia') }}</span>
                          <span class="pull-right">
                            <i class="fa fa-pencil pointer edit_btn" data-id="{{ $note->NoteRef }}" data-toggle="modal" data-target="#edit_note"></i>
                          </span>
                        </div>
                        {{-- @{{/exists}} --}}
                    </div>
                </div>
            </div>

            <form id="delete_{{ $note->NoteRef }}" action="{{ route('delete_note', $note->NoteRef) }}" method="post" style="display:none">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>
          @endforeach
        </div>

    </div>
</div>

<script id="note_template" type="text/x-handlebars-template">
    @{{#each this}}
    <div @{{#exists labels}}data-uk-filter="@{{#each labels }}@{{#ifCond @key '>' 0}},@{{/ifCond}}@{{ text_safe }}@{{/each}}"@{{/exists}}>
        <div class="md-card @{{#exists color}}@{{color}}@{{/exists}}">
            <div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
                <a href="#" class="note_action_remove"><i class="md-icon material-icons">&#xE5CD;</i></a>
                <!--<div class="uk-display-inline-block" data-uk-dropdown="{pos:'bottom-right'}">
                    <div class="uk-dropdown uk-dropdown-small">
                        <ul class="uk-nav">
                            <li><a href="#" class="note_action_edit">Edit</a></li>
                            <li><a href="#" class="note_action_remove">Remove</a></li>
                        </ul>
                    </div>
                </div>-->
            </div>
            <div class="md-card-content">
                <h2 class="heading_b uk-margin-large-right">@{{ title }}</h2>
                <p>@{{{ content }}}</p>

                @{{#exists checklist}}
                    <ul class="uk-list">
                        @{{#each checklist }}
                        <li class="uk-margin-small-top">
                            <input type="checkbox" id="checkbox_@{{#if id}}@{{id}}@{{else}}@{{@../index}}_@{{@index}}@{{/if}}" data-md-icheck @{{#if checked}}checked@{{/if}}/>
                            <label for="checkbox_@{{#if id}}@{{id}}@{{else}}@{{@../index}}_@{{@index}}@{{/if}}" class="inline-label">@{{title}}</label>
                        </li>
                        @{{/each}}
                    </ul>
                @{{/exists}}

                @{{#exists labels}}
                <div class="uk-margin-medium-top">
                    @{{#each labels }}
                    <span class="uk-badge uk-badge-@{{ type }}">@{{ text }}</span>
                    @{{/each}}
                </div>
                @{{/exists}}
                @{{#exists time}}
                    <span class="uk-margin-top uk-text-italic uk-text-muted uk-display-block uk-text-small">@{{ dateFormat time format='DD/MM/YYYY' }}</span>
                @{{/exists}}
            </div>
        </div>
    </div>
    @{{/each}}
</script>

<script id="note_form_template" type="text/x-handlebars-template">
    <form action="">
        <div class="uk-form-row">
            <label>Title</label>
            <input type="text" class="md-input" id="note_f_title"/>
        </div>
        <div class="uk-form-row">
            <label>Note content</label>
            <textarea type="text" class="md-input" placeholder="" id="note_f_content"></textarea>
        </div>
        <div class="uk-form-row uk-hidden" id="notes_checklist">
            <label>Checklist (sortable)</label>
            <ul class="uk-list uk-list-hover uk-sortable-single" data-uk-sortable></ul>
            <div class="uk-input-group">
                <input type="text" class="md-input" id="checklist_item" placeholder="add item" />
                <span class="uk-input-group-addon">
                    <a href="#" id="checkbox_add"><i class="material-icons md-24">&#xE145;</i></a>
                </span>
            </div>
        </div>
        <div class="uk-form-row" id="notes_labels"></div>
        <div class="uk-form-row uk-clearfix">
            <div class="uk-float-left">
                <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                    <a href="#"><i class="material-icons md-24">&#xE3B7;</i></a>
                    <div class="uk-dropdown uk-dropdown-blank" id="notes_cp"></div>
                </div><!--
                -->

                <!-- Labels Button -->
                <!-- <div class="uk-button-dropdown uk-margin-left" data-uk-dropdown="{mode:'click'}">
                    <a href="#"><i class="material-icons md-24">&#xE892;</i></a>
                    <div class="uk-dropdown uk-dropdown-blank" id="dropdown_labels">
                        @{{#each labels }}
                            <div class="uk-margin-small-top">
                                <input type="checkbox" id="checkbox_@{{ text_safe }}" name="labels" data-md-icheck data-label="@{{text}}" data-style="@{{type}}"/>
                                <label for="checkbox_@{{ text_safe }}" class="inline-label"><span class="uk-badge uk-badge-@{{type}}">@{{ text }}</span></label>
                            </div>
                        @{{/each}}
                    </div>
                </div> -->

                <!--
                -->
                <!-- Sub Todos List -->

                <a href="#" class="uk-margin-left" data-uk-toggle="{target:'#notes_checklist'}"><i class="material-icons md-24">&#xE065;</i></a>

            </div>
            <div class="uk-float-right">
                <a href="#" class="md-btn md-btn-primary" id="note_add">Add Note</a>
            </div>
        </div>
    </form>
</script>
<script id="note_form_checkbox_template" type="text/x-handlebars-template">
    <li class="uk-margin-small-top uk-clearfix">
        <a href="#" class="uk-float-right remove_checklist_item"><i class="material-icons">&#xE5CD;</i></a>
        <div class="uk-nbfc">
            <input type="checkbox" id="checkbox_@{{ id }}" name="checkboxes" data-md-icheck data-title="@{{ title }}" />
            <label for="checkbox_@{{ id }}" class="inline-label">@{{ title }}</label>
        </div>
    </li>
</script>



<!-- Modal -->
<div class="modal fade slide-up disable-scroll" id="edit_note" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5>Edit Note</h5>
          {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
        </div>
        <div class="modal-body">
          <form action="">
              <div class="uk-form-row">
                  <label>Title</label>
                  <input type="text" class="md-input" name="Title"/>
              </div>
              <div class="uk-form-row">
                  <label>Note content</label>
                  <textarea type="text" class="md-input" placeholder="" name="Body"></textarea>
              </div>
              <div class="uk-form-row uk-hidden" id="notes_checklist">
                  <label>Checklist (sortable)</label>
                  <ul class="uk-list uk-list-hover uk-sortable-single" data-uk-sortable></ul>
                  <div class="uk-input-group">
                      <input type="text" class="md-input" id="checklist_item" placeholder="add item" />
                      <span class="uk-input-group-addon">
                          <a href="#" id="checkbox_add"><i class="material-icons md-24">&#xE145;</i></a>
                      </span>
                  </div>
              </div>
              <div class="uk-form-row" id="notes_labels"></div>
              <div class="uk-form-row uk-clearfix">
                  <div class="uk-float-left">
                      <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                          <a href="#"><i class="material-icons md-24">&#xE3B7;</i></a>
                          <div class="uk-dropdown uk-dropdown-blank" id="notes_cp"></div>
                      </div>

                      <a href="#" class="uk-margin-left" data-uk-toggle="{target:'#notes_checklist'}"><i class="material-icons md-24">&#xE065;</i></a>

                  </div>
                  <div class="uk-float-right">
                      <a href="#" class="md-btn md-btn-primary" id="note_add">Edit Note</a>
                  </div>
              </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@push('scripts')
  <link rel="stylesheet" href="{{ asset('assets/plugins/altair/uikit.almost-flat.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/altair/main.min.css') }}">
  <!-- common functions -->
  <script src="{{ asset('assets/plugins/altair/common.min.js') }}" charset="utf-8"></script>
  <!-- uikit functions -->
  <script src="{{ asset('assets/plugins/altair/uikit_custom.min.js') }}" charset="utf-8"></script>
  <!-- altair common functions/helpers -->
  <script src="{{ asset('assets/plugins/altair/admin_common.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/plugins/altair/handlebars.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/plugins/altair/handlebars_helpers.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/plugins/sticky_notes/sticky_notes.js') }}" charset="utf-8"></script>

  <script>
    // var edit_btn = $('.edit_btn');
    $(document).on('click', '.edit_btn', function(){
      // console.log($(this).data('id'));
      $.get('/get_note/'+$(this).data('id'), function(data, status){
        console.log('OK');
        $('#edit_note input[name=Title]').val(data.Title);
        $('#edit_note textarea[name=Body]').val(data.Body);
      });

    });
  </script>
@endpush
