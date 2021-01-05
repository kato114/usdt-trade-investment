<div class="card">
    <div class="card-header">
        <p class="card-title">
            Showing Daily Profits
        </p>
    </div>
{{--    <div class="m-3">--}}
{{--        <div class="btn-group float-right">--}}
{{--            <a href="?type=daily&action=history" class="btn btn-secondary {{ request('type','daily') =='daily'? 'active' :'' }}">Daily</a>--}}
{{--            <a href="?type=weekly&action=history" class="btn btn-secondary  {{ request('type','daily') =='weekly'? 'active' :'' }}">Weekly</a>--}}
{{--            <a href="?type=monthly&action=history" class="btn btn-secondary  {{ request('type','daily') =='monthly'? 'active' :'' }}">Monthly</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="my-4">
        @include('client.line_chart',['account' => $client])
    </div>
</div>
