<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('title')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset ('assets/css/style.css')}}">
</head>
  <body>
    
<!-- ================= HEADER ================= -->
<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary fs-3" href="{{url('/')}}">
            jobnest
        </a>

        <!-- Menu -->
        <ul class="navbar-nav me-auto ms-4 gap-3">
            <li class="nav-item"><a class="nav-link active" href="{{url('/')}}">Home</a></li>
                
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('company.search') ? 'active' : '' }}" 
                href="{{ route('company.search') }}">
                Company reviews
                </a>

            </li>

            <li class="nav-item"><a class="nav-link"  href="{{ route('find.salaries') }}">Find salaries</a></li>
             <li class="nav-item"><a class="nav-link"  href="{{ route('about') }}">About Us</a></li>
              <li class="nav-item"><a class="nav-link"  href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
        

        <!-- Right -->
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
                Sign in
            </a>

            <span class="text-muted">|</span>
           <a href="{{ route('login') }}" class="text-decoration-none">
    Employers / Post Job
</a>

        </div>
    </div>
</nav>
<!-- ================= /HEADER ================= -->
