
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

    <style>
        button#login_btn {
    background-color: green;
}

.auth-page-content {
    background-image: url('https://images.hdqwalls.com/download/beautiful-landscape-digital-art-4k-tj-1920x1080.jpg');

    height: 674px;
}

    </style>


    <body>
        
    <div class="auth-page-wrapper">
        <!-- auth page bg -->
            
       



        