@extends('admin.layouts.app')

@section('title')
    {{ __('Inquiry Logs') }}
@endsection

@section('styles')

<style>
    body{
    background:#eee;
    margin-top:20px;
}
.verti-timeline {
    border-left: 3px dashed #e9ecef;
    margin: 0 10px;
}
.verti-timeline .event-list {
    position: relative;
    padding: 40px 15px 40px;
    border-top: 3px solid #e9ecef;
}
.verti-timeline .event-list .event-date {
    position: absolute;
    right: 0;
    top: -2px;
    padding: 12px;
    color: #fff;
    border-radius: 0 0 7px 7px;
    text-align: center;
}
.verti-timeline .event-list .event-content {
    position: relative;
    border: 2px solid #e9ecef;
    border-radius: 7px;
    text-align: center;
}
.verti-timeline .event-list .event-content::before {
    content: "";
    position: absolute;
    height: 40px;
    width: 75%;
    top: -42px;
    left: 0;
    right: 0;
    margin: 0 auto;
    border-left: 12px double #e9ecef;
    border-right: 12px double #e9ecef;
}
.verti-timeline .event-list .timeline-icon {
    position: absolute;
    left: -14px;
    top: -10px;
}
.verti-timeline .event-list .timeline-icon i {
    display: inline-block;
    width: 23px;
    height: 23px;
    line-height: 23px;
    font-size: 20px;
    border-radius: 50%;
    text-align: center;
    color: #fff;
}
.verti-timeline .event-list:last-child {
    padding-bottom: 0;
}
@media (min-width: 769px) {
    .verti-timeline {
        margin: 0 60px;
    }
    .verti-timeline .event-list {
        padding: 40px 90px 60px 40px;
    }
}
@media (max-width: 576px) {
    .verti-timeline .event-list .event-date {
        right: -20px;
    }
}
.card {
    border: none;
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
    box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
}
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Actions</h5> 
                </div>
                <div class="card-body">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css" integrity="sha256-nwNjrH7J9zS/Ti4twtWX7OsC5QdQHCIKTv5cLMsGo68=" crossorigin="anonymous" />

<div class="container">
<div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <ul class="verti-timeline list-unstyled" dir="ltr">
                        @foreach($inquiry->logs as $log)
                        @php 
                            $color = 'bg-success';
                            $colors = ['bg-success','bg-primary','bg-info','bg-warning','bg-danger'];
                            $color = $colors[rand(0,4)];

                            $title = '';
                            $parts = explode(':',$log->log);
                            if (count($parts) > 1) {
                                $title = $parts[0];
                            } else {
                                $title = $log->log;
                            }
                        @endphp
                        <li class="event-list">
                            <div class="timeline-icon">
                                <i class="mdi mdi-adjust {{$color}}"></i>
                            </div>
                            <div class="event-content p-4">
                                <h5 class="mt-0 mb-3 font-18">{{$title}}</h5>
                                <div class="text-muted">
                                    <p class="mb-2">
                                        {!! $log->log !!}
                                    </p>
                                </div>
                            </div>
                            <div class="event-date bg-primary">
                                <h5 class="mt-0">
                                    {{date('d M',strtotime($log->created_at))}}
                                </h5>
                            </div>
                        </li>
                        @endforeach

                        
                    </ul>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end card -->
</div>
</div>
</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() { 

    });
</script>
@endsection