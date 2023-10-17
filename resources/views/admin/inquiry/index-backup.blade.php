@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 inquiry-table">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Inquiries</h5>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('inquiries.create') }}"><small class="btn btn-primary btn-sm">Add New</small></a>
                        <div class="header_option_btn d-inline-flex align-items-center ms-3" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                            <span class="content_header_icon rounded bg-label-primary"><i class='bx bx-columns text-primary'></i></span> <span class="ms-2">Columns</span>
                        </div>
                        <div class="dropdown-menu dropdown popover_filters" aria-labelledby="dropdownMenuButton" >
                            <div class="dropdown_body columns_options">
                                <a class="toggle-vis active" data-column="1"> Date</a>
                                <a class="toggle-vis active" data-column="2">Lead Source</a>
                                <a class="toggle-vis active" data-column="3">Name</a>
                                <a class="toggle-vis active" data-column="4">Email</a>
                                <a class="toggle-vis active" data-column="5">Contact</a>
                                <a class="toggle-vis active" data-column="6">Company</a>
                                <a class="toggle-vis active" data-column="7">Requirements</a>
                                <a class="toggle-vis active" data-column="8">Budget</a>
                                <a class="toggle-vis " data-column="9">L1</a>
                                <a class="toggle-vis " data-column="10">Brief</a>
                                <a class="toggle-vis " data-column="11">Handled By</a>
                                <a class="toggle-vis " data-column="12">Status</a>
                                <a class="toggle-vis" data-column="13">First Contacted</a>
                                <a class="toggle-vis" data-column="14">Last Client Contacted</a>
                                <a class="toggle-vis" data-column="15">Last Contacted</a>
                                <a class="toggle-vis" data-column="16">Commercial</a>
                                <a class="toggle-vis active" data-column="17">Actions</a>
                            </div>  
                        </div>
                    </div>
                  </div>
                <div class="card-body">
                    <table class="table table-hover mb-0 mt-3" id="inquiryTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col">Date</th>
                                <th scope="col">Lead Source</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email </th>
                                <th scope="col">Contact</th>
                                <th scope="col">Company</th>
                                <th scope="col">Requirements</th>
                                <th scope="col">Budget</th>
                                <th scope="col">L1 </th>
                                <th scope="col">Brief</th>
                                <th scope="col">Handled By</th>
                                <th scope="col">Status</th>
                                <th scope="col">First Contacted</th>
                                <th scope="col">Last Client Contacted</th>
                                <th scope="col">Last Contacted</th>
                                <th scope="col">Commercial</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inquiries as $inquiry)
                                <tr class="">
                                    <td class="details-control">
                                        <button class="btn btn-primary btn-sm"><i class="bx bx-plus"></i></button>
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($inquiry->created_at)->format('d M Y') }}
                                    </td>
                                    <td>{{ $inquiry->lead_source }}</td>
                                    <td>{{ $inquiry->first_name }}</td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>{{ $inquiry->phone }}</td>
                                    <td>{{ $inquiry->company_name }}</td>
                                    <td>{{ $inquiry->requirements }}</td>
                                    <td>{{ $inquiry->budget }}</td>
                                    <td>
                                        @php
                                            $L1 = ['Done', 'Not Done'];
                                            $bg_color = $inquiry->L1 == 'Done' ? 'text-success' : 'text-danger';
                                        @endphp
                                        <select name="L1" id="L1" class="form-control L1 {{$bg_color}}">
                                            <option value="">Select L1</option>
                                            @foreach($L1 as $l1)
                                                @if($l1 == $inquiry->L1)
                                                    <option value="{{$l1}}" data-inquiryId="{{ $inquiry->id }}" selected>{{$l1}}</option>
                                                    @continue
                                                @endif
                                                <option value="{{$l1}}" data-inquiryId="{{ $inquiry->id }}">{{$l1}}</option>
                                            @endforeach
                                        </select>
                                        {{-- view L1 minutes in popover if li is done  --}}
                                        
                                        @if($inquiry->L1 == 'Done')
                                            <button class="btn btn-primary btn-sm view-action-btn view_details_btn" type="button"  data-details="{{$inquiry->L1_minutes}}">
                                                <i class="bx bx-show view_details_btn" data-details="{{$inquiry->L1_minutes}}"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $brief = ['Done', 'Not Done'];
                                            $bg_color = $inquiry->brief == 'Done' ? 'text-success' : 'text-danger';
                                        @endphp
                                        <select name="brief" id="brief" class="form-control brief {{ $bg_color }}">
                                            <option value="">Select brief</option>
                                            @foreach($brief as $b)
                                                @if($b == $inquiry->brief)
                                                    <option value="{{$b}}" data-inquiryId="{{ $inquiry->id }}" selected>{{$b}}</option>
                                                    @continue
                                                @endif
                                                <option value="{{$b}}" data-inquiryId="{{ $inquiry->id }}">{{$b}}</option>
                                            @endforeach
                                        </select>
                                        @if($inquiry->brief == 'Done')
                                            <button class="btn btn-primary btn-sm view-action-btn view_details_btn" type="button" data-details="{{$inquiry->brief_details}}">
                                                <i class="bx bx-show view_details_btn" data-details="{{$inquiry->brief_details}}"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <select name="handledBy" class="form-control handledBy">
                                            <option value="">Handled By</option>
                                            @foreach($users as $user)
                                                @if($user->id == $inquiry->handled_by)
                                                    <option value="{{$user->id}}" data-inquiryId="{{ $inquiry->id }}" selected>{{$user->name}}</option>
                                                    @continue
                                                @endif
                                                <option value="{{$user->id}}" data-inquiryId="{{ $inquiry->id }}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @php
                                            $leads = ['New Lead', 'Oppurtunity', 'Qualified Lead', 'AWOL', 'Converted'];
                                        @endphp
                                        <select name="lead_status" class="form-control lead_status">
                                            <option value="">Select Status</option>
                                            @foreach($leads as $lead)
                                                @if($lead == $inquiry->lead_status)
                                                    <option value="{{$lead}}" data-inquiryId="{{ $inquiry->id }}" selected>{{$lead}}</option>
                                                    @continue
                                                @endif
                                                <option value="{{$lead}}" data-inquiryId="{{ $inquiry->id }}">{{$lead}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control first_contacted" value="{{
                                            $inquiry->first_contacted ? Carbon\Carbon::parse($inquiry->first_contacted)->format('Y-m-d') : ''
                                            }}"
                                            data-inquiryId="{{ $inquiry->id }}"
                                            name="first_contacted"
                                            >
                                    </td>
                                    <td>
                                        <input type="date" class="form-control last_client_contacted" value="{{
                                            $inquiry->last_client_contacted ? Carbon\Carbon::parse($inquiry->last_client_contacted)->format('Y-m-d') : ''
                                            }}"
                                            data-inquiryId="{{ $inquiry->id }}"
                                            name="last_client_contacted"
                                            >
                                    </td>
                                    <td>
                                        <input type="date" class="form-control last_contacted" value="{{
                                            $inquiry->last_contacted ? Carbon\Carbon::parse($inquiry->last_contacted)->format('Y-m-d') : ''
                                            }}"
                                            data-inquiryId="{{ $inquiry->id }}"
                                            name="last_contacted"
                                            >
                                    </td>
                                    <td>
                                        <select name="commercial" id="commercial" class="form-control commercial">
                                            <option value="">Commercial</option>
                                            <option value="1" data-inquiryId="{{ $inquiry->id }}" {{ $inquiry->commercial == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" data-inquiryId="{{ $inquiry->id }}" {{ $inquiry->commercial == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                    </td>
                                    <td>
                                       <div class="d-flex gap-2 flex-wrap align-item-center">
                                            <a href="{{ route('inquiries.edit', $inquiry->id) }}" class="btn btn-primary btn-sm"><i class='bx bx-edit'></i></a>
                                                <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></button>
                                                </form>
                                                <a href="{{ route('inquiries.view-actions',$inquiry->id) }}">
                                                    <button class="btn btn-warning btn-sm"><i class='bx bx-accessibility'></i> : {{ count($inquiry->logs) }}</button>
                                                </a>
                                       </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- l1 minutes model --}}

    <div class="modal fade" id="L1Minutes" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">L1 Minutes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="l1_minutes_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                        <label for="nameSmall" class="form-label">L1 Minutes</label>
                        <textarea id="l1_minutes" name="l1_minutes" class="form-control" placeholder="Enter Name"></textarea>
                        </div>
                        <input type="hidden" id="inquiry_id_for_li_minutes" name="inquiry_id_for_li_minutes">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Minutes</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      {{-- brief details modal --}}

      <div class="modal fade" id="brief_details_modal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Brief Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="brief_details_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                        <label for="nameSmall" class="form-label">Brief Details</label>
                        <textarea id="brief_details" name="brief_details" class="form-control" placeholder="brief_details"></textarea>
                        </div>
                        <input type="hidden" id="inquiry_id_for_brief_details" name="inquiry_id_for_brief_details">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Details</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      {{-- l1 and brief detials modal --}}
      <div class="modal fade" id="details_modal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row details_area">
                    strtotime
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    $(document).ready(function() { 

        // init CK editors

        ClassicEditor
            .create( document.querySelector( '#l1_minutes' ) ,{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            })
            .catch( error => {
                console.error( error );
            } );

        ClassicEditor
            .create( document.querySelector( '#brief_details' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            } )
            .catch( error => {
                console.error( error );
            } );

        let table = $('#inquiryTable').DataTable({
            responsive: true,
        });

        // set default hide columns

        table.columns([ 9,10,11,12,13,14,15,16]).visible(false);

        // formating function 

        function format ( d ) {
            console.log(d);
            return `<table class="table table-bordered">
                        <tr>
                            <td>L1</td>
                            <td>${d[9]}</td>
                        </tr>
                        <tr>
                            <td>Brief</td>
                            <td>${d[10]}</td>
                        </tr>
                        <tr>
                            <td>Handled By</td>
                            <td>${d[11]}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>${d[12]}</td>
                        </tr>
                        <tr>
                            <td>First Contacted</td>
                            <td>${d[13]}</td>
                        </tr>
                        <tr>
                            <td>Last Client Contacted</td>
                            <td>${d[14]}</td>
                        </tr>
                        <tr>
                            <td>Last Contacted</td>
                            <td>${d[15]}</td>
                        </tr>
                        <tr>
                            <td>Commercial</td>
                            <td>${d[16]}</td>
                        </tr>
                    </table>`;
        }

        // Add event listener for opening and closing details

        $('#inquiryTable tbody').on('click', 'td.details-control', function (e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);
        
            if (row.child.isShown()) {
                row.child.hide();
            }
            else {
                row.child(format(row.data())).show();
            }
        } );

        // open popover on click of actions button

        $("#dropdownMenuButton").click(function() {
            $(".popover_filters").toggle();
        });

        // hide popover on click of outside

        $(document).mouseup(function(e) 
        {
            var container = $(".popover_filters");

            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                container.hide();
            }
        });

        // toggle columns

        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
            let column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );

            // add remove active class

            $(this).toggleClass('active');

        } );

        // view l1 and brief details modal

        $(document).on("click", ".view_details_btn", function() {
            let details = $(this).data('details');
            $(".details_area").html(details);
            $("#details_modal").modal('show');
        });

        
        $(document).on("change", ".handledBy", function() {
            let user_id = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $.post("{{ route('inquiries.update') }}", 
            {
                user_id: user_id, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Assigned Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        $(document).on("change", ".lead_status", function() {
            let lead_status = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $.post("{{ route('inquiries.update-status') }}", 
            {
                lead_status: lead_status, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Status Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change L1 status
        $(document).on("change", ".L1", function() {
            let L1 = $(this).val();
            if(L1 == 'Done') {
                $("#L1Minutes").modal('show');
            }
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $("#inquiry_id_for_li_minutes").val(inquiryId);
            $.post("{{ route('inquiries.update-l1') }}", 
            {
                L1: L1, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'L1 Status Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // save l1 minutes

        $("#l1_minutes_form").submit(function(e) {
            e.preventDefault();
            let l1_minutes = $("#l1_minutes").val();
            let inquiryId = $("#inquiry_id_for_li_minutes").val();
            $.post("{{ route('inquiries.save-l1-minutes') }}", 
            {
                l1_minutes: l1_minutes, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'L1 Minutes Saved Successfully!', 'success');
                    $("#L1Minutes").modal('hide');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change breaf status
        $(document).on("change", ".brief", function() {
            let brief = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $("#inquiry_id_for_brief_details").val(inquiryId);
            if(brief == 'Done') {
                $("#brief_details_modal").modal('show');
            }

            $.post("{{ route('inquiries.update-brief-status') }}", 
            {
                brief: brief, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Brief Status Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // save brief details

        $("#brief_details_form").submit(function(e) {
            e.preventDefault();
            let brief_details = $("#brief_details").val();
            let inquiryId = $("#inquiry_id_for_brief_details").val();
            $.post("{{ route('inquiries.save-brief-details') }}", 
            {
                brief_details: brief_details, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Brief Details Saved Successfully!', 'success');
                    $("#brief_details_modal").modal('hide');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change first contacted date

        $(document).on("change", ".first_contacted", function() {
            let first_contacted = $(this).val();
            let inquiryId = $(this).data('inquiryid');
            $.post("{{ route('inquiries.update-first-contacted') }}", 
            {
                first_contacted: first_contacted, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'First Contacted Date Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change last client contacted date
        $(document).on("change", ".last_client_contacted", function() {
            let last_client_contacted = $(this).val();
            let inquiryId = $(this).data('inquiryid');
            $.post("{{ route('inquiries.update-last-client-contacted') }}", 
            {
                last_client_contacted: last_client_contacted, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Last Client Contacted Date Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change last contacted date
        $(document).on("change", ".last_contacted", function() {
            let last_contacted = $(this).val();
            let inquiryId = $(this).data('inquiryid');
            $.post("{{ route('inquiries.update-last-contacted') }}", 
            {
                last_contacted: last_contacted, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Last Contacted Date Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });

        // change commercial status

        $(document).on("change", ".commercial", function() {
            let commercial = $(this).val();
            let inquiryId = $(this).find(':selected').data('inquiryid');
            $.post("{{ route('inquiries.update-commercial') }}", 
            {
                commercial: commercial, 
                inquiryId: inquiryId,
                "_token": "{{ csrf_token() }}",
            }, function(data) {
                if(data.success) {
                    toast('Success', 'Commercial Status Updated Successfully!', 'success');
                } else {
                    toast('Error', data.message, 'error');
                }
            });
        });
    });
</script>
@endsection