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
                        <p><a class="btn btn-primary" href="{{ route('admin.pages.boardOfTrusteesTeam.create') }}">Ավելացնել</a></p>
                    </div><!--row-->
                @endcan




                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <div class="row">
                        <a href="{{ route('boardOfTrusteesTeam.aboutUsOurTeam' ) }}"  class="btn btn-primary m-1">Board Of Trustees Team Տեսնել կայքում</a>
                    </div><!--row-->
<!--                    <div class="row">
                    </div>&lt;!&ndash;row&ndash;&gt;-->
                    <br>


                    <div class="row">
                        {{--About us page image--}}

                        <form method="post" action="{{ route('admin.pages.boardOfTrusteesTeam.storePageSettings') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="page_img">Էջի Նկար</label>
                                        <input type="file" name="page_img" id="page_img" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if(settings()->group('Our_Board_of_Trustees')->has('page_img'))

                                            <img  style="max-width: 118px" src="{{ showForAdminPageImage(settings()->group('Our_Board_of_Trustees')->get('page_img')) }}" alt="">
                                        @else
                                            {{--no-image.jpg--}}
                                            <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                        @endif
                                    </div>
                                </div>

                                @if(settings()->group('Our_Board_of_Trustees')->get('page_img'))
                                    <div class="col-md-2">
                                        <label for="delete_page_img">Ջնջել նկարը</label>
                                        <input type="checkbox" id="delete_page_img" name="delete_page_img">
                                    </div>
                                @endif
                            </div><!--row-->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Փոփոխել</button>
                            </div>
                            <br><br>
                        </form>
                        {{--About us page image end--}}
                    </div><!--row-->
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
                                        <th>Անուն</th>
                                        <th>Ազգանուն</th>
                                        <th>Գործողություններ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->getTranslation('f_name', $localeCode) }}</td>
                                            <td>{{ $item->getTranslation('l_name', $localeCode) }}</td>

                                            <td>
                                                <a href="{{ route('admin.pages.boardOfTrusteesTeam.edit', $item->id) }}" class="badge badge-primary">Փոփոխել</a>
                                                <form method="post" action="{{ route('admin.pages.boardOfTrusteesTeam.destroy', $item->id) }}" class="d-inline">
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
