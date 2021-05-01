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

                <div class="card-header">Ցուցադրել օգտագործողին</div>
                <div class="card-body">
                    <div class="row">
                        <form method="get" action="{{ route('admin.menus.create', ['lang' ]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="lang">Ընտրել լեզուն</label>
                                <select name="lang" id="lang" class="form-control">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <option value="{{ $localeCode }}">{{ $properties['native'] }}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Հաստատել</button>
                            </div>
                        </form>
                    </div><!--row-->
                </div>
            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
