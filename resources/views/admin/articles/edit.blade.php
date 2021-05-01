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
                    <form method="post" action="{{ route('admin.articles.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')




                        {{--Post image--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img">Նկար</label>
                                    <input type="file" name="img" id="img" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->img)
                                        <img style="max-width: 118px" src="{{ showForAdminPageImage($post->img) }}" alt="">
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

                        {{--Post image--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img_mini">Նկար</label>
                                    <input type="file" name="img_mini" id="img_mini" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->img_mini)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->img_mini) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                    @endif
                                </div>
                            </div>

                            @if(isset($post->img_mini))
                                <div class="col-md-2">
                                    <label for="delete_img_mini">Ջնջել նկարը</label>
                                    <input type="checkbox" id="delete_img_mini" name="delete_img_mini">
                                </div>
                            @endif
                        </div><!--row-->



                        <div class="form-group">
                            <label for="categories">Բաժիններ</label>
                            <select name="categories[]" id="categories" class="select2 form-control"  multiple="multiple">
                                @foreach($categories as $category)
                                    @if($post->categories()->where('category_id', $category->id)->exists())
                                        <option selected value="{{ $category->id }}">{{ showTranslationsNameAllLanguage($category, 'name') }}</option>
                                    @else
                                        <option  value="{{ $category->id }}">{{ showTranslationsNameAllLanguage($category, 'name') }}</option>
                                    @endif
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
                                        <label for="name[{{$localeCode}}]">Վերնագիր</label>
                                        <input type="text" name="name[{{$localeCode}}]" id="name[{{$localeCode}}]" value="{{ $post->getTranslation('name', $localeCode) }}" class="form-control">
                                    </div>

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


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="desc[{{$localeCode}}]">Կարճ տեքստ</label>
                                                <textarea name="desc[{{$localeCode}}]" id="desc[{{$localeCode}}]" cols="15" rows=4" class="form-control">{{ $post->getTranslation('desc', $localeCode) }}</textarea>
                                            </div>
                                        </div>
                                    </div><!--row-->

                                    <x-forms.ckeditor name="text[{{$localeCode}}]" value="{!! $post->getTranslation('text', $localeCode) !!}"/>


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
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Թարմացնել</button>
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
<script>
    /*Test*/

    /*Testend*/

    function clickTrash(id) {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
</script>

<script>



</script>
@endsection
