


<div class="row p-2" style="background-color:white !important; box-shadow: 5px 5px 8px rgba(0, 0, 0, 0.3); min-height:80px !important;">
    <div class="col-md-3 col-3">
        <div class="row justify-content-center">
            <div class="col-auto col-md-auto">
                <img src="{{asset('web_image/logo.png')}}" alt="" style="width:100px !important; height: 100px !important;">
            </div>
            <div class="col-auto col-md-auto d-flex align-items-center">
                <h2 class="gradient-text">TABEAM</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-6 d-flex align-items-center justify-content-between p-2">
        <a href="{{ url('/') }}" class="btn btn_menu {{ Request::is('/') || Request::is('search_result') ? 'btn_active' : '' }}" @auth onclick="event.preventDefault();" @endauth>HOME</a>
        <a href="{{ route('login') }}" class="btn btn_menu {{ Request::is('about_us') ? 'btn_active' : '' }}">LOGIN</a>
        <a href="{{ route('register') }}" class="btn btn_menu {{ Request::is('newsletter') ? 'btn_active' : '' }}">REGISTER</a>
    </div>
    <div class="col-md-3 col-3 p-2 d-flex align-items-center justify-content-end">
    </div>
</div>