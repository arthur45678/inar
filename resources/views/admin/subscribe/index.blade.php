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
                                <div class="page-header-icon"><i data-feather="mail"></i></div>
                                Subscribe
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.storeSubscribeModalTextSettings') }}" enctype="multipart/form-data">
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
                                                <label for="{{$localeCode}}[site_description]">Բաժանորդագրվելու պատուհանի վրայի տեքստը</label>
                                                <textarea  class="form-control" name="{{$localeCode}}[subscriber_modal_description]" id="{{$localeCode}}[subscriber_modal_description]" cols="30" rows="10">{{ settings()->group($localeCode)->get('subscriber_modal_description') }}</textarea>
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

                </div><!--row-->
                <div class="row">
                    <div class="col-7">
                        <div class="card-body">
                            <!--                            -->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#Իդ</th>
                                    <th>Email</th>

                                    <th>Գործողություն</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)

                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.subscribe.edit', $item->id) }}" class="badge badge-primary">Խմբագրել</a>
                                            <form method="post" action="{{ route('admin.subscribe.destroy', $item->id) }}" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="badge badge-danger">Ջնջել</button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        {{ $posts->links() }}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection

@section('scripts')

@endsection
