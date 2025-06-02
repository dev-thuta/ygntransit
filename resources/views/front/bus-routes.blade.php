@extends('layouts.front')
@section('title', 'ဘတ်စ်လမ်းကြောင်းများ')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">ဘတ်စ်လမ်းကြောင်းများ</h1>

    <div class="search-container sticky-top mb-4">
        <form class="search-form" role="search" action="{{ url('/bus-routes') }}" method="GET">
            <div class="search-icon-left">
                <i class="bi bi-search"></i>
            </div>
            <input
                class="form-control search-input"
                type="search"
                name="search"
                id="searchInput"
                placeholder="ဘတ်စ်/မှတ်တိုင်ဖြင့် ရှာဖွေရန်..."
                value="{{ old('search', $search) }}"
                aria-label="Search"
            />
            <div class="search-icon-right" id="micIcon" style="cursor:pointer;">
                <i class="bi bi-mic-fill"></i>
            </div>
        </form>
    </div>

    @if($search)
        @if($busLines && $busLines->count())
            @foreach($busLines as $busLine)
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

                    if (in_array($busLine->name, $skylines)) {
                        $badgeClass = 'badge-sky';
                    } elseif (in_array($busLine->name, $sunlines)) {
                        $badgeClass = 'badge-sun';
                    } elseif (in_array($busLine->name, $lavendarlines)) {
                        $badgeClass = 'badge-lavendar';
                    } elseif (in_array($busLine->name, $grasslines)) {
                        $badgeClass = 'badge-grass';
                    } elseif (in_array($busLine->name, $cookielines)) {
                        $badgeClass = 'badge-cookie';
                    } elseif (in_array($busLine->name, $nightlines)) {
                        $badgeClass = 'badge-night';
                    } else {
                        $badgeClass = 'badge-default';
                    }
                @endphp
                <div class="card mb-4 p-4 shadow rounded">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="{{ $badgeClass }}" style="height: 3rem; width: 3rem">
                                {{ preg_replace('/\D.*/', '', $busLine->name) }}
                            </div>
                            <h4 class="mb-0 fw-bold">ဘတ်စ်လိုင်း {{ $busLine->name }}</h4>
                        </div>
                        <p>
                            @if ($busLine->isCardAvailable)
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                            @else
                                <i class="bi bi-ban fs-4 text-danger"></i>
                            @endif
                            <strong class="ms-2">
                                YPS ကဒ်{{ $busLine->isCardAvailable ? 'အသုံးပြုနိုင်သည်' : 'အသုံးပြုနိုင်မည်မဟုတ်ပါ' }}။
                            </strong>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-4">
                            <ul class="list-unstyled ps-md-5 mb-0">
                                @php
                                    $sortedRoutes = $busLine->busroutes->sortBy('stop_order')->values();
                                @endphp

                                @if ($sortedRoutes->count() > 1)
                                    @foreach($sortedRoutes as $index => $route)
                                        @php
                                            $currentStop = $route->busstop;
                                            $nextStop = $sortedRoutes->get($index + 1)?->busstop;
                                            $routeDotClass = match (true) {
                                                in_array($busLine->name, $skylines ?? []) => 'dot-sky',
                                                in_array($busLine->name, $sunlines ?? []) => 'dot-sun',
                                                in_array($busLine->name, $lavendarlines ?? []) => 'dot-lavendar',
                                                in_array($busLine->name, $grasslines ?? []) => 'dot-grass',
                                                in_array($busLine->name, $cookielines ?? []) => 'dot-cookie',
                                                in_array($busLine->name, $nightlines ?? []) => 'dot-night',
                                                default => 'dot-default',
                                            };
                                        @endphp
                                        @if ($nextStop)
                                            <li class="mb-3 position-relative">
                                                <div class="route-label d-flex align-items-center">
                                                    <span class="route-dot {{ $routeDotClass }}"></span>
                                                    <strong class="d-block mb-2"><a href="{{ url('bus-stops?search=' . $currentStop->name) }}" class="text-decoration-none text-dark">{{ $currentStop->name }}</a> - <a href="{{ url('bus-stops?search=' . $nextStop->name) }}" class="text-decoration-none text-dark">{{ $nextStop->name }}</a></strong>
                                                </div>
                                                <small class="text-muted"><a href="{{ url('bus-stops?search=' . $currentStop->road) }}" class="text-secondary text-decoration-none">{{ $currentStop->road }}</a> → </small><a href="{{ url('bus-stops?search=' . $nextStop->road) }}" class="text-secondary text-decoration-none">{{ $nextStop->road }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    <i class="bi bi-ban text-danger me-1"></i>ဤဘတ်စ်လိုင်းအတွက် လမ်းကြောင်းအချက်အလက်များ မရှိသေးပါ။</span>
                                @endif
                            </ul>
                        </div>

                        @if($busLine->alternative_lines && $busLine->alternative_lines->isNotEmpty())
                            <div class="col-12 col-lg-6 d-flex align-items-start justify-content-start">
                                <div>
                                    <h6 class="fw-bold text-center mb-3">တူညီသောမှတ်တိုင်များပါဝင်သော လိုင်းများ:</h6>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        @foreach($busLine->alternative_lines as $alt)
                                            @php
                                                $altName = $alt->name;
                                                $currentAltBadgeClass = 'badge ';
                                                if (in_array($altName, $skylines ?? [])) {
                                                    $currentAltBadgeClass .= 'badge-sky';
                                                } elseif (in_array($altName, $sunlines ?? [])) {
                                                    $currentAltBadgeClass .= 'badge-sun';
                                                } elseif (in_array($altName, $lavendarlines ?? [])) {
                                                    $currentAltBadgeClass .= 'badge-lavendar';
                                                } elseif (in_array($altName, $grasslines ?? [])) {
                                                    $currentAltBadgeClass .= 'badge-grass';
                                                } elseif (in_array($altName, $cookielines ?? [])) {
                                                    $currentAltBadgeClass .= 'badge-cookie';
                                                } elseif (in_array($altName, $nightlines ?? [])) {
                                                    $currentAltBadgeClass .= 'badge-night';
                                                } else {
                                                    $currentAltBadgeClass .= 'badge-default';
                                                }
                                            @endphp
                                            <span class="{{ trim($currentAltBadgeClass) }} m-1 p-2 d-inline-flex justify-content-center align-items-center"
                                                style="height: 2.2rem; width: 2.2rem;">
                                                {{ preg_replace('/\D.*/', '', $altName) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted text-end mt-4 mb-0 small">
                                နောက်ဆုံးပြင်ဆင်ချိန်: {{ $busLine->updated_at->format('Y-M-d h:i a') }}
                            </p>
                        @else
                        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center mb-5">
                            <span class="text-muted text-center">
                                <i class="bi bi-ban text-danger me-1"></i>ဤဘတ်စ်လိုင်းနှင့် တူညီသောမှတ်တိုင်များပါဝင်သောအခြားဘတ်စ်လိုင်းများ မတွေ့ပါ။
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center pagination-wrapper">
                {{ $busLines->links() }}
            </div>
            <div class="text-center text-muted small mt-2">
                Showing {{ $busLines->firstItem() }} to {{ $busLines->lastItem() }} of {{ $busLines->total() }} bus lines
            </div>
        @else
            <div class="col-12 text-center text-muted mt-5">
                <i class="bi bi-emoji-frown fs-1"></i>
                <p class="mt-3">"{{ $search }}" ကို ရှာမတွေ့ပါ။ ရှာဖွေရန် အသေးစိတ်အချက်အလက်များကို ပြန်စစ်ပါ။</p>
            </div>
        @endif
    @else
        <p class="text-center text-muted">
            ဘတ်စ်လမ်းကြောင်းများ ရှာဖွေရန် ဘတ်စ်လိုင်းနံပါတ် (သို့မဟုတ်) မှတ်တိုင်နာမည်ရိုက်ထည့်ပါ။
        </p>
    @endif
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

    recognition.onerror = () => {
        micIcon.classList.remove('listening');
    };

    recognition.onend = () => {
        micIcon.classList.remove('listening');
    };
});
</script>
@endpush
