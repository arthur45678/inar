@extends('layouts.account')

@section('styles')

@endsection

@section('content')

    <div class="section-header">
        <h1>{{ $title }}</h1>

    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Բարև {{ Auth::user()->f_name . ' '.Auth::user()->l_name}}  {{__('You are logged in!') }}</h4>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('account.messages.sendManagerMessageSaveData') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Text</label>
                                <input name="title" type="text" class="form-control" id="name" placeholder="">
                            </div>


                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" class="form-control" id="body"  cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning">Send Message</button>
                            </div>
                        </form>


                    </div>
                    <div class="card-footer">
                        Footer Card
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

@endsection
