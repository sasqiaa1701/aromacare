@extends('layouts.user.app')

@section('content')
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login_form_inner">
                        <h3>Create Your Account</h3>
                        <form class="row mx-5 px-2 py-x" method="post" action="{{ route('register.pelanggan.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 form-group">
                                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Full Name"
                                    required value="{{ old('nama_pelanggan') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required
                                    value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="password" name="katakunci" class="form-control" placeholder="Password"
                                    required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="no_telp" class="form-control" placeholder="Phone Number"
                                    required value="{{ old('no_telp') }}" pattern="\d*" title="Phone number must be numeric!">
                            </div>

                            <!-- Alamat 1 -->
                            <div class="col-md-12 text-left">
                                <hr><strong>Main Address</strong>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="alamat1" class="form-control" placeholder="Main Address" required
                                    value="{{ old('alamat1') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="kota1" class="form-control" placeholder="City" required
                                    value="{{ old('kota1') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="provinsi1" class="form-control" placeholder="Region"
                                    required value="{{ old('provinsi1') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="kodepos1" class="form-control" placeholder="Postcode"
                                    required value="{{ old('kodepos1') }}" pattern="\d*" title="Postcode must be numeric!">
                            </div>

                            <!-- Alamat 2 -->
                            <div class="col-md-12 text-left">
                                <hr><strong>Second Address</strong>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="alamat2" class="form-control" placeholder="Address 2"
                                    value="{{ old('alamat2') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="kota2" class="form-control" placeholder="City 2"
                                    value="{{ old('kota2') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="provinsi2" class="form-control" placeholder="Region 2"
                                    value="{{ old('provinsi2') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="kodepos2" class="form-control" placeholder="Postcode 2"
                                    value="{{ old('kodepos2') }}" pattern="\d*" title="Postcode must be numeric!">
                            </div>

                            <!-- Alamat 3 -->
                            <div class="col-md-12 text-left">
                                <hr><strong>Third Address</strong>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="alamat3" class="form-control" placeholder="Address 3"
                                    value="{{ old('alamat3') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="kota3" class="form-control" placeholder="City 3"
                                    value="{{ old('kota3') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="provinsi3" class="form-control" placeholder="Region 3"
                                    value="{{ old('provinsi3') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="kodepos3" class="form-control" placeholder="Postcode 3"
                                    value="{{ old('kodepos3') }}" pattern="\d*" title="Postcode must be numeric!">
                            </div>

                            <!-- Upload File -->
                            <div class="col-md-12 text-left">
                                <hr><strong>Document</strong>
                            </div>
                            <div class="col-md-6 form-group text-left">
                                <label for="url_ktp">Identity Card/KTP Photo</label>
                                <input type="file" name="url_ktp" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group text-left">
                                <label for="foto">Profile Photo</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>

                            <div class="col-md-12 form-group mt-3">
                                <button type="submit" class="btn btn-primary button">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
