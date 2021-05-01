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
                    <form method="post" action="{{ route('admin.pages.aboutus.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="department">Բաժանմունք</label>
                            <select name="department_id" id="department_id" class="select2 form-control">
                                @foreach($departments as $employeeDepartment)
                                    @if($post->department_id == $employeeDepartment->id)
                                        <option selected value="{{ $employeeDepartment->id }}">{{ showTranslationsNameAllLanguage($employeeDepartment, 'name') }}</option>
                                    @else
                                        <option  value="{{ $employeeDepartment->id }}">{{ showTranslationsNameAllLanguage($employeeDepartment, 'name') }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img">Էջի մեծ Նկար</label>
                                    <input type="file" name="img" id="img" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @if($post->img)

                                        <img  style="max-width: 118px" src="{{ showForAdminPageImage($post->img) }}" alt="">
                                    @else
                                        {{--no-image.jpg--}}
                                        <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
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
                            <label for="email">Էլ հասցե</label>
                            <input name="email" id="email" type="email" value="{{ $post->email }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone">Հեռախոսահամար</label>
                            <input name="phone" id="phone" type="tel" value="{{ $post->phone }}" class="form-control">
                        </div>



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
                                        <label for="f_name[{{$localeCode}}]">Անուն</label>
                                        <input type="text" name="f_name[{{$localeCode}}]" id="f_name[{{$localeCode}}]" value="{{ $post->getTranslation('f_name', $localeCode) }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="l_name[{{$localeCode}}]">Ազգանուն</label>
                                        <input type="text" name="l_name[{{$localeCode}}]" id="l_name[{{$localeCode}}]" value="{{ $post->getTranslation('l_name', $localeCode) }}" class="form-control">
                                    </div>



                                    <div class="form-group">
                                        <label for="position[{{$localeCode}}]">Պաշտոն</label>
                                        <input type="text" name="position[{{$localeCode}}]" id="position[{{$localeCode}}]" value="{{ $post->getTranslation('position', $localeCode) }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="short_desc[{{$localeCode}}]">Կարճ բնութագիր</label>
                                        <textarea name="short_desc[{{$localeCode}}]" id="short_desc[{{$localeCode}}]" class="form-control" cols="30" rows="3">{{ $post->getTranslation('short_desc', $localeCode) }}</textarea>
                                    </div>

                                </div>

                            @endforeach
                        </div>


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
