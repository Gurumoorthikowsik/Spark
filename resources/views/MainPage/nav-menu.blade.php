<div class="topbar">
    <div class="container-fluid">
        <p class="topbar__text">Welcome to BraveSparkinfotech</p><!-- /.topbar__text -->
        <ul class="topbar__info">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:bravesparkinfotech@gmail.com">bravesparkinfo@.com</a>
            </li>
            <li>
                {{-- <i class="fa fa-map-marker"></i>
                60 Golden Broklyn Street, New York
            </li> --}}

        </ul><!-- /.topbar__info -->
        {{-- <ul class="topbar__social">
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul> --}}
        
        <!-- /.topbar__social -->
    </div><!-- /.container-fluid -->
</div><!-- /.topbar -->
<nav class="main-menu sticky-header">
    <div class="container-fluid">
        <div class="main-menu__logo me-4">
            <a href="{{ URL::to('/') }}">
                <img src="{{ URL::to('/') }}/public/asset/images/favicons/bravespark-logo.png"  width="180" width="98" alt="bravespark">
            </a>
        </div><!-- /.main-menu__logo -->

        <ul class="main-menu__list">
            <li class="menu-item-has-children">
                <a href="{{ URL::to('/') }}">Home</a>
            </li>

            <li class="menu-item-has-children">
                <a href="{{ URL::to('/about-us') }}">About</a>
            </li>


            <li class="menu-item-has-children">
                <a href="{{ URL::to('/') }}">Services</a>
                <ul>
                    <li><a href="{{ URL::to('/cybersecurity') }}">Cyber Security</a></li>
                    <li><a href="{{ URL::to('/web-development') }}">Web Development</a></li>
                    <li><a href="{{ URL::to('/software-development') }}">Software Development</a></li>
                    <li><a href="{{ URL::to('/mobile-app-development') }}">Mobile App Development</a></li>
                    <li><a href="{{ URL::to('/digital-marketing ') }}">Digital Marketing</a></li>
                </ul>
            </li>

            <li class="menu-item-has-children">
                <a href="{{ URL::to('/training-course') }}">Courses Training</a>
            </li>
     
            
            <li><a href="{{ URL::to('/contact') }}">Contact</a></li>
        </ul><!-- /.main-menu__list -->

        <div class="main-menu__right">
            <a href="#" class="mobile-nav__toggler">
                <span></span>
                <span></span>
                <span></span>
            </a>
                <a href="{{ URL::to('/students-login') }}" class="main-menu__cta mx-5">Login</a><!-- /.main-menu__cta -->
        </div><!-- /.main-menu__right -->

    </div><!-- /.container-fluid -->
</nav><!-- /.main-menu -->
