@extends('layouts.front')
@section('title', 'လမ်းညွှန်')
@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow rounded-4 p-4 guide-page-content">
                <h2 class="fw-bold mb-4 text-center">မြို့တွင်းဘတ်စ်ကားရှာဖွေခြင်း လမ်းညွှန်</h2>

                <p class="lead text-center">
                    မြို့တွင်းသွားလာရေးအတွက် ဘတ်စ်ကားလိုင်းများနှင့် မှတ်တိုင်များကို <strong>YGN Transit Website</strong> အသုံးပြု၍ အလွယ်တကူရှာဖွေနိုင်စေရန်ရည်ရွယ်ပါသည်။
                </p>

                <hr class="my-4">

                <h4 class="fw-semibold">ဘတ်စ်လမ်းကြောင်း ရှာဖွေနည်း</h4>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><i class="bi bi-search me-2 text-secondary"></i>
                        <a href="{{ url('/bus-routes') }}" class="text-decoration-none text-dark fw-bold">လမ်းကြောင်း</a> စာမျက်နှာရှိ <b>ရှာဖွေရန်</b> ထဲသို့ သင်သိလိုသော ဘတ်စ်လိုင်းနံပါတ်
                        (ဥပမာ - "<b>၂၂</b>") ကို ရိုက်ထည့်ပါ။
                    </li>
                    <li class="mb-2"><i class="bi bi-signpost-2-fill me-2 text-success"></i>
                        <b>မြို့နာမည်</b>၊ <b>လမ်းနာမည်</b>၊ <b>မှတ်တိုင်အမည်</b> ဖြင့်လည်းရှာဖွေနိုင်ပါသည်
                    </li>
                    <li class="mb-2"><i class="bi bi-mic-fill me-2 text-secondary"></i>
                        <b>Chrome</b>/ <b>Microsoft Edge</b> browser အသုံးပြုသူများသည် <b>voice search</b> ကိုအသုံးပြု၍ ကားနံပါတ်များအားရှာဖွေနိုင်ပါသည်။
                    </li>
                </ul>

                <hr class="my-4">

                <h4 class="fw-semibold">သိထားသင့်သောအချက်များ</h4>
                <ul class="list-unstyled mt-2">
                    <li class="mb-2"><i class="bi bi-lightbulb-fill text-warning me-2"></i>
                        <strong>YGN Transit Website</strong> အားအသုံးပြုနိုင်ရန် <b>Internet access</b> or <b>WiFi</b> ရှိရန်လိုအပ်ပါသည်။
                    </li>
                    <li class="mb-2"><i class="bi bi-mic-mute-fill text-secondary me-2"></i>
                        တစ်ချို့သောမြန်မာအက္ခရာနှင့် အသံထွက်များအား <b>voice search</b> အသုံးပြု၍ရှာဖွေမှုမပြုလုပ်နိုင်ပါ။ သို့သော် ဘတ်စ်လိုင်းနံပါတ်များအား မြန်မာလိုကောင်းစွာရှာဖွေနိုင်မည်ဖြစ်သည်
                    </li>
                    <li class="mb-2"><i class="bi bi-info-circle-fill text-danger me-2"></i>
                        ဘတ်စ်ကားလိုင်းများနှင့် သက်ဆိုင်ရာ အချက်အလက်များသည် အချိန်နှင့်အမျှ ပြောင်းလဲနိုင်ပါသည်။
                    </li>
                </ul>

                <div class="text-center mt-5">
                    <p>
                        <small class="text-muted">ဤလမ်းညွှန်သည် သင့်ခရီးစဉ်များကို ပိုမိုလွယ်ကူအဆင်ပြေစေရန် ကူညီနိုင်လိမ့်မည်ဟု မျှော်လင့်ပါသည်။</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
