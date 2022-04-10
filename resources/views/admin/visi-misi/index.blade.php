@extends('admin.templates.template')
@section('style')
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

@section('title')
<h1>
    Visi Misi
    <small></small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Visi Misi</li>
</ol>
@endsection
@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">VISI</a></li>
        <li><a href="#tab_2" data-toggle="tab">MISI</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            @if(auth()->user()->level_id ==1 || auth()->user()->level_id ==2)
            <form action="{{ route('visi.store') }}" method="post">
                @csrf
                @method('put')
                <button class="btn btn-primary margin">SIMPAN</button>
                <textarea class="textarea" name="visi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $pengaturan->visi !!}</textarea>
            </form>
            @else
            {!! $pengaturan->visi !!}
            @endif
        </div>

        <div class="tab-pane" id="tab_2">
            @if(auth()->user()->level_id ==1 || auth()->user()->level_id ==2)
            <form action="{{ route('misi.store') }}" method="post">
                @csrf
                @method('put')
                <button class="btn btn-primary margin">SIMPAN</button>
                <textarea class="textarea" name="misi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $pengaturan->misi !!}</textarea>
            </form>
            @else
            {!! $pengaturan->misi !!}
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5()
  })
</script>
@endsection