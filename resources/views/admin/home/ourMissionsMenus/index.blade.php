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


                {{--Search--}}
                <div class="card-header">Մենյու</div>
                <div class="card-body">




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
                                        <form method="post" action="{{ route('admin.storeOurMissionsMenusPageSettings') }}" enctype="multipart/form-data">
                                            @csrf
                                        <div class="form-group">
                                            <label for="{{$localeCode}}[ourMissionsPage_description]">Էջի բնութագիրը</label>
                                            <textarea  class="form-control" name="{{$localeCode}}[ourMissionsPage_description]" id="{{$localeCode}}[ourMissionsPage_description]" cols="30" rows="10">{{ settings()->group($localeCode)->get('ourMissionsPage_description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Թարմացնել</button>
                                        </div>
                                        </form>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Վերնագիր</th>
                                                <th>Հղում</th>
                                                <th>Խմբագրել</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if(isset($menus[$localeCode]))
                                                @foreach($menus[$localeCode] as $item)
                                                    <tr>


                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ $item->path }}</td>
                                                        <td>
                                                            <a class="badge badge-primary" href="{{ route('admin.home.ourMissionsMenus.edit', $item->id) }}">Փոփոխել</a>
                                                            <form method="post" action="{{ route('admin.home.ourMissionsMenus.destroy', $item->id) }}" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="badge badge-danger">Удалить</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>


                                    </div>

                                @endforeach
                            </div>






                </div>
                {{--Search end--}}
            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
