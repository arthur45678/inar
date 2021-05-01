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
                    <form method="post" action="{{ route('admin.pages.qualities.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_img">Էջի մեծ Նկար</label>
                                    <input type="file" name="page_img" id="page_img" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->page_img)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->page_img) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->page_img))
                                <div class="col-md-2">
                                    <label for="delete_page_img">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_page_img" name="delete_page_img">
                                </div>
                            @endif
                        </div><!--row-->

                        {{--Page image--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_img_mini">Էջի փոքր Նկար</label>
                                    <input type="file" name="page_img_mini" id="page_img_mini" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->page_img_mini)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->page_img_mini) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->page_img_mini))
                                <div class="col-md-2">
                                    <label for="delete_page_img_mini">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_page_img_mini" name="delete_page_img_mini">
                                </div>
                            @endif
                        </div><!--row-->

                        {{--Common end--}}



                        {{--Page image--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_img_bottom">Էջի ներքևի Նկար</label>
                                    <input type="file" name="page_img_bottom" id="page_img_bottom" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->page_img_bottom)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->page_img_bottom) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->page_img_bottom))
                                <div class="col-md-2">
                                    <label for="delete_page_img_bottom">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_page_img_bottom" name="delete_page_img_bottom">
                                </div>
                            @endif
                        </div><!--row-->


                       

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item" role="{{$localeCode}}">
                                    <a class="nav-link {{ (App::getLocale() ==  $localeCode) ? 'active' : ''}}" id="pills-home-tab" data-toggle="pill" href="#tab_{{$localeCode}}" aria-controls="{{$localeCode}}" aria-selected="true">{{ $properties['native'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent-556">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div class="tab-pane fade show {{ (App::getLocale() ==  $localeCode) ? 'active' : ''}}" id="tab_{{$localeCode}}" role="{{$localeCode}}" aria-labelledby="pills-home-tab">
                                    <div class="form-group">
                                        <label >Գրաֆիկ վերևի տեքստի տակ</label>
                                        <select style="width: 500px" name="chart_text_top_id[{{$localeCode}}]" class="form-control select2">
                                            <option value="">Ընտրել</option>
                                            @foreach($charts[$localeCode] as $item)
                                                @if($post->getTranslation('chart_text_top_id',$localeCode) == $item->id)
                                                    <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Գրաֆիկ ներքևի տեքստի տակ</label>
                                        <select style="width: 500px" name="chart_text_bottom_id[{{$localeCode}}]" class="form-control  select2">
                                            <option value="">Ընտրել</option>
                                            @foreach($charts[$localeCode] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @if($post->getTranslation('chart_text_bottom_id',$localeCode) == $item->id)
                                                    <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name[{{$localeCode}}]">Վերնագիր</label>
                                        <input type="text" name="name[{{$localeCode}}]" id="name[{{$localeCode}}]" value="{{ $post->getTranslation('name', $localeCode) }}" class="form-control">
                                    </div>


                                    <label for="my-editor-text_top-{{$localeCode}}">Վերևի տեքստ</label>
                                    <x-forms.ckeditor name="text_top[{{$localeCode}}]" value="{!! $post->getTranslation('text_top', $localeCode) !!}"/>


                                    <label for="my-editor-text_bottom-{{$localeCode}}">Ներքևի տեքստ</label>
                                    <x-forms.ckeditor name="text_bottom[{{$localeCode}}]" value="{!! $post->getTranslation('text_bottom', $localeCode) !!}"/>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="meta_desc[{{$localeCode}}]">Մետա տեքստ</label>
                                                <textarea name="meta_desc[{{$localeCode}}]" id="meta_desc[{{$localeCode}}]" cols="15" rows=4" class="form-control">{{ $post->getTranslation('meta_desc', $localeCode) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="keywords[{{$localeCode}}]">Բանալի բառեր</label>
                                                <textarea name="keywords[{{$localeCode}}]" id="keywords[{{$localeCode}}]" cols="15" rows="4" class="form-control">{{ $post->getTranslation('keywords', $localeCode) }}</textarea>
                                            </div>
                                        </div>
                                    </div><!--row-->
                                </div>

                            @endforeach
                        </div>
                        <!--                Square images                    -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_icon_symbol_1">Մենյույի հղումի նկար</label>
                                    <input type="file" name="service_icon_symbol_1" id="service_icon_symbol_1" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->service_icon_symbol_1)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->service_icon_symbol_1) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->service_icon_symbol_1))
                                <div class="col-md-2">
                                    <label for="delete_service_icon_symbol_1">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_service_icon_symbol_1" name="delete_service_icon_symbol_1">
                                </div>
                            @endif
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_1">Ծառայության գինը 1</label>
                                    <input type="text" name="service_price_1" id="service_price_1" class="form-control" value="{{ $post->service_price_1 }}">
                                </div>
                            </div>
                        </div><!--row-->
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="service_name_1[{{$localeCode}}]">Վերնագիր 1 {{$localeCode}}</label>
                                <input type="text" name="service_name_1[{{$localeCode}}]" id="service_name_1[{{$localeCode}}]" value="{{ $post->getTranslation('service_name_1', $localeCode) }}" class="form-control">
                            </div>
                        @endforeach
                        <p class="lead">____________________________________________________________________________</p>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_icon_symbol_2">Մենյույի հղումի նկար 2</label>
                                    <input type="file" name="service_icon_symbol_2" id="service_icon_symbol_2" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="service_price_2">Ծառայության գինը 2</label>
                                        <input type="text" name="service_price_2" id="service_price_2" class="form-control" value="{{ $post->service_price_2 }}">
                                    </div>
                                </div>
                            </div><!--row-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->service_icon_symbol_2)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->service_icon_symbol_2) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->service_icon_symbol_2))
                                <div class="col-md-2">
                                    <label for="delete_service_icon_symbol_2">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_service_icon_symbol_2" name="delete_service_icon_symbol_2">
                                </div>
                            @endif
                        </div><!--row-->
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="service_name_2[{{$localeCode}}]">Վերնագիր 2 {{$localeCode}}</label>
                                <input type="text" name="service_name_2[{{$localeCode}}]" id="service_name_2[{{$localeCode}}]" value="{{ $post->getTranslation('service_name_2', $localeCode) }}" class="form-control">
                            </div>
                        @endforeach
                        <p class="lead">____________________________________________________________________________</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_icon_symbol_3">Մենյույի հղումի նկար 3</label>
                                    <input type="file" name="service_icon_symbol_3" id="service_icon_symbol_3" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->service_icon_symbol_3)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->service_icon_symbol_3) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->service_icon_symbol_3))
                                <div class="col-md-2">
                                    <label for="delete_service_icon_symbol_3">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_service_icon_symbol_3" name="delete_service_icon_symbol_3">
                                </div>
                            @endif
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_3">Ծառայության գինը 3</label>
                                    <input type="text" name="service_price_3" id="service_price_3" class="form-control" value="{{ $post->service_price_3 }}">
                                </div>
                            </div>
                        </div><!--row-->

                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="service_name_3[{{$localeCode}}]">Վերնագիր 3 {{$localeCode}}</label>
                                <input type="text" name="service_name_3[{{$localeCode}}]" id="service_name_3[{{$localeCode}}]" value="{{ $post->getTranslation('service_name_3', $localeCode) }}" class="form-control">
                            </div>
                        @endforeach
                        <p class="lead">____________________________________________________________________________</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_icon_symbol_4">Մենյույի հղումի նկար 4</label>
                                    <input type="file" name="service_icon_symbol_4" id="service_icon_symbol_4" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->service_icon_symbol_4)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->service_icon_symbol_4) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->service_icon_symbol_4))
                                <div class="col-md-2">
                                    <label for="delete_service_icon_symbol_4">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_service_icon_symbol_4" name="delete_service_icon_symbol_4">
                                </div>
                            @endif
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_4">Ծառայության գինը 4</label>
                                    <input type="text" name="service_price_4" id="service_price_4" class="form-control" value="{{ $post->service_price_4 }}">
                                </div>
                            </div>
                        </div><!--row-->
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="service_name_4[{{$localeCode}}]">Վերնագիր 4 {{$localeCode}}</label>
                                <input type="text" name="service_name_4[{{$localeCode}}]" id="service_name_4[{{$localeCode}}]" value="{{ $post->getTranslation('service_name_4', $localeCode) }}" class="form-control">
                            </div>
                        @endforeach
                        <p class="lead">____________________________________________________________________________</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_icon_symbol_5">Մենյույի հղումի նկար 5</label>
                                    <input type="file" name="service_icon_symbol_5" id="service_icon_symbol_5" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->service_icon_symbol_5)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->service_icon_symbol_5) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->service_icon_symbol_5))
                                <div class="col-md-2">
                                    <label for="delete_service_icon_symbol_5">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_service_icon_symbol_5" name="delete_service_icon_symbol_5">
                                </div>
                            @endif
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_5">Ծառայության գինը 5</label>
                                    <input type="text" name="service_price_5" id="service_price_5" class="form-control" value="{{ $post->service_price_5 }}">
                                </div>
                            </div>
                        </div><!--row-->
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="service_name_5[{{$localeCode}}]">Վերնագիր 5 {{$localeCode}}</label>
                                <input type="text" name="service_name_5[{{$localeCode}}]" id="service_name_5[{{$localeCode}}]" value="{{ $post->getTranslation('service_name_5', $localeCode) }}" class="form-control">
                            </div>
                        @endforeach
                        <p class="lead">____________________________________________________________________________</p>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_icon_symbol_6">Մենյույի հղումի նկար 6</label>
                                    <input type="file" name="service_icon_symbol_6" id="service_icon_symbol_6" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->service_icon_symbol_6)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->service_icon_symbol_6) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->service_icon_symbol_6))
                                <div class="col-md-2">
                                    <label for="delete_service_icon_symbol_6">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_service_icon_symbol_6" name="delete_service_icon_symbol_6">
                                </div>
                            @endif
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_price_6">Ծառայության գինը 6</label>
                                    <input type="text" name="service_price_6" id="service_price_6" class="form-control" value="{{ $post->service_price_6 }}">
                                </div>
                            </div>
                        </div><!--row-->
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="service_name_6[{{$localeCode}}]">Վերնագիր 6 {{$localeCode}}</label>
                                <input type="text" name="service_name_6[{{$localeCode}}]" id="service_name_6[{{$localeCode}}]" value="{{ $post->getTranslation('service_name_6', $localeCode) }}" class="form-control">
                            </div>
                        @endforeach
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
