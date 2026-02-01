@extends('layouts.main')

@push('title')
<title>Contact Us | JobNest</title>
@endpush

@push('styles')
<style>
.contact-card {
    transition: all 0.3s ease;
}
.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}
.fade-up {
    animation: fadeUp 0.8s ease;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-5">
    <div class="container text-center fade-up">
        <h1 class="fw-bold">Contact JobNest</h1>
        <p class="fs-5">We’d love to hear from you</p>
    </div>
</section>

{{-- Contact --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">

            {{-- Form --}}
            <div class="col-md-6 fade-up">
                <div class="card contact-card border-0">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3">Send a Message</h4>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.send') }}">
                            @csrf

                            <input class="form-control mb-3" name="name" placeholder="Your Name" required>
                            <input class="form-control mb-3" name="email" placeholder="Your Email" required>
                            <input class="form-control mb-3" name="subject" placeholder="Subject (optional)">
                            <textarea class="form-control mb-3" name="message" rows="5" placeholder="Your Message" required></textarea>

                            <button class="btn btn-primary w-100">
                                <i class="fa fa-paper-plane me-2"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Info + Map --}}
            <div class="col-md-6 fade-up">
                <div class="card contact-card border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3">Contact Info</h4>

                        <p><i class="fa fa-envelope text-primary me-2"></i>shantipunmagar26@gmail.com</p>
                        <p><i class="fa fa-phone text-primary me-2"></i> +977-98XXXXXXXX</p>
                        <p><i class="fa fa-location-dot text-primary me-2"></i> Dang, Nepal</p>
                    </div>
                </div>

             
                </div>
            </div>
              {{-- Google Map --}}
                <div class="card contact-card border-0">
                    <div class="card-body p-0">
                        <iframe
                            src="https://www.google.com/maps?q=Ghorahi,Dang,Nepal&output=embed"
                            width="100%"
                            height="250"
                            style="border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

        </div>
    </div>
</section>

@endsection
