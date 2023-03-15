@extends('layouts/contentLayoutMaster')

@section('title', 'Breadcrumbs')

@section('content')
<!-- Default Breadcrumb Starts -->
<section id="default-breadcrumb">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Default</h4>
        </div>
        <div class="card-body">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Default Breadcrumb Ends -->

<!-- Breadcrumb Styles Starts -->
<section id="component-breadcrumbs">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Styles</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            These breadcrumbs are only for demo purposes. You can change breadcrumb separator by changing
            <code>$breadcrumb-divider</code> variable value in scss.
          </p>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-slash">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dots">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dashes">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-pipes">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-chevron">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Styles Ends -->

<!-- Breadcrumb Alignment Starts -->
<section id="breadcrumb-alignment">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Alignment</h4>
        </div>
        <div class="card-body">
          <p class="card-text">Use class <code>.justify-content-{direction}</code> to align breadcrumb to center</p>
          <div class="d-flex justify-content-start breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb ml-1">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
              </ol>
            </nav>
          </div>
          <div class="d-flex justify-content-center breadcrumb-wrapper my-1">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
              </ol>
            </nav>
          </div>
          <div class="d-flex justify-content-end breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mr-1">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Alignment Ends -->
@endsection
