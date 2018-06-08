<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
  <body style="font-family:sans-serif">
    <style>
      .my-list {
        padding-left: 0px;
        margin-top: 50px;
      }
      .my-list li {
        padding: 10px 0;
        border-bottom: 1px solid #f1f1f1;
        margin-bottom: 0;
        list-style: none;
      }
      .my-list li:first-child {
        padding-top: 0px;
      }
      .my-list li:last-child {
        border-bottom: none;
        padding-bottom: 0;
      }

      /* Bootstrap */
      body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff;
      }
      table {
        border-spacing: 0;
        border-collapse: collapse;
      }
      td,
      th {
        padding: 0;
      }
      thead {
        display: table-header-group;
      }
      tr,
      img {
        page-break-inside: avoid;
      }
      .table {
        border-collapse: collapse !important;
      }
      .table td,
      .table th {
        background-color: #fff !important;
      }
      .table-bordered th,
      .table-bordered td {
        border: 1px solid #ddd !important;
      }
    }
    .label {
      border: 1px solid #000;
    }
    .label {
      display: inline;
      padding: .2em .6em .3em;
      font-size: 75%;
      font-weight: bold;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: .25em;
    }
    a.label:hover,
    a.label:focus {
      color: #fff;
      text-decoration: none;
      cursor: pointer;
    }
    .label:empty {
      display: none;
    }
    .btn .label {
      position: relative;
      top: -1px;
    }
    .label-default {
      background-color: #777;
    }
    .label-default[href]:hover,
    .label-default[href]:focus {
      background-color: #5e5e5e;
    }
    .label-primary {
      background-color: #337ab7;
    }
    .label-primary[href]:hover,
    .label-primary[href]:focus {
      background-color: #286090;
    }
    .label-success {
      background-color: #5cb85c;
    }
    .label-success[href]:hover,
    .label-success[href]:focus {
      background-color: #449d44;
    }
    .label-info {
      background-color: #5bc0de;
    }
    .label-info[href]:hover,
    .label-info[href]:focus {
      background-color: #31b0d5;
    }
    .label-warning {
      background-color: #f0ad4e;
    }
    .label-warning[href]:hover,
    .label-warning[href]:focus {
      background-color: #ec971f;
    }
    .label-danger {
      background-color: #d9534f;
    }
    .label-danger[href]:hover,
    .label-danger[href]:focus {
      background-color: #c9302c;
    }
      /*******************/
      table {
        background-color: transparent;
      }
      caption {
        padding-top: 8px;
        padding-bottom: 8px;
        color: #777;
        text-align: left;
      }
      th {
        text-align: left;
      }
      .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
      }
      .table > thead > tr > th,
      .table > tbody > tr > th,
      .table > tfoot > tr > th,
      .table > thead > tr > td,
      .table > tbody > tr > td,
      .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
      }
      .table > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
      }
      .table > caption + thead > tr:first-child > th,
      .table > colgroup + thead > tr:first-child > th,
      .table > thead:first-child > tr:first-child > th,
      .table > caption + thead > tr:first-child > td,
      .table > colgroup + thead > tr:first-child > td,
      .table > thead:first-child > tr:first-child > td {
        border-top: 0;
      }
      .table > tbody + tbody {
        border-top: 2px solid #ddd;
      }
      .table .table {
        background-color: #fff;
      }
      .table-condensed > thead > tr > th,
      .table-condensed > tbody > tr > th,
      .table-condensed > tfoot > tr > th,
      .table-condensed > thead > tr > td,
      .table-condensed > tbody > tr > td,
      .table-condensed > tfoot > tr > td {
        padding: 5px;
      }
      .table-bordered {
        border: 1px solid #ddd;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > tbody > tr > th,
      .table-bordered > tfoot > tr > th,
      .table-bordered > thead > tr > td,
      .table-bordered > tbody > tr > td,
      .table-bordered > tfoot > tr > td {
        border: 1px solid #ddd;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
      }
      .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
      }
      .table-hover > tbody > tr:hover {
        background-color: #f5f5f5;
      }
      table col[class*="col-"] {
        position: static;
        display: table-column;
        float: none;
      }
      table td[class*="col-"],
      table th[class*="col-"] {
        position: static;
        display: table-cell;
        float: none;
      }
      .table > thead > tr > td.active,
      .table > tbody > tr > td.active,
      .table > tfoot > tr > td.active,
      .table > thead > tr > th.active,
      .table > tbody > tr > th.active,
      .table > tfoot > tr > th.active,
      .table > thead > tr.active > td,
      .table > tbody > tr.active > td,
      .table > tfoot > tr.active > td,
      .table > thead > tr.active > th,
      .table > tbody > tr.active > th,
      .table > tfoot > tr.active > th {
        background-color: #f5f5f5;
      }
      .table-hover > tbody > tr > td.active:hover,
      .table-hover > tbody > tr > th.active:hover,
      .table-hover > tbody > tr.active:hover > td,
      .table-hover > tbody > tr:hover > .active,
      .table-hover > tbody > tr.active:hover > th {
        background-color: #e8e8e8;
      }
      .table > thead > tr > td.success,
      .table > tbody > tr > td.success,
      .table > tfoot > tr > td.success,
      .table > thead > tr > th.success,
      .table > tbody > tr > th.success,
      .table > tfoot > tr > th.success,
      .table > thead > tr.success > td,
      .table > tbody > tr.success > td,
      .table > tfoot > tr.success > td,
      .table > thead > tr.success > th,
      .table > tbody > tr.success > th,
      .table > tfoot > tr.success > th {
        background-color: #dff0d8;
      }
      .table-hover > tbody > tr > td.success:hover,
      .table-hover > tbody > tr > th.success:hover,
      .table-hover > tbody > tr.success:hover > td,
      .table-hover > tbody > tr:hover > .success,
      .table-hover > tbody > tr.success:hover > th {
        background-color: #d0e9c6;
      }
      .table > thead > tr > td.info,
      .table > tbody > tr > td.info,
      .table > tfoot > tr > td.info,
      .table > thead > tr > th.info,
      .table > tbody > tr > th.info,
      .table > tfoot > tr > th.info,
      .table > thead > tr.info > td,
      .table > tbody > tr.info > td,
      .table > tfoot > tr.info > td,
      .table > thead > tr.info > th,
      .table > tbody > tr.info > th,
      .table > tfoot > tr.info > th {
        background-color: #d9edf7;
      }
      .table-hover > tbody > tr > td.info:hover,
      .table-hover > tbody > tr > th.info:hover,
      .table-hover > tbody > tr.info:hover > td,
      .table-hover > tbody > tr:hover > .info,
      .table-hover > tbody > tr.info:hover > th {
        background-color: #c4e3f3;
      }
      .table > thead > tr > td.warning,
      .table > tbody > tr > td.warning,
      .table > tfoot > tr > td.warning,
      .table > thead > tr > th.warning,
      .table > tbody > tr > th.warning,
      .table > tfoot > tr > th.warning,
      .table > thead > tr.warning > td,
      .table > tbody > tr.warning > td,
      .table > tfoot > tr.warning > td,
      .table > thead > tr.warning > th,
      .table > tbody > tr.warning > th,
      .table > tfoot > tr.warning > th {
        background-color: #fcf8e3;
      }
      .table-hover > tbody > tr > td.warning:hover,
      .table-hover > tbody > tr > th.warning:hover,
      .table-hover > tbody > tr.warning:hover > td,
      .table-hover > tbody > tr:hover > .warning,
      .table-hover > tbody > tr.warning:hover > th {
        background-color: #faf2cc;
      }
      .table > thead > tr > td.danger,
      .table > tbody > tr > td.danger,
      .table > tfoot > tr > td.danger,
      .table > thead > tr > th.danger,
      .table > tbody > tr > th.danger,
      .table > tfoot > tr > th.danger,
      .table > thead > tr.danger > td,
      .table > tbody > tr.danger > td,
      .table > tfoot > tr.danger > td,
      .table > thead > tr.danger > th,
      .table > tbody > tr.danger > th,
      .table > tfoot > tr.danger > th {
        background-color: #f2dede;
      }
      .table-hover > tbody > tr > td.danger:hover,
      .table-hover > tbody > tr > th.danger:hover,
      .table-hover > tbody > tr.danger:hover > td,
      .table-hover > tbody > tr:hover > .danger,
      .table-hover > tbody > tr.danger:hover > th {
        background-color: #ebcccc;
      }
      .table-responsive {
        min-height: .01%;
        overflow-x: auto;
      }
      @media screen and (max-width: 767px) {
        .table-responsive {
          width: 100%;
          margin-bottom: 15px;
          overflow-y: hidden;
          -ms-overflow-style: -ms-autohiding-scrollbar;
          border: 1px solid #ddd;
        }
        .table-responsive > .table {
          margin-bottom: 0;
        }
        .table-responsive > .table > thead > tr > th,
        .table-responsive > .table > tbody > tr > th,
        .table-responsive > .table > tfoot > tr > th,
        .table-responsive > .table > thead > tr > td,
        .table-responsive > .table > tbody > tr > td,
        .table-responsive > .table > tfoot > tr > td {
          white-space: nowrap;
        }
        .table-responsive > .table-bordered {
          border: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:first-child,
        .table-responsive > .table-bordered > tbody > tr > th:first-child,
        .table-responsive > .table-bordered > tfoot > tr > th:first-child,
        .table-responsive > .table-bordered > thead > tr > td:first-child,
        .table-responsive > .table-bordered > tbody > tr > td:first-child,
        .table-responsive > .table-bordered > tfoot > tr > td:first-child {
          border-left: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:last-child,
        .table-responsive > .table-bordered > tbody > tr > th:last-child,
        .table-responsive > .table-bordered > tfoot > tr > th:last-child,
        .table-responsive > .table-bordered > thead > tr > td:last-child,
        .table-responsive > .table-bordered > tbody > tr > td:last-child,
        .table-responsive > .table-bordered > tfoot > tr > td:last-child {
          border-right: 0;
        }
        .table-responsive > .table-bordered > tbody > tr:last-child > th,
        .table-responsive > .table-bordered > tfoot > tr:last-child > th,
        .table-responsive > .table-bordered > tbody > tr:last-child > td,
        .table-responsive > .table-bordered > tfoot > tr:last-child > td {
          border-bottom: 0;
        }
      }
      /* Bring back Bootstrap styles that Pages.css was overriding */
    .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        padding: 10px !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        line-height: 1.42857143 !important;
        vertical-align: top !important;
    }
    .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
      border-top: 1px solid #ddd;
    }
    .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        /* border: 1px solid #555; */
        border: 1px solid #ddd;
    }
    .table-bordered {
        /* border: 1px solid #555 !important; */
        border: 1px solid #ddd !important;
    }
    .table-bordered th {
      border-bottom: 0 !important;
      color: #999 !important;
      background-color: #f5f5f6 !important;
      text-transform: capitalize !important;
    }
    .table-bordered tbody tr td {
      font-size: 14px;
    }
    </style>

    <div class="" style="text-align:center; margin-bottom:20px">
      <img src="{{ asset('images/logos/'.auth()->user()->staff->company->Logo) }}" alt="{{ auth()->user()->staff->company->Company }}" width="200px">
    </div>

    <h3 style="text-align:center">Meeting Notes For Meeting With {{ $memo->customer->Customer }}</h3>
    <div style="text-align:center">Date: {{ \Carbon::parse($memo->MeetingDate)->format('d M, Y') }}</div>
    <br><hr><br>

    {{-- <h4><u>CUSTOMER</u></h4>
    <br> --}}
    <ul class="my-list">
      <li><b>Attendees:</b> {{ $memo->Attendees }}</li>
      <li><b>Handouts:</b> {{ $memo->Handouts }}</li>
      <li><b>Location:</b> {{ $memo->Location }}</li>
      <li><b>Meeting Date:</b> {{ $memo->MeetingDate }}</li>
    </ul>

    <table class="table-bordered table-responsive">
      <tbody>

        @php $disc_count = 0; @endphp
        @foreach ($memo->discussions as $discuss)

          @php $disc_count++; @endphp
          {{-- <tbody> --}}
          <tr class="disc_row">
            <td class="small"><b>Discussion Point {{ $disc_count }}</b></td>
            <td colspan="3" class="small">{!! $discuss->DiscussionPoint !!}</td>

          </tr>
          {{-- </tbody> --}}
          @if (count($discuss->actions) > 0)
            <tr class="action_row">
              <td></td>
              <th class="thead">Action Point</th>
              <th class="thead">Responsibility</th>
              <th class="thead">Timeline</th>
              {{-- <td class="thead">Status</td> --}}
            </tr>
          @endif
          @foreach ($discuss->actions as $action)
            {{-- <tbody> --}}

            <tr class="action_row">
              <td><span class="label label-{{ $action->status->Color }} pull-right">{{ $action->status->Status }}</span></td>
              <td class="small"><i class="fa fa-bullseye text-muted m-r-5 f16"></i> {{ $action->ActionPoint }}</td>
              <td class="small"><i class="fa fa-user text-muted m-r-5 f15"></i> {{ $action->user->FullName }}</td>
              <td class="small"><i class="fa fa-clock-o text-muted m-r-5 f16"></i> {{ $action->StartDate.' - '.$action->EndDate  }}</td>
              {{-- <td class="small"><span class="label label-info">status</span></td> --}}
            </tr>
          @endforeach

        @endforeach
      </tbody>
    </table>


    <div style="float:right; margin:20px 15px">
      <img src="{{ asset('images/officemate.png') }}" alt="Officemate" width="100px">
    </div>


  </body>
</html>
