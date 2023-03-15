<link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}" />
{{-- Vendor Styles --}}
@yield('vendor-style')
{{-- Theme Styles --}}

<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{asset('/fonts/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />

{{-- {!! Helper::applClasses() !!} --}}
@php $configData = \App\Helpers\TemplateHelpers::applClasses(); @endphp

{{-- Page Styles --}}
@if($configData['mainLayoutType'] === 'horizontal')
<link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/horizontal-menu.css')) }}" />
@endif
<link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/vertical-menu.css')) }}" />

{{-- vendor css files --}}

{{--  Data table  --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">

{{--  Date Picker  --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

{{-- Sweet alerts --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">

{{--  Toastr --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

{{-- Page Styles --}}
@yield('page-style')

<link rel="stylesheet" href="{{ asset(mix('css/base/pages/ui-feather.css')) }}">


<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
{{--  Date Picker  --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">

{{-- Sweet alerts --}}
<link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
{{-- validation --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">


<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

{{-- Laravel Style --}}
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}" />

{{-- Custom RTL Styles --}}

@if($configData['direction'] === 'rtl' && isset($configData['direction']))
<link rel="stylesheet" href="{{ asset(mix('css/custom-rtl.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/style-rtl.css')) }}" />
@endif

{{-- user custom styles --}}
<link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />

<style>
    .horizontal-layout.navbar-floating:not(.blank-page) .app-content {
        padding: 10rem 6rem !important;
    }

    .nav-tabs.nav-justified {
        width: 100%;
    }

    .nav-tabs {
        position: relative !important;
        margin: -1px 0 -12px -12px !important;
    }



   .selected-nav-menu .select2{
        width: 270px!important;
        margin: 0 10px;
    }

    .table td {
        padding: 0.72rem 1rem;
        vertical-align: middle;
    }
    .subscribe-text{
        font-size: 12px!important;
        padding: 3px 5px!important;
    }
   .not-subscribe-text{
       font-size: 12px!important;
       padding: 3px 5px !important;
   }

  @media(max-width:1201px){
      .logo-nav-inner{
          display: flex;
          justify-content: center;
          align-items: center;
          /*padding:  0 10px!important;*/

      }
  }
</style>
