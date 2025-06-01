@extends('layouts.front')
@section('title', 'ဘတ်စ်မှတ်တိုင်များ')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">ဘတ်စ်မှတ်တိုင်များ</h1>

    <!-- Search Bar -->
    <div class="search-container sticky-top">
        <form class="search-form" role="search" action="{{ url('/bus-stops') }}" method="GET">
            <div class="search-icon-left">
                <i class="bi bi-search"></i>
            </div>
            <input
                class="form-control search-input"
                type="search"
                name="search"
                id="searchInput"
                placeholder="မှတ်တိုင် ရှာဖွေရန်..."
                value="{{ request('search') }}"
                aria-label="Search"
            />
            <div class="search-icon-right" id="micIcon" style="cursor:pointer;">
                <i class="bi bi-mic-fill"></i>
            </div>
        </form>
    </div>

    <div class="row mt-4">
        @forelse ($busStops as $stop)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-geo-alt-fill me-1"></i> {{ $stop->name }}
                        </h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-signpost-2 me-1"></i>
                            {{ $stop->road ?? 'လမ်းအမည်မသိရ' }}
                        </p>
                        <p>
                            @if ($stop->buslines->isEmpty())
                                <span class="text-muted">
                                <i class="bi bi-ban text-danger"></i> ဘတ်စ်ကားလိုင်းမရှိသေးပါ။</span>
                            @else
                                @foreach ($stop->buslines->take(5) as $busline)
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
                                            $class = 'badge-sky';
                                        } elseif (in_array($busline->name, $sunlines)) {
                                            $class = 'badge-sun';
                                        } elseif (in_array($busline->name, $lavendarlines)) {
                                            $class = 'badge-lavendar';
                                        } elseif (in_array($busline->name, $grasslines)) {
                                            $class = 'badge-grass';
                                        } elseif (in_array($busline->name, $cookielines)) {
                                            $class = 'badge-cookie';
                                        } elseif (in_array($busline->name, $nightlines)) {
                                            $class = 'badge-night';
                                        } else {
                                            $class = 'badge-default';
                                        }
                                    @endphp
                                    <span class="badge rounded-pill {{ $class }} me-1">
                                        {{ preg_replace('/\D.*/', '', $busline->name) }}
                                    </span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted mt-5">
                <i class="bi bi-emoji-frown fs-1"></i>
                <p class="mt-3">မှတ်တိုင်များရှာမတွေ့ပါ။ ရှာဖွေရန် အသေးစိတ်အချက်အလက်များကို ပြန်စစ်ပါ။</p>
            </div>
        @endforelse
    </div>

    {{-- pagination --}}
    <div class="mt-4">
    <div class="d-flex justify-content-center pagination-wrapper">
        {{ $busStops->links() }}
    </div>
    <div class="text-center text-muted small">
        Showing {{ $busStops->firstItem() }} to {{ $busStops->lastItem() }} of {{ $busStops->total() }} results
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

    recognition.onerror = () => {
        micIcon.classList.remove('listening');
    };

    recognition.onend = () => {
        micIcon.classList.remove('listening');
    };
});
</script>
@endpush
