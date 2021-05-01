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
                    <form method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="post_type_select">Հոդվածի տեսակը</label>
                            <select name="post_type_value" class="form-control" id="post_type_select">
                                <option value='{{\App\Enums\PostsEnum::article()}}'>Նորություն</option>
                                <option value='{{\App\Enums\PostsEnum::press_releases()}}'>Պրեսս-Ռելիզ</option>
                            </select>
                        </div>

                        {{--Common data--}}
                        <div class="form-group">
                            <label for="img">Նկար</label>
                            <input name="img" id="img" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>

                        <div class="form-group">
                            <label for="img_mini">Փոքր նկար</label>
                            <input name="img_mini" id="img_mini" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>


                        <div class="form-group">
                            <label for="categories">Բաժիններ</label>
                            <select name="categories[]" id="categories" class="select2 form-control"  multiple="multiple">
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ showTranslationsNameAllLanguage($item, 'name') }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{--Common end--}}


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
                                        <label for="{{$localeCode}}[title]">Վերնագիր</label>
                                        <input type="text" name="name[{{$localeCode}}]" id="{{$localeCode}}[title]" value="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label >Գրաֆիկ վերևի տեքստի տակ</label>
                                        <select name="chart_text_top_id[{{$localeCode}}]" class="form-control select2">
                                            <option value="">Ընտրել</option>
                                            @foreach($charts[$localeCode] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="desc[{{$localeCode}}]">Կարճ տեքստ</label>
                                                <textarea name="desc[{{$localeCode}}]" id="desc[{{$localeCode}}]" cols="15" rows=4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div><!--row-->

                                    <x-forms.ckeditor name="text[{{$localeCode}}]" value=""/>

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
