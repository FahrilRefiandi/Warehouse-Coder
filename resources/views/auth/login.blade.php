@extends('layouts.auth')
@section('title', 'Login')
@section('content')


<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5">

                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase mb-4">Login</h2>
                            {{-- <p class="text-white-50 mb-5">Silahkan masukkan biodata anda.!</p> --}}
                            @livewire('user-login')
                            @if ($errors->any())
                            {{-- @foreach ($errors->all() as $error)
                                <span class="text-danger text-center">{{ $error }}</span>
                            @endforeach --}}
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection
