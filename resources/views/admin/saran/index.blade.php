@extends('admin.templates.template')
@section('title')
<h1>
    Saran & Masukan
    <small>{{--Control panel--}}</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</li>
    <li class="active"><i class="fa fa-feed"></i> Saran & Masukan</li>
</ol>
@endsection

@section('content')
<div>
    <div class="box">
        <div class="box-header">
            Saran & Masukan
        </div>
        <div class="box-body">
            <!-- Post -->
            @foreach ($saran as $item)                
            <div class="post">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="https://ui-avatars.com/api/?name={{ $item->siswa->nama }}" alt="user image">
                    <span class="username">
                        <a href="#">{{ $item->siswa->nama }}</a>
                    </span>
                    {{-- <span class="description">Kelas {{ $item->siswa->kelompok }}</span> --}}
                    <span class="description">{{ Carbon\Carbon::createFromTimeString($item->created_at)->isoFormat('D MMMM Y') }}</span>
                </div>
                <!-- /.user-block -->
                <h3>{{ $item->judul }}</h3>
                <p>
                    {{ $item->isi }}
                </p>
                {{-- <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                            (5)
                        </a>
                    </li>
                </ul>
                
                <input class="form-control input-sm" type="text" placeholder="Type a comment"> --}}
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection