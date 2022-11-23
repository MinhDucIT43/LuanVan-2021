@extends("chitietban")

@section('main')
    <h4 style="display: inline;"><b>Thêm vé:</b></h4>
    <b style="font-size: 20px;"><label id='errorsoluong'></label></b>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th style="width: 3px;">STT</th>
                <th style="width: 350px;">Tên vé</th>
                <th style="width: 159px;">Giá</th>
                <th>Số lượng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($vebuffet as $v)
            <form action="{{route('postThemVe')}}" method="post" enctype="multipart/form-data"> @csrf
                <tr>
                    <input type="hidden" name="mave" value="{{$v['mave']}}">
                    @foreach($banso as $b)
                    <input type="hidden" name="maban" value="{{$b['maban']}}">
                    @endforeach
                    <td align="center">{{++$i}}</td>
                    <td>
                        <input type="hidden" id="mucve" name="mucve" value="{{ $v['mave'] }}" /><b>{{ $v['tenve'] }}</b>
                    </td>
                    <td>{{ number_format($v['gia'])}}</td>
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
            @foreach($vetreem as $vte)
            <form action="{{route('postThemMon')}}" method="post" enctype="multipart/form-data"> @csrf
                <tr>
                    <input type="hidden" name="mamon" value="{{$vte['mamon']}}">
                    @foreach($vebuffet as $v)
                    <input type="hidden" name="mave" value="{{$v['mave']}}">
                    @endforeach
                    @foreach($banso as $b)
                    <input type="hidden" name="maban" value="{{$b['maban']}}">
                    @endforeach
                    <td align="center">{{++$i}}</td>
                    <td><b>{{ $vte['tenmon'] }}</b></td>
                    <td>{{ number_format($vte['gia'])}}</td>
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
    <h4 style="display: inline;"><b>Vui lòng chọn món ăn:</b></h4>
    <b style="font-size: 20px;"><label id='errorsoluongmon'></label></b>
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-primary">
            <tr>
                <th style="width: 3px;">STT</th>
                <th>Tên món ăn</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($listmon as $m)
            <form action="{{route('postThemMon')}}" method="post" enctype="multipart/form-data"> @csrf
                <tr>
                    <input type="hidden" name="mamon" value="{{$m['mamon']}}">
                    @foreach($vebuffet as $v)
                        <input type="hidden" name="mave" value="{{$v['mave']}}">
                    @endforeach
                    @foreach($banso as $b)
                    <input type="hidden" name="maban" value="{{$b['maban']}}">
                    @endforeach
                    <td align="center">{{++$i-2}}</td>
                    <td><strong>{{ $m['tenmon'] }}</strong></td>
                    <td>{{ number_format($m['gia']) }} VNĐ</td>
                    <td>
                        <div class="buttons_added">
                            <input aria-label="quantity" style="width: 50px;" class="input-qty" min="0" id="soluong" name="soluong" type="number" value="0">
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success" onclick="return kiemtrasoluongmon(soluong)" style="font-size: 11px;">Chọn</button>
                    </td>
                </tr>
            </form>
            @endforeach
        </tbody>
    </table>
@endsection