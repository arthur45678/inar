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
                    <form method="post" action="{{ route('admin.pages.simples.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{--Common data--}}

                        <div class="form-group">
                            <label for="page_img">Էջի մեծ նկար</label>
                            <input name="page_img" id="page_img" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>
                        <div class="form-group">
                            <label for="page_img_mini">Էջի փոքր նկար</label>
                            <input name="page_img_mini" id="page_img_mini" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>

                        <div class="form-group">
                            <label for="page_img_top">Էջի վերևի նկար</label>
                            <input name="page_img_top" id="page_img_top" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>

                        <div class="form-group">
                            <label for="page_img_middle">Էջի մեջտեղի նկար</label>
                            <input name="page_img_middle" id="page_img_middle" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>

                        <div class="form-group">
                            <label for="page_img_bottom">Էջի ներքևի նկար</label>
                            <input name="page_img_bottom" id="page_img_bottom" type="file" class="form-control filestyle" data-buttonName="btn-primary">
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
                                        <label for="name[{{$localeCode}}]">Վերնագիր</label>
                                        <input type="text" name="name[{{$localeCode}}]" id="name[{{$localeCode}}]" value="" class="form-control">
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

                                    <div class="form-group">
                                        <label >Գրաֆիկ մեջտեղի տեքստի տակ</label>
                                        <select name="chart_text_middle_id[{{$localeCode}}]" class="form-control  select2">
                                            <option value="">Ընտրել</option>
                                            @foreach($charts[$localeCode] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Գրաֆիկ ներքևի տեքստի տակ</label>
                                        <select name="chart_text_bottom_id[{{$localeCode}}]" class="form-control  select2">
                                            <option value="">Ընտրել</option>
                                            @foreach($charts[$localeCode] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    

                                    <label for="text_top[{{$localeCode}}]">Վերևի տեքստ</label>
                                    <x-forms.ckeditor name="text_top[{{$localeCode}}]" value=""/>

                                    <label for="text_middle[{{$localeCode}}]">Մեջտեղի տեքստ</label>
                                    <x-forms.ckeditor name="text_middle[{{$localeCode}}]" value=""/>

                                    <label for="text_bottom[{{$localeCode}}]">Ներքևի տեքստ</label>
                                    <x-forms.ckeditor name="text_bottom[{{$localeCode}}]" value=""/>

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
