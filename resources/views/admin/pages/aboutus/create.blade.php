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
                    <form method="post" action="{{ route('admin.pages.aboutus.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{--Common data--}}

                        <div class="form-group">
                            <label for="department">Բաժանմունք</label>
                            <select name="department_id" id="department_id" class="select2 form-control">
                                @foreach($departments as $item)
                                    <option value="{{ $item->id }}">{{ showTranslationsNameAllLanguage($item, 'name') }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="img">Աշխատակցի նկարը</label>
                            <input name="img" id="img" type="file" class="form-control filestyle" data-buttonName="btn-primary">
                        </div>

                        <div class="form-group">
                            <label for="email">Էլ հասցե</label>
                            <input name="email" id="email" type="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone">Հեռախոսահամար</label>
                            <input name="phone" id="phone" type="tel" class="form-control">
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
                                        <label for="f_name[{{$localeCode}}]">Անուն</label>
                                        <input type="text" name="f_name[{{$localeCode}}]" id="f_name[{{$localeCode}}]" value="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="l_name[{{$localeCode}}]">Ազգանուն</label>
                                        <input type="text" name="l_name[{{$localeCode}}]" id="l_name[{{$localeCode}}]" value="" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label for="position[{{$localeCode}}]">Պաշտոն</label>
                                        <input type="text" name="position[{{$localeCode}}]" id="position[{{$localeCode}}]" value="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="short_desc[{{$localeCode}}]">Կարճ բնութագիր</label>
                                        <textarea name="short_desc[{{$localeCode}}]" id="short_desc[{{$localeCode}}]" class="form-control" cols="30" rows="3"></textarea>
                                    </div>


                                </div>
                            @endforeach
                        </div>


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
