@extends(request()->ajax() ? 'layouts.ajax' : 'layouts.app')
@section('nav')
    @include('navigation')
@stop
@section('data')
    @include('layouts.alerts')

    @if(!isset($transactions))
        @include('statement.form')
    @else
        @include('statement.transactions')
    @endif

@endsection
@section('js')
    <script>
        datePicker();
        // autoScroll();
    </script>
@endsection