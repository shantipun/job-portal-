<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="{{url('admin/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-basket-shopping"></i></div>
                                Manage Category
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Add Category -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.categories.create') }}">Add Category</a>
                                </li>
                                <!-- View Categories -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.categories.index') }}">View Categories</a>
                                </li>
                            </ul>
                        </li>

                          
                          
                              <a class="nav-link" href="{{url('admin/users')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Manage users 
                            </a>
                             <a class="nav-link" href="{{ url('admin/vendors') }}">

                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                            Manage Vendors
                            </a>
                                                
                            <a class="nav-link" href="{{ url('admin/jobs') }}">

                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            Manage Jobs
                            </a>
                        <a class="nav-link" href="{{ url('admin/blogs') }}">

                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            Manage Blogs
                            </a>
                            <a class="nav-link" href="{{ url('admin/companies') }}">

                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            Manage Company
                            </a>
                             <a class="nav-link" href="{{ url('admin/contact-messages') }}">

                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            User Messages
                            </a>
                          
                             
                             
                            
                           

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Shanti
                    </div>
                </nav>
            </div>