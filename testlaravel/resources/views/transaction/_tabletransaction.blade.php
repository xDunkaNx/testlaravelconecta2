<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">client_id</th>
            <th scope="col">segmentation_id</th>
            <th scope="col">transaction_type_id</th>
            <th scope="col">transaction_status_id</th>
            <th scope="col">transaction_currency_id</th>
            <th scope="col">transaction_source_id</th>
            <th scope="col">year</th>
            <th scope="col">month</th>
            <th scope="col">amount</th>
            <th scope="col">savings_expiration_date</th>
            <th scope="col">transaction_detail</th>
            <th scope="col">created_by</th>
            <th scope="col">created_at</th>
        </tr>
    </thead>
    <tbody>
            @foreach($dataTransaction as $transaction)
            <tr>
                <td>{{$transaction['id']}}</td>
                <td>{{$transaction['client_id']}}</td>
                <td>{{$transaction['segmentation_id']}}</td>
                <td>{{$transaction['transaction_type_id']}}</td>
                <td>{{$transaction['transaction_status_id']}}</td>
                <td>{{$transaction['transaction_currency_id']}}</td>
                <td>{{$transaction['transaction_source_id']}}</td>
                <td>{{$transaction['year']}}</td>
                <td>{{$transaction['month']}}</td>
                <td>{{$transaction['amount']}}</td>
                <td>{{$transaction['savings_expiration_date']}}</td>
                <td>{{$transaction['transaction_detail']}}</td>
                <td>{{$transaction['created_by']}}</td>
                <td>{{$transaction['created_at']}}</td>
            </tr>
            @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-end divPaginator">
    {!! $dataTransaction->appends(request()->query())->links() !!}
</div>