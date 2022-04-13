@extends("chitietban")

@section('main')
            <h3 style="text-align: center;">Chọn loại vé:</h3>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Tên vé</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($vebuffet as $v)
                <tr>
                    <form action="{{route('postThemVe')}}" method="POST"> @csrf
                            <input type="hidden" name="mave" value="{{$v['mave']}}">
                        @foreach($banso as $b)
                            <input type="hidden" name="maban" value="{{$b['maban']}}">
                        @endforeach
                        <td>{{ $v['tenve'] }}</td>
                        <td>{{ number_format($v['gia'])}}</td>
                        <td>
                            <div class="buttons_added">
                                <input aria-label="quantity" style="width: 50px;" class="input-qty" min="0" name="soluong" type="number" value="0">
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success" style="font-size: 11px;">Chọn</button>
                        </td>
                    </form>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $vebuffet->links() }}
@endsection