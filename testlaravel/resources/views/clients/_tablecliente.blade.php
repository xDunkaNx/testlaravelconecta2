<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">segmentation_id</th>
            <th scope="col">program_id</th>
            <th scope="col">user_id</th>
            <th scope="col">netcommerce_id</th>
            <th scope="col">one_signal_player_id</th>
            <th scope="col">identification_type_id</th>
            <th scope="col">identification_number</th>
            <th scope="col">mobile_number</th>
            <th scope="col">meta</th>
            <th scope="col">insitu_code_reference</th>
            <th scope="col">birth_date</th>
            <th scope="col">active</th>
            <th scope="col">has_updated_info</th>
            <th scope="col">inactivate_reason</th>
            <th scope="col">account_lockout_date</th>
            <th scope="col">state_user_id</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
            @foreach($data as $cliente)
            <tr>
                <td>{{$cliente['id']}}</td>
                <td>{{$cliente['segmentation_id']}}</td>
                <td>{{$cliente['program_id']}}</td>
                <td>{{$cliente['user_id']}}</td>
                <td>{{$cliente['netcommerce_id']}}</td>
                <td>{{$cliente['one_signal_player_id']}}</td>
                <td>{{$cliente['identification_type_id']}}</td>
                <td>{{$cliente['identification_number']}}</td>
                <td>{{$cliente['mobile_number']}}</td>
                <td>{{$cliente['meta']}}</td>
                <td>{{$cliente['insitu_code_reference']}}</td>
                <td>{{$cliente['birth_date']}}</td>
                <td>{{$cliente['active']}}</td>
                <td>{{$cliente['has_updated_info']}}</td>
                <td>{{$cliente['inactivate_reason']}}</td>
                <td>{{$cliente['account_lockout_date']}}</td>
                <td>{{$cliente['state_user_id']}}</td>
                <td>{{$cliente['created_at']}}</td>
                <td>{{$cliente['updated_at']}}</td>
                <td><a href="{{route('transaction', ['client_id' => $cliente['id']])}}" ><button>ver transacciones</button></a></td>
            </tr>
            @endforeach        
    </tbody>
</table>
<div class="d-flex justify-content-end divPaginator">
{!! $data->appends(request()->query())->links() !!}
</div>