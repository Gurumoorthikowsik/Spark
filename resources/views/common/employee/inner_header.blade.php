<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{($title) ? $title : 'Dashboard'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{site_setting()->site_fav}}">
    <!-- Pignose Calender -->

    <link rel="stylesheet" href="https://res.cloudinary.com/dyeyiicvo/image/upload/v1739206261/ocijkjzxwixrmh1fjvhw.png">
    <link href="{{ URL::to('/') }}/public/employee/plugins/pg-calendar/css/pignose.calendar.min.css" />
    <!-- Chartist -->
    <link href="{{ URL::to('/') }}/public/employee/plugins/chartist/css/chartist.min.css" />
    <link href="{{ URL::to('/') }}/public/employee/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css" />
    <!-- Custom Stylesheet -->


    <link href="{{ asset('public/employee/css/style.css') }}?{{ time() }}" rel="stylesheet" />

    <link href="{{ URL::to('/') }}/public/employee/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" />
    <link href="{{ URL::to('/') }}/public/assets/calander/css/calendar.css?"<?php echo time(); ?> />
    <link href="{{ URL::to('/') }}/public/employee/css/bootstrap-datetimepicker.min.css?{{ time() }}" rel="stylesheet" type="text/css" />

    
    <style type="text/css">
        .error {
              color :#d55757 !important;
        }

    </style>


  <!-- new datatable  -->
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"rel="stylesheet" type="text/css" />
 


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="preloader" class="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div> --}}
    <!--*******************
        Preloader end
    ********************-->
