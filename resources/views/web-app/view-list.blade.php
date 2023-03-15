@extends('user.layouts/userContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">

@endsection

@section('content')

    <section class="app-user-list">
        <div class="card">
            <div class="col-md-12">

            </div>
        </div>
    </section>

@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')

    <script src="{{ asset(mix('js/scripts/pages/web-app/wep-app-list.js')) }}"></script>

@endsection
