<div>
    @if(isset(Auth::user()->manager))
        <div class="row px-3 pb-3">

        <!-- @if(Auth::user()->img) -->
            <img style="width: 100px" src="{{ showAvatar(Auth::user()->img) }}" alt="">
            <!-- <img style="width:80%" src="" alt=""> -->
        <!-- @else -->
            <img style="max-width: 150px" src="{{asset('asset/site/css/icons-images/avatar.png')}}" alt="" />
        <!-- @endif -->
        </div>
    @endif
    <div class="row">
        @if ( auth()->user() && auth()->user()->has('manager'))
            <div class="col-md-12">Ձեր մենեջերն է՝</div>
            <div class="col-md-12">{{ auth()->user()->manager->f_name }}&nbsp;{{ auth()->user()->manager->l_name }}</div>
            <div class="col-md-12">Էլ հասցե՝&nbsp;{{ auth()->user()->manager->email }}</div>
            <div class="col-md-12">Հեռ: {{ auth()->user()->manager->phone_1 }}՝</div>
            <div class="col-md-12">Հեռ: {{ auth()->user()->manager->phone_2 }}՝</div>
            <div class="col-md-12 my-2">
                <i class="fab fa-viber" style="font-size:23px;color:rgb(115,096,242)"></i>&nbsp;{{ auth()->user()->manager->viber }}
            </div>
            <div class="col-md-12 my-2">
                <i class="fab fa-whatsapp" style="font-size:24px;color:#43d854"></i>&nbsp;{{ auth()->user()->manager->whatsapp }}
            </div>

        @endif

    </div>
    <div class="row px-3">
        <a href="{{ route('account.messages.sendManagerMessage') }}" class="btn btn-warning">Ուղարկել նամակ</a>
    </div><!--row-->
</div>
