@extends('layouts.admin')

@section('styles')

@endsection

@section('sidebar')
    @include('admin.includes.sidebar')
@endsection

@section('content')

    @include('admin.includes.info-box')

    <main>

        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                {{ $title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- Main page content-->
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('admin.home.ourMissionsMenus.update', ['ourMissionsMenu'=>$post]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        {{ csrf_field() }}
                        @method('PATCH')


                        {{--Post image--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img">Նկար (SVG) ֆորմատով</label>
                                    <input type="file" name="img" id="img" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: #993944; height: 200px; width: 200px" class="form-group">
                                    @if($post->img)
                                        <img src="{{ showImage($post->img) }}" alt="" />
                                    @else
                                        {{--no-image.jpg--}}
                                        <img style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->img))
                                <div class="col-md-2">
                                    <label for="delete_img">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_img" name="delete_img">
                                </div>
                            @endif
                        </div><!--row-->

                        <div class="form-group">
                            <label for="title">Անվանումը</label>
                            <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="path">Հղղում</label>
                            <input type="url" name="path" id="path" value="{{ $post->path }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <button class="item-name btn btn-primary">Ընտրել</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
