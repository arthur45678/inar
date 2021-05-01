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
                    <form method="post" action="{{ route('admin.pages.qualities.store') }}" enctype="multipart/form-data">
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


                                </div>
                            @endforeach
                        </div>


                        <p>Սիմվոլը png թափանցիկ 100px X 100px</p>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_icon_symbol_1">Մենյուի հղումի նկար 1</label>
                                    <input type="file" name="service_icon_symbol_1" id="service_icon_symbol_1" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_1">Ծառայության գինը 1</label>
                                    <input type="text" name="service_price_1" id="service_price_1" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->

                        <div class="row">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="col-4">
                                        <label for="service_name_1[{{$localeCode}}]">Վեռնագիր 1 {{$localeCode}}</label>
                                        <input type="text" name="service_name_1[{{$localeCode}}]" id="service_name_1[{{$localeCode}}]" value="" class="form-control">
                                    </div>
                            @endforeach
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_icon_symbol_2">Մենյուի հղումի նկար 2</label>
                                    <input type="file" name="service_icon_symbol_2" id="service_icon_symbol_2" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_2">Ծառայության գինը 2</label>
                                    <input type="text" name="service_price_2" id="service_price_1" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->

                        <div class="row">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-4">
                                    <label for="service_name_2[{{$localeCode}}]">Վեռնագիր 2 {{$localeCode}}</label>
                                    <input type="text" name="service_name_2[{{$localeCode}}]" id="service_name_2[{{$localeCode}}]" value="" class="form-control">
                                </div>
                            @endforeach
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_icon_symbol_3">Մենյուի հղումի նկար 3</label>
                                    <input type="file" name="service_icon_symbol_3" id="service_icon_symbol_3" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_3">Ծառայության գինը 3</label>
                                    <input type="text" name="service_price_3" id="service_price_3" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->

                        <div class="row">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-4">
                                    <label for="service_name_3[{{$localeCode}}]">Վեռնագիր 3 {{$localeCode}}</label>
                                    <input type="text" name="service_name_3[{{$localeCode}}]" id="service_name_3[{{$localeCode}}]" value="" class="form-control">
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_icon_symbol_4">Մենյուի հղումի նկար 4</label>
                                    <input type="file" name="service_icon_symbol_4" id="service_icon_symbol_4" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_4">Ծառայության գինը 4</label>
                                    <input type="text" name="service_price_4" id="service_price_4" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-4">
                                    <label for="service_name_4[{{$localeCode}}]">Վեռնագիր 4 {{$localeCode}}</label>
                                    <input type="text" name="service_name_4[{{$localeCode}}]" id="service_name_4[{{$localeCode}}]" value="" class="form-control">
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_icon_symbol_5">Մենյուի հղումի նկար 5</label>
                                    <input type="file" name="service_icon_symbol_5" id="service_icon_symbol_5" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_5">Ծառայության գինը 5</label>
                                    <input type="text" name="service_price_5" id="service_price_5" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-4">
                                    <label for="service_name_5[{{$localeCode}}]">Վեռնագիր 5 {{$localeCode}}</label>
                                    <input type="text" name="service_name_5[{{$localeCode}}]" id="service_name_5[{{$localeCode}}]" value="" class="form-control">
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_icon_symbol_6">Մենյուի հղումի նկար 6</label>
                                    <input type="file" name="service_icon_symbol_6" id="service_icon_symbol_6" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_1">Ծառայության գինը 6</label>
                                    <input type="text" name="service_price_6" id="service_price_6" class="form-control" >
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="col-4">
                                    <label for="service_name_6[{{$localeCode}}]">Վեռնագիր 6 {{$localeCode}}</label>
                                    <input type="text" name="service_name_6[{{$localeCode}}]" id="service_name_6[{{$localeCode}}]" value="" class="form-control">
                                </div>
                            @endforeach
                        </div>
                        {{--Icons end--}}

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ավելացնել</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
