@extends("chitietban")

@section('main')
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Tên món ăn</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mon269 as $m)
            <tr>
                <td>{{ $m['tenmon'] }}</td>
                <td>{{ number_format($m['gia']) }} VNĐ</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection