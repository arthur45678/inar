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
                    <form method="post" action="{{ route('admin.settings.storeGeneralSettings') }}" enctype="multipart/form-data">
                        @csrf
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
                                        <label for="{{$localeCode}}[site_title]">Կայքի անվանումը</label>
                                        <input type="text" name="{{$localeCode}}[site_title]" id="{{$localeCode}}[site_title]" value="{{ settings()->group($localeCode)->get('site_title') }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$localeCode}}[site_description]">Կայքի բնութագիրը</label>
                                        <textarea  class="form-control" name="{{$localeCode}}[site_description]" id="{{$localeCode}}[site_description]" cols="30" rows="10">{{ settings()->group($localeCode)->get('site_description') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$localeCode}}[top-header]">Կայքի վերևի գրված անվանումը</label>
                                        <input type="text" name="{{$localeCode}}[top-header]" id="{{$localeCode}}[top-header]" value="{{ settings()->group($localeCode)->get('top-header') }}" class="form-control">
                                    </div>

                                    <label for="{{$localeCode}}[address]">Հասցե</label>
                                    <x-forms.ckeditor name="{{$localeCode}}[address]" value="{!! settings()->group($localeCode)->get('address') !!}"/>


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
