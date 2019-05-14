@extends('layouts.app')

@section('styling')
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/lib/fullcalendar.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/lib/fullcalendar.print.min.css') }}" media='print' />
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/scheduler.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/jvmaps/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style type="text/css">
    #datatable-sched.table td, #datatable-sched td {
      padding-bottom: 0;
    }
    #datatable-sched.table td:last-child {
      padding-top: 0;
    }
    #tab1 .row:first-child .col-md-12:first-child, #tab2 .row:first-child .col-md-12:first-child {
      padding: 0;
    }
    .card .card-form-wizard .tab-content {
      padding-top: 10px;
    }
    #datatable-sched_wrapper .row:nth-child(3) {
      display: none;
    }
    .dropdown-menu {
      width: 200px;
    }
    #sidebar .dropdown-toggle::after {
      float: right; 
      top: -30px;
      position: relative;
    }
    .input-group-append .dropdown-toggle::after {
      float: right;
      top: -12px;
      right: -12px;
      position: relative;
    }
    .input-group-append .dropdown-toggle i {
      position: relative;
      left: -6px;
      top: 2px;
    }
    #sidebar .nav-item.dropdown {
      height: 70px;
    }
    #sidebar hr {
      border-top: 1px solid rgba(245, 245, 245, 0.3);
      width: 90%;
    }
    .input-group-prepend .dropdown-menu .dropdown-item.legend-block-item, .input-group-append .dropdown-menu .dropdown-item.legend-block-item {
      float: left;
      width: auto;
      clear: none;
      padding: 8px 13px;
    }
    .legend-block-color .legend-block-color-box {
      border: 2px solid #FFFFFF;
      height: 40px;
      width: 40px;
      margin: 5px 0;
      padding: 10px;
      -webkit-border-radius: 0.4167rem;
      -moz-border-radius: 0.4167rem;
      -ms-border-radius: 0.4167rem;
      -o-border-radius: 0.4167rem;
      border-radius: 0.4167rem;
    }
    .legend-block-color .legend-block-color-box i {
      color: #FFFFFF;
    }
  </style>
  {{-- <link rel="stylesheet" href="{{ asset('assets/multi-select.css') }}">
   --}}
  <style>
    .fc-title { color: #fff; }
  </style>
@endsection

@section('content')
  <div class="right-column">
      <main class="main-content p-5" role="main">
          <div class="row">
              <div class="col-md-6">
                  <h1>Class Calendar</h1>
              </div>
              <div class="col-md-6">
                  <button class="btn btn-primary pull-right" type="button" data-toggle="modal"
                      data-target="#exampleModal">Add New Schedule<i
                          class="ml-2 batch-icon batch-icon-plus"></i></button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                      aria-labelledby="addhistoryModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="addhistoryModalLongTitle">ADD NEW SCHEDULE</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <class-schedule-form></class-schedule-form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
  </div>
  <div class="row mb-5">
      <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                  <div class="calendar-container">
                      <div class="row">
                          <div class="col-lg-12">
                              {!! $calendarDetails->calendar() !!}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row mb-5">
      <div class="col-md-12">
          <footer>
              <!-- Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a> -->
          </footer>
      </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}" defer></script>
  <script src="{{ asset('assets/js/misc/holder.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/misc/moment.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/fullcalendar/lib/fullcalendar.min.js') }}" defer></script>
  {{-- <script src="{{ asset('assets/plugins/fullcalendar/scheduler.min.js') }}" defer></script> --}}
  <script src="{{ asset('assets/js/jquery/jquery-ui-1.11.0.custom/jquery-ui.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/form-validator/jquery.form-validator.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/scripts.js') }}" defer></script>
  <script src="{{ asset('assets/jquery.quicksearch.js') }}" defer></script>
  <script src="{{ asset('assets/jquery.multi-select.js') }}" defer></script>
  <script>
    $(document).ready(function () {
        // Important
        $('#callbacks').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Selectable Student'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Selected Student'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') +
                    ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') +
                    ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
        // End Important


        function qp_form_wizard() {
            var thisForm = '#rootwizard-1';


            if ($(thisForm).length) {
                // Prevent page from jumping when +
                $('.pager li a, .pager li span').on('click', function (e) {
                    e.preventDefault();
                });

                $(thisForm).bootstrapWizard({
                    onNext: function (tab, navigation, index) {

                        $('#wizard-back-btn').css({
                            "display": "block"
                        });
                        $('#btn-sched-save').css({
                            "display": "block"
                        });

                        if (index <= 1) {
                            $(thisForm + ' .tab-pane').eq(index).addClass('active');
                            $(thisForm + ' .tab-pane').eq(index - 1).removeClass('active');
                        }

                    },
                    onPrevious: function (tab, navigation, index) {
                        // Note: index is the previous frame not the current one
                        if (index !== -1) {
                            $(thisForm + ' .tab-pane').eq(index).addClass('active');
                            $(thisForm + ' .tab-pane').eq(index + 1).removeClass('active');
                        }
                        $('#wizard-back-btn').css({
                            "display": "none"
                        });
                        $('#btn-sched-save').css({
                            "display": "none"
                        });
                    },
                    onTabShow: function (tab, navigation, index) {
                        // Update Progress Bar
                        var total = navigation.find('li').length;
                        var current = index + 1;
                        var completionPercentage = (current / total) * 100;

                        var progressBar = $(thisForm).closest('.card').find(
                            ".card-header .progress-bar");

                        progressBar.css({
                            "width": completionPercentage + "%"
                        }).attr("aria-valuenow", completionPercentage);
                    },
                    onTabClick: function (tab, navigation, index) {
                        return false;
                    }
                });
            }
        }

        qp_form_wizard();
        $('#progress-div').css({
            "width": "50%"
        });
        $('#wizard-back-btn').css({
            "display": "none"
        });
        $('#btn-sched-save').css({
            "display": "none"
        });

    });
  </script>
  {!! $calendarDetails->script() !!}
@endsection