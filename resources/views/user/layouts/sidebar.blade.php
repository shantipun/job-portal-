<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="{{url('user/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                             
                                                
                          <a class="nav-link" href="{{ url('user/job-history') }}">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-envelope"></i></div>
                            Job Applications
                        </a>
                         <a class="nav-link" href="{{ url('user/saved-jobs') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                            Saved Job
                        </a>
                            
                             <a class="nav-link" href="{{ url('user/edit-profile') }}">
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