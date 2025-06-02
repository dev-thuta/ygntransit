@extends('layouts.front')
@section('title', 'မူလစာမျက်နှာ')
@section('content')

    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">YGN Transit</h1>
            <p class="lead">ရှင်းလင်းပြတ်သားတဲ့ မြို့တွင်းဘတ်စ်ကားလမ်းညွှန်</p>

            <div class="search-container sticky-top mb-4">
                <form class="search-form" role="search" action="{{ url('/bus-routes') }}" method="GET">
                    <div class="search-icon-left">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control search-input" type="search" name="search" id="searchInput"
                        placeholder="ဘတ်စ်/မှတ်တိုင်ဖြင့် ရှာဖွေရန်.."
                        aria-label="Search" />
                    <div class="search-icon-right" id="micIcon" style="cursor:pointer;">
                        <i class="bi bi-mic-fill"></i>
                    </div>
                </form>
            </div>
        </div>

        <div class="row text-center mb-5">
            <div class="col-md-4 mb-3">
                <a href="{{ url('/bus-lines') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 h-100">
                        <i class="bi bi-bus-front fs-1 text-warning"></i>
                        <h5 class="mt-3">ဘတ်စ်ကားလိုင်းများ</h5>
                        <p class="text-muted small">လိုင်းနံပါတ်အလိုက် ရှာဖွေကြည့်ပါ။</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ url('/bus-stops') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 h-100">
                        <i class="bi bi-geo-alt fs-1 text-danger"></i>
                        <h5 class="mt-3">မှတ်တိုင်များ</h5>
                        <p class="text-muted small">အနီးဆုံး မှတ်တိုင်များကို ကြည့်ရှုပါ။</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ url('/guide') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 h-100">
                        <i class="bi bi-book fs-1 text-success"></i>
                        <h5 class="mt-3">လမ်းညွှန်</h5>
                        <p class="text-muted small">ဘယ်လိုရှာဖွေရမလဲ ဆိုတာကို လေ့လာပါ။</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="card shadow-sm p-4 rounded-4">
            <h4 class="fw-bold mb-3">အသုံးဝင်သောအချက်အလက်များ</h4>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-arrow-left-right me-2 text-primary"></i>မှတ်တိုင်တစ်ခုတွင် ရပ်နားသော ဘတ်စ်လိုင်းများကို <a href="{{ url('/bus-stops') }}">မှတ်တိုင်စာမျက်နှာ</a> တွင်ကြည့်ရှုနိုင်ပါသည်။</li>
                <li class="mb-2"><i class="bi bi-link-45deg me-2 text-success"></i>ဘတ်စ်လိုင်းအသေးစိတ်မျက်နှာများတွင် <b>ဆင်တူမှတ်တိုင်များပါဝင်သော လိုင်းများ</b> ကိုပါ ပြသထားပါသည်။</li>
                <li class="mb-2"><i class="bi bi-mic-fill me-2 text-secondary"></i><strong>YGN Transit</strong> တွင် <b>voice search</b> အသုံးပြု၍ ဘတ်စ်လိုင်းများရှာဖွေနိုင်ပါသည်။</li>
            </ul>
        </div>
    </div>

@endsection
