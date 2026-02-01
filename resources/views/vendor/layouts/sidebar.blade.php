<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="{{url('vendor/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                             <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase"></i></div>
                                Manage Jobs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('vendor.jobs.post') }}">Post Job</a></li>
                                <li><a class="dropdown-item" href="{{ route('vendor.jobs.view') }}">View Jobs</a></li>

                             </ul>
                        </li>
                                                
                          <a class="nav-link" href="{{ url('vendor/applications') }}">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-envelope"></i></div>
                            Applications
                        </a>
                        
                            
                             <a class="nav-link" href="{{ url('vendor/profile') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                            Profile
                        </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Shanti
                    </div>
                </nav>
            </div>