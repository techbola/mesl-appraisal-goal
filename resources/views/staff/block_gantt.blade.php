{{-- Start Gantt --}}
<div class="card-box">
  <div id="gantt_chart"></div>
</div>
{{-- End Gantt --}}


@push('scripts')
  <!-- common functions -->
  <script src="{{ asset('assets/plugins/altair/common.min.js') }}" charset="utf-8"></script>
  <!-- uikit functions -->
  {{-- <script src="http://altair_html.tzdthemes.com/assets/js/uikit_custom.min.js"></script> --}}
  <!-- altair common functions/helpers -->
  <script src="{{ asset('assets/plugins/altair/admin_common.min.js') }}" charset="utf-8"></script>


  <link rel="stylesheet" href="{{ asset('assets/plugins/gantt/gantt.min.css') }}">
  {{-- <script src="http://altair_html.tzdthemes.com/bower_components/jquery-ui/jquery-ui.min.js" charset="utf-8"></script> --}}
  <script src="{{ asset('assets/plugins/gantt/gantt_chart.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/plugins/gantt/plugins_gantt_chart.min.js') }}" charset="utf-8"></script>

  {{-- Start Gantt --}}
  <script>
    var ganttData = {!! $gantt !!};

    $(function() {
        altair_gantt.init()
    }), altair_gantt = {
        init: function() {
            var t = $("#gantt_chart");
            t.length && (t.ganttView({
                data: ganttData,
                startDate: "{{ Carbon::parse($staff->projects->max('StartDate'))->format('m/d/Y') }}",
                endDate: "{{ Carbon::parse($staff->projects->max('EndDate'))->format('m/d/Y') }}",
                behavior: {
                    onClick: function(t) {
                    },
                    onResize: function(t) {
                    },
                    onDrag: function(t) {
                    }
                }
            }), t.find("[title]").each(function() {
                $(this).attr("data-uk-tooltip", "{offset:4}")
            }))
        }
    };
  </script>
  {{-- End Gantt --}}
@endpush
