<form method="get" action="">
    <div class="forms">
        <label class="col-4"></label>
        <div class="col-6">
            <h3>Date Range</h3>
        </div>
    </div>
    <div class="forms">
        <label class="col-4">From Date</label>
        <div class="col-6">
            <input name="from" class="date-picker" required readonly
                   value="@if(old('from')!==null) {{old('from')}} @else{{now()->subMonth()->format('M d, Y')}}@endif">
        </div>
    </div>
    <div class="forms">
        <label class="col-4">To Date</label>
        <div class="col-6">
            <input name="to" class="date-picker" required readonly
                   value="@if(old('to')!==null) {{old('to')}} @else{{now()->format('M d, Y')}}@endif">
        </div>
    </div>
    <div class="forms">
        <label class="col-4"></label>
        <div class="col-6">
            <button type="submit">Submit</button>
        </div>
    </div>
</form>