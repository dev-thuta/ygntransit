@extends('layouts.front')
@section('title', 'ဘတ်စ်လိုင်းများ')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">ဘတ်စ်လိုင်းများ</h1>
    <div class="search-container sticky-top">
        <form class="search-form" role="search" action="{{ url('/bus-lines') }}" method="GET">
            <div class="search-icon-left">
                <i class="bi bi-search"></i>
            </div>

            <input
                class="form-control search-input"
                type="search"
                name="search"
                id="searchInput"
                placeholder="ဘတ်စ်ကားလိုင်း ရှာဖွေရန်..."
                value="{{ request('search') }}"
                aria-label="Search"
            />

            <div class="search-icon-right" id="micIcon" style="cursor:pointer;">
                <i class="bi bi-mic-fill"></i>
            </div>
        </form>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            @foreach ($buslines->slice(0, 5) as $busline)
                <div class="d-flex align-items-start gap-3 mt-1 mb-4">
                    @php
                        $skylines = [
                            '1','11','18','20','21','22','23','35','36','37','39',
                            '40','41','42','43','61','65','68','69','74','76','77',
                            '78','79','82','84','85','90','92','93','94','96','98',
                            '99','104','105','106','107','109','115','116','119',
                            '121','122','123','123 Mini','130','131','132','136',
                            '140','141','142','143','145'
                        ];
                        $sunlines = [
                            '2','3','4','5','6','7 (A)','7 (B)','12','13','14','15','16','17','19','24','25','26','27','28','29','30','38','55','59','60 (A)','60 (B)','62','63','64','71','72','75','80','81','86','87','88','89 (A)','89 (B)','97','100','102','103','108','110','111 (A)','111 (B)','112','113','114','117','118','120','126','128','133','134','135','137','138','139','144'
                        ];
                        $lavendarlines = [
                            '8','9 (A)','9 (B)','10','31 (A)','31 (B)','32','33','34','70 (A)','70 (B)','95','129'
                        ];
                        $grasslines = [
                            '44','45','46','47','48','49','50','51','52','53 (A)','53 (B)','66','67','73','91'
                        ];
                        $cookielines = [
                            '56','57','58','83'
                        ];
                        $nightlines = [
                            '101'
                        ];

                        if (in_array($busline->name, $skylines)) {
                            $class = 'sky';
                        } elseif (in_array($busline->name, $sunlines)) {
                            $class = 'sun';
                        } elseif (in_array($busline->name, $lavendarlines)) {
                            $class = 'lavendar';
                        } elseif (in_array($busline->name, $grasslines)) {
                            $class = 'grass';
                        } elseif (in_array($busline->name, $cookielines)) {
                            $class = 'cookie';
                        } elseif (in_array($busline->name, $nightlines)) {
                            $class = 'night';
                        } else {
                            $class = 'default';
                        }
                        $routes = $busline->busroutes->sortBy('position')->values();
                        $startStop = $routes->first()?->busstop?->name;
                        $endStop = $routes->last()?->busstop?->name;
                    @endphp
                    <a href="{{ url('bus-routes?search=' . $busline->name) }}" class="text-decoration-none">
                        <div class="{{ $class }}">
                            {{ preg_replace('/\D.*/', '', $busline->name) }}
                        </div>
                    </a>
                    <div>
                        <h4 class="fw-bold">ဘတ်စ်လိုင်း - {{ $busline->name }}</h4>
                        <p class="text-body-secondary">
                            @if ($startStop && $endStop)
                                <a href="{{ url('bus-stops?search=' . $startStop) }}" class="text-secondary text-decoration-none">{{ $startStop }}</a> – <a href="{{ url('bus-stops?search=' . $startStop) }}" class="text-secondary text-decoration-none">{{ $endStop }}</a>
                            @else
                                <span class="text-muted">လမ်းကြောင်းမရှိသေးပါ</span>
                            @endif
                        </p>
                        <p class="text-body-secondary">
                            @if ($busline->isCardAvailable)
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                            @else
                                <i class="bi bi-ban fs-4 text-danger"></i>
                            @endif
                            <strong class="ms-2">
                                YPS ကဒ်{{ $busline->isCardAvailable ? 'အသုံးပြုနိုင်သည်' : 'အသုံးပြုနိုင်မည်မဟုတ်ပါ' }}။
                            </strong>
                        </p>
                        <a href="{{ url('bus-routes?search=' . $busline->name) }}" class="link-primary text-decoration-none fw-semibold">
                            လမ်းကြောင်းကြည့်ရန်<i class="ms-2 bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="w-75 mx-auto">
                    <hr class="border border-secondary border-1 opacity-50">
                </div>
            @endforeach
        </div>

        <div class="col-md-6">
            @foreach ($buslines->slice(5, 5) as $busline)
                <div class="d-flex align-items-start gap-3 mt-1 mb-4">
                    @php
                        $skylines = [
                            '1','11','18','20','21','22','23','35','36','37','39',
                            '40','41','42','43','61','65','68','69','74','76','77',
                            '78','79','82','84','85','90','92','93','94','96','98',
                            '99','104','105','106','107','109','115','116','119',
                            '121','122','123','123 Mini','130','131','132','136',
                            '140','141','142','143','145'
                        ];
                        $sunlines = [
                            '2','3','4','5','6','7 (A)','7 (B)','12','13','14','15','16','17','19','24','25','26','27','28','29','30','38','55','59','60 (A)','60 (B)','62','63','64','71','72','75','80','81','86','87','88','89 (A)','89 (B)','97','100','102','103','108','110','111 (A)','111 (B)','112','113','114','117','118','120','126','128','133','134','135','137','138','139','144'
                        ];
                        $lavendarlines = [
                            '8','9 (A)','9 (B)','10','31 (A)','31 (B)','32','33','34','70 (A)','70 (B)','95','129'
                        ];
                        $grasslines = [
                            '44','45','46','47','48','49','50','51','52','53 (A)','53 (B)','66','67','73','91'
                        ];
                        $cookielines = [
                            '56','57','58','83'
                        ];
                        $nightlines = [
                            '101'
                        ];

                        if (in_array($busline->name, $skylines)) {
                            $class = 'sky';
                        } elseif (in_array($busline->name, $sunlines)) {
                            $class = 'sun';
                        } elseif (in_array($busline->name, $lavendarlines)) {
                            $class = 'lavendar';
                        } elseif (in_array($busline->name, $grasslines)) {
                            $class = 'grass';
                        } elseif (in_array($busline->name, $cookielines)) {
                            $class = 'cookie';
                        } elseif (in_array($busline->name, $nightlines)) {
                            $class = 'night';
                        } else {
                            $class = 'default';
                        }
                        $routes = $busline->busroutes->sortBy('position')->values();
                        $startStop = $routes->first()?->busstop?->name;
                        $endStop = $routes->last()?->busstop?->name;
                    @endphp
                    <a href="{{ url('bus-routes?search=' . $busline->name) }}" class="text-decoration none">
                        <div class="{{ $class }}">
                            {{ preg_replace('/\D.*/', '', $busline->name) }}
                        </div>
                    </a>
                    <div>
                        <h4 class="fw-bold">ဘတ်စ်လိုင်း - {{ $busline->name }}</h4>
                        <p class="text-body-secondary">
                            @if ($startStop && $endStop)
                                <a href="{{ url('bus-stops?search=' . $startStop) }}" class="text-secondary text-decoration-none">{{ $startStop }}</a> – <a href="{{ url('bus-stops?search=' . $startStop) }}" class="text-secondary text-decoration-none">{{ $endStop }}</a>
                            @else
                                <span class="text-muted">လမ်းကြောင်းမရှိသေးပါ</span>
                            @endif
                        </p>
                        <p class="text-body-secondary">
                            @if ($busline->isCardAvailable)
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                            @else
                                <i class="bi bi-ban fs-4 text-danger"></i>
                            @endif
                            <strong class="ms-2">
                                YPS ကဒ်{{ $busline->isCardAvailable ? 'အသုံးပြုနိုင်သည်' : 'အသုံးပြုနိုင်မည်မဟုတ်ပါ' }}။
                            </strong>
                        </p>
                        <a href="{{ url('bus-routes?search=' . $busline->name) }}" class="link-primary text-decoration-none fw-semibold">
                            လမ်းကြောင်းကြည့်ရန်<i class="ms-2 bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="w-75 mx-auto">
                    <hr class="border border-secondary border-1 opacity-50">
                </div>
            @endforeach
        </div>
    </div>
    @if($buslines->isEmpty())
        <div class="col-12 text-center text-muted mt-5">
            <i class="bi bi-emoji-frown fs-1"></i>
            <p class="mt-3">ဘတ်စ်လိုင်းများမတွေ့ပါ။ ရှာဖွေရန် အသေးစိတ်အချက်အလက်များကို ပြန်စစ်ပါ။</p>
        </div>
    @endif

    {{-- pagination --}}
    <div class="mt-4">
    <div class="d-flex justify-content-center pagination-wrapper">
        {{ $buslines->links() }}
    </div>
    <div class="text-center text-muted small">
        Showing {{ $buslines->firstItem() }} to {{ $buslines->lastItem() }} of {{ $buslines->total() }} results
    </div>
</div>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const micIcon = document.getElementById('micIcon');
    const searchInput = document.getElementById('searchInput');

    if (!('webkitSpeechRecognition' in window)) {
        micIcon.style.display = 'none';
        return;
    }

    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'my-MM';
    recognition.continuous = false;
    recognition.interimResults = false;

    micIcon.addEventListener('click', () => {
        recognition.start();
        micIcon.classList.add('listening');
    });

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript;
        searchInput.value = transcript;

        searchInput.form.submit();
    };

    recognition.onerror = (event) => {
        micIcon.classList.remove('listening');
    };

    recognition.onend = () => {
        micIcon.classList.remove('listening');
    };
});
</script>
@endpush