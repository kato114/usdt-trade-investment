<div class="row">
    <div class="col-6">
        <span><b>Account NAME :</b> {{$account->accountable->name}}</span><br>
        <span><b>Account NUMBER :</b> {{$account->account_no}}</span><br>
    </div>
    <div class="col-6 right">
        <span><b>Available BALANCE :</b> {{currency($account->balance)}}</span><br>
        <span><b>Statement Period :</b> {{ $from }} - {{ $to }}</span>
    </div>
</div>

<div class="table-div">
    <table class="table">
        <thead>
        <tr>
            <th>SN</th>
            <th>DATE</th>
            <th>TIME</th>
            <th>REF</th>
            <th>NARRATION</th>
            <th>PAYEE</th>
            <th class="right">PAID IN</th>
            <th class="right">PAID OUT</th>
            <th class="right">BALANCE</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $month => $data)
            <tr>
                <th></th>
                <th colspan="8">{{strtoupper($month)}}</th>
            </tr>

            @foreach($data as $t)

                @if($t->type == 'debit')
                    @php @$running -= $t->amount @endphp
                    @php @$debits += $t->amount @endphp
                @else
                    @php @$running += $t->amount @endphp
                    @php @$credits += $t->amount @endphp
                @endif

                <tr>
                    <td>{{ @++$i }}</td>
                    <td>{{ $t->created_at->format('M d, Y') }}</td>
                    <td><i>{{ $t->created_at->format('H:i') }}</i></td>
                    <td>{{ $t->reference }}</td>
                    <td>{{ $t->narration }}</td>
                    <td>{{ $t->payee }}</td>

                    @if($t->type == 'credit')
                        <td class="right">{{ currency($t->amount) }}</td>
                        <td class="right"></td>
                    @else
                        <td class="right"></td>
                        <td class="right">{{ currency($t->amount) }}</td>
                    @endif

                    <td class="right">{{ currency($running) }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="6"></th>
            <th class="right">{{currency(@$credits)}}</th>
            <th class="right">{{currency(@$debits)}}</th>
            <th class="right">{{currency(@$credits - @$debits)}}</th>
        </tr>
        </tfoot>
    </table>
</div>