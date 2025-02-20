@php
$page = ($title) ? $title : '';
$user = DB::table('user_info')->select('userid','main_access')->where('userid',invuser_id())->first();
@endphp

<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{URL::to('inventory/dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{site_setting()->site_logo}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{site_setting()->site_logo}}" alt="" height="17"> --}}
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{URL::to('inventory/dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{site_setting()->site_logo}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{site_setting()->site_logo}}" alt="" height="50"> --}}
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                         <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Dashboard') ? 'active' : ''}}" href="{{URL::to('/inventory/dashboard')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Add Staff' || $title == 'View All Staff' || $title == 'Edit Staff') ? 'active' : ''}}" href="#sidebarStaff" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarStaff">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Inventory </span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarStaff">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{URL::to('inventory/')}}/laptop/all" class="nav-link" data-key="t-add_staff">Laptops </a>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <a href="{{URL::to('inventory/')}}/charger/all" class="nav-link" data-key="t-add_staff"> Charger</a>
                                    </li>

                                     <li class="nav-item">
                                        <a href="{{URL::to('inventory/')}}/mouse/all" class="nav-link" data-key="t-add_staff"> Mouse</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{URL::to('inventory/')}}/keyboard/all" class="nav-link" data-key="t-add_staff"> Keyboard</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li> -->

                      
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('inventory/')}}/staff_inventory">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Staff Inventory List</span>
                            </a>
                        </li>

                    


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#workingReport" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="workingReport">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff">Add Stock List </span>
                            </a>
                            <div class="collapse menu-dropdown" id="workingReport">
                                <ul class="nav nav-sm flex-column">  
                                <!-- <li class="nav-item">
                                    <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('add_product/')}}">
                                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Add Product List</span>
                                    </a>
                                </li>  -->
                                     <!-- <li class="nav-item">
                                        <a href="{{URL::to('add_product/')}}" class="nav-link" data-key="t-report">Add Product Old List</a>
                                    </li>                                  -->
                                    <li class="nav-item">
                                        <a href="{{URL::to('/add_brand')}}" class="nav-link" data-key="t-report">Add Brand</a>
                                    </li>                                    
                                   

                                    <!-- <li class="nav-item">
                                        <a href="{{URL::to('/add_accessories')}}" class="nav-link" data-key="t-staff_report">Add Accessories</a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a href="{{URL::to('/add_productlist')}}" class="nav-link" data-key="t-staff_report">Add Product List</a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{URL::to('inventory/view_productlist')}}" class="nav-link" data-key="t-staff_report">View Product List</a>
                                    </li>

                                    
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="{{URL::to('/staffstocklist')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards"> Staff Stock List</span>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('inventory/return_stock')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Return Stock List</span>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('inventory/return_stock_list')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Return Stock List</span>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('stock_count_available/')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Stock Count & Available List</span>
                            </a>
                        </li> -->
                     
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('add_os/')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Add OS</span>
                            </a>
                        </li> -->
                        

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Inventory List') ? 'active' : ''}}" href="{{URL::to('add_mobile/')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Add Mobile List</span>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#add" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="add">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff">Add Sim / Charger Type/Data Cable </span>
                            </a>
                            <div class="collapse menu-dropdown" id="add">
                                <ul class="nav nav-sm flex-column">                                  
                                    <li class="nav-item">
                                        <a href="{{URL::to('/add_sim')}}" class="nav-link" data-key="t-report">Add Sim</a>
                                    </li>                                    
                                   
                                    <li class="nav-item">
                                        <a href="{{URL::to('/add_charger')}}" class="nav-link" data-key="t-staff_report">Add Charger</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{URL::to('/add_accessories')}}" class="nav-link" data-key="t-staff_report">Add Data Cable</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
              -->
             
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
       
        <!-- Left Sidebar End -->