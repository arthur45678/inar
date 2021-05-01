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

                @can('posts-create')
                    <div class="card-body">
                        <p><a class="btn btn-primary" href="{{ route('admin.pages.buisnessEnvioirments.create') }}">Ավելացնել էջ</a></p>
                    </div><!--row-->
                @endcan
                    {{--Search--}}
                    <div class="card-header">Ֆիլտր</div>
                    <div class="card-body">
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="search-text" class="col-form-label">Տեքստ</label>
                                        <input id="search-text" class="form-control" name="search-text" value="{{ request('id') }}">
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">Որոնել</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--Search end--}}


                <div class="card-header">{{ $title }}</div>
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
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#Իդ</th>
                                        <th>Անվանում</th>
                                        <th>Տեսնել</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $item)
                                        @if($item->hasTranslation('name', $localeCode))
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->getTranslation('name', $localeCode) }}</td>
                                                <td><a href="{{ route('pages.buisnessEnvioirments.show', $item->slug) }}"  class="badge badge-primary">Տեսնել</a></td>
                                                <td>
                                                    <a href="{{ route('admin.pages.buisnessEnvioirments.edit', $item->id) }}" class="badge badge-primary">Փոփոխել</a>
                                                    <form method="post" action="{{ route('admin.pages.buisnessEnvioirments.destroy', $item->id) }}" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="badge badge-danger">Ջնջել</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $posts->links() }}
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
