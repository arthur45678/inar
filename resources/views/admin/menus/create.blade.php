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

                    <!-- @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if($lang == $localeCode)
                            Menu for <strong>{{ $properties['native'] }}</strong> language
                        @endif

                    @endforeach -->
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="parent">Ներդրման կարգը</label>
                            <select name="parent" id="parent" class="form-control">
                                <option value="0">Գլխավոր մենյու</option>
                                @include('admin.menus.includes.navigationSelectParentMenu', ['tree' => $data['parents'],  $r = 0, $p = null])
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="title">Անուն</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Տարբերակում</label>
                            <select class="form-control" name="status">
                                <option value="1">Մեջից</option>
                                <option value="0">Գլխավորի տակից</option>
                                <option value="0">Կողքից</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="path">Հղում (Կարող եք ընտրել մենյուից կամ ուղակի հղում դնել)</label>
                            <input type="url" name="path" id="path" value="{{ old('path') }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <button class="item-name btn btn-primary">Ստեղծել</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection



