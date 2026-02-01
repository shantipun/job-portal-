@extends('vendor.layouts.main')
@push('title')
<title>Profile</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container p-4">
            <form action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="card p-4">
                    <div class="row">
                        <div class="col-xl-8 col-md-8">
                            <h4>Basic Information</h4>
                            <div class="row mt-3">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Identification Number</label>
                                    <input type="text" class="form-control" name="id_number" 
                                        value="{{ old('id_number', $vendor->id_number) }}">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" class="form-control" name="business_name"
                                        value="{{ old('business_name', $vendor->business_name) }}">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="fullname"
                                        value="{{ old('fullname', $vendor->fullname) }}">
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $vendor->email) }}">
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone"
                                        value="{{ old('phone', $vendor->phone) }}">
                                </div>
                            </div>
                        </div>

                        {{-- Profile Image --}}
                        <div class="col-xl-4 col-md-4 mt-5 text-center">
                            <img src="{{ asset($vendor->image ?? 'dashboard/assets/img/user.png') }}" style="width:155px;">
                            <div class="mt-3">
                                <label for="image" class="form-label btn btn-dark">Choose Image</label>
                                <input type="file" class="form-control d-none" id="image" name="image">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Business Info --}}
                <div class="card p-4 mt-4">
                    <h4>Business Information</h4>
                    <div class="row mt-3">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Business Type</label>
                            <select class="form-select" name="business_type">
                                <option selected>Select Business type</option>
                                <option value="Sole Proprietor" {{ $vendor->business_type=='Sole Proprietor'?'selected':'' }}>Sole Proprietor</option>
                                <option value="Partnership" {{ $vendor->business_type=='Partnership'?'selected':'' }}>Partnership</option>
                                <option value="Corporation" {{ $vendor->business_type=='Corporation'?'selected':'' }}>Corporation</option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">GST No.</label>
                            <input type="text" class="form-control" name="gst_number"
                                value="{{ old('gst_number', $vendor->gst_number) }}">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Business Category</label>
                            <input type="text" class="form-control" name="business_category"
                                value="{{ old('business_category', $vendor->business_category) }}">
                        </div>
                    </div>
                </div>

                {{-- Payment Info --}}
                <div class="card p-4 mt-4">
                    <h4>Payment Information</h4>
                    <div class="row mt-3">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Bank Account Number</label>
                            <input type="text" class="form-control" name="bank_account_no"
                                value="{{ old('bank_account_no', $vendor->bank_account_no) }}">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Prefer Payment Method</label>
                            <select class="form-select" name="payment_method">
                                <option selected>Select Payment Method</option>
                                <option value="PayPal" {{ $vendor->payment_method=='PayPal'?'selected':'' }}>PayPal</option>
                                <option value="Bank Transfer" {{ $vendor->payment_method=='Bank Transfer'?'selected':'' }}>Bank Transfer</option>
                                <option value="E wallet" {{ $vendor->payment_method=='E wallet'?'selected':'' }}>E wallet</option>
                            </select>
                        </div>

                        <div class="col-lg-3 mt-2">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </main>

@endsection
