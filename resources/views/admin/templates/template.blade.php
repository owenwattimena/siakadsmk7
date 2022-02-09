@include('admin.templates.head')
@include('admin.templates.header')
@include('admin.templates.aside')
<div class="content-wrapper">
    <section class="content-header">
        @yield('title')
        @yield('breadcrumb')
        {{-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol> --}}
    </section>
    <section class="content container-fluid">
        @if (session('status'))
        <div class="alert alert-{!! session('status') !!} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @php
                $success = session('status') == 'danger' ? false : true;
            @endphp
            <h4><i class="icon fa {{  !$success ? 'fa-ban' : 'fa-check'  }}"></i> {{ $success ? 'Berhasil' : 'Gagal' }} </h4>
            {!! session('message') !!}
        </div>
        @endif
        @yield('content')
    </section>
</div>
@include('admin.templates.footer')
@include('admin.templates.right-side')
@include('admin.templates.script')
