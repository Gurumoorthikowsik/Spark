<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo e($title); ?></title>
    <link rel="shortcut icon" href="<?php echo e(site_setting()->site_fav); ?>">
    <!-- <link href="<?php echo e(asset('employee/plugins/fullcalendar/css/fullcalendar.min.css')); ?>" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link href="<?php echo e(URL::to('/')); ?>/public/employee/css/style.css?<?php echo e(time()); ?>" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .error {
              color :#d55757 !important;
        }

    </style>
</head>

<body class="h-100" style="background-image: url('<?php  echo URL::to('/public/employee/images/biovus_employee_login.jpg') ?>')">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader" class="page_loader preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************--><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/common/employee/header.blade.php ENDPATH**/ ?>