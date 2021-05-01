@extends('layouts.account')

@section('styles')

@endsection

@section('content')

    <div class="section-header">
        <h4>{{ Auth::user()->f_name }}&nbsp;{{ Auth::user()->l_name }}</h4>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header"> -->
                        <!-- <h4 class="col-md-4 px-0">Բարև {{ Auth::user()->f_name . ' '.Auth::user()->l_name}}  {{__('You are logged in!') }}</h4> -->
                    <!-- </div> -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mt-3 mr-1">
                               @include('account.includes.sidebar')
                            </div>
                        <div class="col-md-8 col-sm-12 mt-3 ml-sm-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <div>Էլ. հասցե՝ {{ Auth::user()->email  }}</div>
                                     <div>Հեռ.`{{ Auth::user()->phone_1  }}&nbsp{{ Auth::user()->phone_2  }};</div>

                                </div>
                            </div>
                        </div><!--row-->

                        <div class="row">


                            <div class="col-md-12">
                                <br><br>
                                    <h4>Ծանուցումներ</h4>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Ամսաթիվ</th>
                                            <th>Վեռնագիր</th>
                                            <th>Ուղարկող</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($messages as $item)
                                            <tr>
                                                <td>{{ presentDate($item->created_at) }}</td>
                                                <td><a href="{{ route('account.messages.show',$item->id)  }}">{{ $item->name }}</a></td>
                                                <td>{{ $item->sender->f_name }}&nbsp;{{ $item->sender->l_name }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                {{ $messages->links() }}

                            </div>

                        </div><!--row-->

                        </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

@endsection
