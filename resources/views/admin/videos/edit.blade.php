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

                    <form method="post" action="{{ route('admin.videos.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Անվանումը</label>
                            <input name="name" id="name" type="text" class="form-control" value="{{ $post->name }}" >
                        </div>


                        {{--Post image--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">Նկար</label>
                                    <input type="file" name="file" id="file" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    @if($post->file)
                                        <video width="320" height="240" controls>
                                            <source src="{{ getFile($post->file)}}" >

                                        </video>

                                    @else
                                        {{--no-image.jpg--}}
                                        <p>Չկա ֆայլ</p>
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->file))
                                <div class="col-md-2">
                                    <label for="delete_file">Ջնջել</label>
                                    <input type="checkbox" id="delete_file" name="delete_file">
                                </div>
                            @endif
                        </div><!--row-->




                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Թարմացնել</button>
                        </div>


                    </form>

                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
