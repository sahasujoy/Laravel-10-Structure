@isset($pageConfigs)
{!! \App\Helpers\TemplateHelpers::updatePageConfig($pageConfigs) !!}
@endisset
    <!DOCTYPE html>
@php
    $configData = \App\Helpers\TemplateHelpers::applClasses();
@endphp

<html lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif"
      data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
      class="{{ ($configData['theme'] === 'light') ? '' : '' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon-16x16.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    {{-- Include core + vendor Styles --}}
    @include('panels/styles')

</head>
@routes

@extends('user.layouts.userHorizontalLayoutMaster')

{{--@isset($configData["mainLayoutType"])--}}
{{--    @extends((( $configData["mainLayoutType"] === 'horizontal') ? 'layouts.userHorizontalLayoutMaster' :--}}
{{--    'layouts.userVerticalLayoutMaster' ))--}}
{{--@endisset--}}
