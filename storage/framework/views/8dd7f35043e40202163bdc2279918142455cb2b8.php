<div class="topbar">
    <div class="container-fluid">
        <p class="topbar__text">Welcome to BraveSparkinfotech</p><!-- /.topbar__text -->
        <ul class="topbar__info">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:bravesparkinfotech@gmail.com">bravesparkinfo@.com</a>
            </li>
            <li>
                

        </ul><!-- /.topbar__info -->
        
        
        <!-- /.topbar__social -->
    </div><!-- /.container-fluid -->
</div><!-- /.topbar -->
<nav class="main-menu sticky-header">
    <div class="container-fluid">
        <div class="main-menu__logo me-4">
            <a href="index.html">
                <img src="<?php echo e(URL::to('/')); ?>/public/asset/images/favicons/bravespark-logo.png"  width="180" width="98" alt="bravespark">
            </a>
        </div><!-- /.main-menu__logo -->

        <ul class="main-menu__list">
            <li class="menu-item-has-children">
                <a href="<?php echo e(URL::to('/')); ?>">Home</a>
            </li>

            <li class="menu-item-has-children">
                <a href="<?php echo e(URL::to('/about-us')); ?>">About</a>
            </li>


            <li class="menu-item-has-children">
                <a href="<?php echo e(URL::to('/')); ?>">Services</a>
                <ul>
                    <li><a href="<?php echo e(URL::to('/cybersecurity')); ?>">Cyber Security</a></li>
                    <li><a href="<?php echo e(URL::to('/web-development')); ?>">Web Development</a></li>
                    <li><a href="<?php echo e(URL::to('/software-development')); ?>">Software Development</a></li>
                    <li><a href="<?php echo e(URL::to('/mobile-app-development')); ?>">Mobile App Development</a></li>
                    <li><a href="<?php echo e(URL::to('/digital-marketing ')); ?>">Digital Marketing</a></li>
                </ul>
            </li>

            <li class="menu-item-has-children">
                <a href="<?php echo e(URL::to('/training-course')); ?>">Courses Training</a>
            </li>
     
            
            <li><a href="<?php echo e(URL::to('/contact')); ?>">Contact</a></li>
        </ul><!-- /.main-menu__list -->

        <div class="main-menu__right">
            <a href="#" class="mobile-nav__toggler">
                <span></span>
                <span></span>
                <span></span>
            </a>
                <a href="<?php echo e(URL::to('/students-login')); ?>" class="main-menu__cta mx-5">Login</a><!-- /.main-menu__cta -->
        </div><!-- /.main-menu__right -->

    </div><!-- /.container-fluid -->
</nav><!-- /.main-menu -->
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/MainPage/nav-menu.blade.php ENDPATH**/ ?>