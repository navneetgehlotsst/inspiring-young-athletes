@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-2" style="display: block">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-primary-gs">< Dashboard </a>
                </div>
                <h4 class="page-title">Notifications</h4>
                
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card text-center">
                <div class="card-body">
                    <div class="text-left mt-3">
                        @if(!$notification->isEmpty()) 
                        @foreach($notification as $notice)
                        <div class="external-event bg-light text-dark d-flex justify-content-between" data-class="bg-success">
                            <p class="notify-details mb-0 font-weight-bold"><i class="dripicons-bell noti-icon mr-2 vertical-middle"></i> {{$notice->message}}</p>
                            <small class="text-muted font-weight-bold">{{date('d M, Y',strtotime($notice->date))}} {{$notice->time}}</small>
                        </div>
                        @endforeach 
                        @php 
                            echo '<div class="float-left cust_pagination">';
                            $total = $notification->total();
                            $currentPage = $notification->currentPage();
                            $perPage = $notification->perPage();
                            
                            $from = ($currentPage - 1) * $perPage + 1;
                            $to = min($currentPage * $perPage, $total);
                            
                            echo "Showing {$from} to {$to} of {$total} entries";
                            echo '</div>';
                        @endphp
                        {{ $notification->render("admin.layouts.elements.cust_pagination") }} 
                        @else
                        <p class="text-muted mb-1 font-13"><strong>No notification yet.</strong></p>
                        @endif
                    </div>
                    
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>    
    </div>
</div>
@endsection
