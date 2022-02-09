@extends('admin.templates.template')
@section('title')
<h1>
    Dashboard Guru
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
</ol>
@endsection

@section('content')
<div>
    <div class="callout callout-info">
        <h4>Selamat Datang {{ Auth::user()->name }}</h4>
        
        <p></p>
    </div>
  </div>
@endsection