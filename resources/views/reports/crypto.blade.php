@extends( 'layouts.main')
@section('styles')
    <style>
        @page {
            size: landscape !important;
        }
    </style>
@endsection
@section('title')
    {{$report->title}} <a href="{{ route('report') }}" class="btn btn-info float-right">Back</a>
@endsection
@section('content')
    <div class="row mt-3">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        &nbsp;
                    </div>
                    <div class="h1 m-0">{{ currency( (clone $query)->count(),true,0) }}</div>
                    <div class="text-muted mb-4">Trades</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        &nbsp;
                    </div>
                    <div class="h1 m-0">{{ currency( (clone $query)->select('exchange')->distinct()->get()->count(),true,0) }}</div>
                    <div class="text-muted mb-4">Exchanges</div>
                </div>
            </div>
        </div>
    </div>
@endsection