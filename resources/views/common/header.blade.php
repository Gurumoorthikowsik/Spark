
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
        
        <meta charset="utf-8" />
        <title>{{($title) ? $title : 'Dashboard'}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{site_setting()->site_fav}}">

        <!-- Layout config Js -->
       <link href="{{ URL::to('/') }}/public/assets/js/layout.js" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{ URL::to('/') }}/public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ URL::to('/') }}/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('/') }}/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ URL::to('/') }}/public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ URL::to('/') }}/public/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('/') }}/public/assets/css/style.css" rel="stylesheet" type="text/css" />



    </head>
    <body>
        
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
            <div class="bg-overlay"></div>
            
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>


        