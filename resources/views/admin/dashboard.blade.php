@extends('admin.layouts.app')
@section('content')
<script>
   $(function () { // Use jQuery shorthand for document ready

      const athletes = {{ Js::from($Athletes) }};
      const coach = {{ Js::from($Coach) }};
      const user = {{ Js::from($User) }};
      const month = {{ Js::from($month) }};

      // Define options object outside of the function to reduce duplication
      var options = {
         series: [
            { name: "Athletes", data: athletes },
            { name: "Coach", data: coach },
            { name: "User", data: user },
         ],
         chart: {
            height: 350,
            type: "line",
            zoom: {
                  enabled: false,
            },
         },
         dataLabels: {
            enabled: false,
         },
         stroke: {
            curve: "straight",
         },
         title: {
            align: "left",
         },
         grid: {
            row: {
                  colors: ["#f3f3f3", "transparent"],
                  opacity: 0.5,
            },
         },
         xaxis: {
            categories: month
         },
      };

      var chart = new ApexCharts($("#chart")[0], options); // Use jQuery to select the element
      chart.render();
   });

   $(function () { // Use jQuery shorthand for document ready

      const videomonth = {{ Js::from($videomonth) }};
      const active = {{ Js::from($Active) }};
      const inActive = {{ Js::from($InActive) }};
      const pending = {{ Js::from($Pending) }};

      // Define options object outside of the function to reduce duplication
      var options = {
         series: [
            { name: "Active", data: active },
            { name: "Rejected", data: inActive },
            { name: "Pending", data: pending },
         ],
         chart: {
            height: 350,
            type: "line",
            zoom: {
                  enabled: false,
            },
         },
         dataLabels: {
            enabled: false,
         },
         stroke: {
            curve: "straight",
         },
         title: {
            align: "left",
         },
         grid: {
            row: {
                  colors: ["#f3f3f3", "transparent"],
                  opacity: 0.5,
            },
         },
         xaxis: {
            categories: videomonth
         },
      };

      var chart = new ApexCharts($("#chartVideo")[0], options); // Use jQuery to select the element
      chart.render();
   });
</script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h1>{{ Auth::user()->name}}</h1>
    <div class="row mb-3">
         <div class="col-lg-8">
               <div class="card">
                  <h4 class="card-title mb-1 text-nowrap pt-3 ps-3">Incomes</h4>  
                  <div class="d-flex row">
                     <div class="col-3">
                           <div class="card-body">                      
                              <h5 class="card-title text-primary mb-1">{{$subscriptionAmount}}</h5>
                              <p class="d-block mb-4 pb-1 text-muted">Total Subcription(Amount)</p>
                           </div>
                     </div>
                     <div class="col-3">
                           <div class="card-body">                      
                              <h5 class="card-title text-primary mb-1">{{$referralRevenue}}</h5>
                              <p class="d-block mb-4 pb-1 text-muted">Refralle Given</p>
                           </div>
                     </div>
                     <div class="col-3">
                        <div class="card-body">                      
                           <h5 class="card-title text-primary mb-1">{{$totalAthleteIncome}}</h5>
                           <p class="d-block mb-4 pb-1 text-muted">Vedio Revenue</p>
                        </div>
                  </div>
                     <div class="col-3">
                           <div class="card-body">                      
                              <h5 class="card-title text-primary mb-1">{{$adminIncome}}</h5>
                              <p class="d-block mb-4 pb-1 text-muted">Total Income</p>
                           </div>
                     </div>
                  </div>
               </div>
               <div class="card mt-2">
                  <h4 class="card-title mb-1 text-nowrap pt-3 ps-3">Users</h4>
                  <div id="chart"></div>
               </div>
               <div class="card mt-2">
                  <h4 class="card-title mb-1 text-nowrap pt-3 ps-3">Video</h4>
                  <div id="chartVideo"></div>
               </div>
         </div>
         <div class="col-lg-4">
            <div class="card">
               <h4 class="card-title mb-1 text-nowrap pt-3 ps-3">Users</h4>  
               <div class="d-flex row">
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-primary">
                              <i class='bx bx-user'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$totalUsersCount}}</h4>
                     </div>
                     <p class="mb-1">Total Users</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-success">
                              <i class='bx bx-user'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$userCount}}</h4>
                     </div>
                     <p class="mb-1">Users</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-danger">
                              <i class='bx bx-user'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$athletesCount}}</h4>
                     </div>
                     <p class="mb-1">Athelitics</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-info">
                              <i class='bx bx-user'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$coachesCount}}</h4>
                     </div>
                     <p class="mb-1">Coaches</p>
                  </div>
                 </div>                               
               </div>
            </div>

            <div class="card mt-2">
               <h4 class="card-title mb-1 text-nowrap pt-3 ps-3">Video</h4>  
               <div class="d-flex row">
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-primary">
                              <i class='bx bx-movie-play'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$totalVideoCount}}</h4>
                     </div>
                     <p class="mb-1">Total Video</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-success">
                              <i class='bx bx-play-circle' ></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$approvedCount}}</h4>
                     </div>
                     <p class="mb-1">Approved Video</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-danger">
                              <i class='bx bx-video-off'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$rejectedCount}}</h4>
                     </div>
                     <p class="mb-1">Rejected Video</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-info">
                              <i class='bx bx-video'></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$pendingCount}}</h4>
                     </div>
                     <p class="mb-1">Pending Video</p>
                  </div>
                 </div>                               
               </div>
            </div>

            <div class="card mt-2">  
               <div class="d-flex row">
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-primary">
                              <i class='bx bx-coin' ></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$paidCount}}</h4>
                     </div>
                     <p class="mb-1">Paid Video</p>
                  </div>
                 </div>                               
                 <div class="col-6">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                           <span class="avatar-initial rounded bg-label-success">
                              <i class='bx bx-play' ></i>
                           </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$freeCount}}</h4>
                     </div>
                     <p class="mb-1">Free Video</p>
                  </div>
                 </div>                               
               </div>
            </div>
         </div>
    </div>
</div>
@endsection
    