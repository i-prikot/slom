@php
    $token = config('seo.mcn_tracker_token');
@endphp

@if (is_string($token) && $token !== '')
    <script src="https://calltracking.mcn.ru/widget/mcn-tracker-widget.tsx"></script>
    <script>
        mcnTrackerWidget.initWidget({ token: @json($token) });
    </script>
@endif
