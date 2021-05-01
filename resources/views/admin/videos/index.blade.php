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
                        <p><a class="btn btn-primary" href="{{ route('admin.videos.create') }}">Ավելացնել հոդված</a></p>
                    </div><!--row-->
                @endcan

                    {{--Search--}}
                    <div class="card-header">Ֆիլտր</div>
                    <div class="card-body">

                        <div class="row">
                            {{--About us page image--}}
                         <form method="post" action="{{ route('admin.videos.storePageSettings') }}" enctype="multipart/form-data">
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

                                            @if(settings()->group('Youtube_Page_Image')->has('page_img'))

                                                <img  style="max-width: 118px" src="{{ showForAdminPageImage(settings()->group('Youtube_Page_Image')->get('page_img')) }}" alt="">
                                            @else

                                                {{--no-image.jpg--}}
                                                <img  style="max-width: 118px" src="{{ $imagesServe }}/page_no_image.jpg" alt="">
                                            @endif
                                        </div>
                                    </div>

                                    @if(settings()->group('Youtube_Page_Image')->get('page_img'))
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
                    <div class="row">
                        <a class="btn btn-primary" href="{{ route('site.videos.index' ) }}">Կայքում</a>
                    </div><!--row-->


                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#Իդ</th>
                            <th>Վերնագիր</th>
                            <th>Տեսնել</th>
                            <th>Գործողություն</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $item)

                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.videos.edit', $item->id) }}" class="badge badge-primary">Խմբագրել</a>
                                    <form method="post" action="{{ route('admin.videos.destroy', $item->id) }}" class="d-inline">
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
                {{--Search end--}}
            </div>

        </div>
    </main>


@endsection

@section('scripts')

@endsection
