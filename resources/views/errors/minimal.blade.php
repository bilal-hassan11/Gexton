@extends('layouts.admin_errors')
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="error-text-box">
            <svg viewBox="0 0 600 200">
                <!-- Symbol-->
                <symbol id="s-text">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em">@yield('code')!</text>
                </symbol>
                <!-- Duplicate symbols-->
                <use class="text" xlink:href="#s-text"></use>
                <use class="text" xlink:href="#s-text"></use>
                <use class="text" xlink:href="#s-text"></use>
                <use class="text" xlink:href="#s-text"></use>
                <use class="text" xlink:href="#s-text"></use>
            </svg>
        </div>
        <div class="text-center">
            <h3 class="mt-0 mb-2">@yield('message')</h3>
            <p class="text-muted mb-3">@yield('message_details')</p>
            <a href="{{route('home')}}" class="btn btn-success waves-effect waves-light">Back to Dashboard</a>
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
@endsection