@extends("chitietban")

@section('main')
            <h3><b>Vui lòng chọn giá vé:</b></h3>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th>Tên vé</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($vebuffet as $v)
                <form action="{{route('postThemVe')}}" method="post" enctype="multipart/form-data"> @csrf
                    <tr>
                    <input type="hidden" {{date_default_timezone_set("Asia/Ho_Chi_Minh")}}>
                        <input type="hidden" name="mave" value="{{$v['mave']}}">
                        <input type="hidden" name="giovao" value="{{date('Y/m/d h:i:s')}}">
                        @foreach($banso as $b)
                            <input type="hidden" name="maban" value="{{$b['maban']}}">
                        @endforeach
                        <td align="center">{{++$i}}</td>
                        <td>
                            <input type="hidden" id="mucve" name="mucve" value="{{ $v['mave'] }}"/><b>{{ $v['tenve'] }}</b>
                        </td>
                        <td><b>{{ number_format($v['gia'])}}</b></td>
                        <td>
                            <div class="buttons_added">
                                <input aria-label="quantity" style="width: 50px;" class="input-qty" min="0" id="soluong" name="soluong" type="number" value="0">
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success" onclick="return kiemtrasoluong(soluong)" style="font-size: 11px;">Chọn</button>
                        </td>
                    </tr>
                </form>
                @endforeach
                </tbody>
            </table>
            <b style="font-size: 20px;"><label id='errorsoluong'></label></b>
            {{ $vebuffet->links() }}
@endsection