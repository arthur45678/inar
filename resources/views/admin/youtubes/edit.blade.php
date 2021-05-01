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
                    <h3>Youtube հղում ավելացնելու կարգը</h3>
                    <p>Youtube վիդոեյի ներքևում սեղմում եք Share -> Embed, copy - եք անում HTML կոդը և տեղադրում եք Youtube - հղղում դաշտում</p>

                    <form method="post" action="{{ route('admin.youtubes.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Youtube - հղղում</label>
                            <input name="youtube_link" id="youtube_link" value="{{ $post->youtube_link }}" type="text" class="form-control" >
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
