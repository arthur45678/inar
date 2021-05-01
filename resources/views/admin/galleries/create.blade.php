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
                    <form method="post" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{--Common data--}}
                        {{-- <div class="form-group">
                            <label for="img">Նկար</label>
                            <input name="img" id="img" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div> --}}

                        {{-- <div class="form-group">
                            <label for="page_img">Փոքր նկար</label>
                            <input name="page_img" id="page_img" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div> --}}

                        {{--Add dynamic images fields--}}
                        <div class="form-group after-add-more">
                            <div class="input-group-btn">
                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Ավելացնել նկար</button>
                            </div>
                        </div>

                        <!-- Copy Fields -->
                        <div class="form-group">
                            <div class="copy d-none">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input name="images_create[]" id="images" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>{{--Add dynamic images fields--}}
                        </div>


                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item" role="{{$localeCode}}">
                                    <a class="nav-link {{ (App::getLocale() ==  $localeCode) ? 'active' : ''}}" id="pills-home-tab" data-toggle="pill" href="#tab_{{$localeCode}}" aria-controls="{{$localeCode}}" aria-selected="true">{{ $properties['native'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="tab-pane fade show {{ (App::getLocale() ==  $localeCode) ? 'active' : ''}}" id="tab_{{$localeCode}}" role="{{$localeCode}}" aria-labelledby="pills-home-tab">
                                    <div class="form-group">
                                        <label for="{{$localeCode}}[name]">Վերնագիր</label>
                                        <input type="text" name="name[{{$localeCode}}]" id="{{$localeCode}}[name]" value="" class="form-control">
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="meta_desc[{{$localeCode}}]">Մետա տեքստ</label>
                                                <textarea name="meta_desc[{{$localeCode}}]" id="meta_desc[{{$localeCode}}]" cols="15" rows=4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="keywords[{{$localeCode}}]">Բանալի բառեր</label>
                                                <textarea name="keywords[{{$localeCode}}]" id="keywords[{{$localeCode}}]" cols="15" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div><!--row-->


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Ավելացնել</button>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
