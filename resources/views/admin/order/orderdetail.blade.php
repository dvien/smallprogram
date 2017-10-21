@extends('layouts.admin_common')
@section('right-box')

    <script src="{{ asset('admin/lib/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('admin/lib/ueditor/ueditor.all.min.js') }}"> </script>
    <style>
        table tr{
            margin-top:5px;
        }
    </style>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="height:800px;overflow-y: scroll;padding-bottom:100px;">
        <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">订单详情</h1>

                    <table class="table table-striped table-bordered" style="width:400px;">
                        <tr>
                            <td style="width:120px;">订单号：</td>
                            <td><input type="text" value="{{ $res -> id }}" class="form-control" disabled/></td>
                        </tr>
                        <tr>
                            <td>下单时间：</td>
                            <td><input type="text" value="{{ date('Y-m-d H:i',$res -> created_at) }}" class="form-control" disabled/></td>
                        </tr>
                        <tr>
                            <td>配送方式：</td>
                            <td>
                                <input type="text" class="form-control" disabled value="@if($res -> peisong_type == '1')送货上门@else货物自提@endif"  />
                            </td>
                        </tr>
                        <tr>
                            <td>自提负责人：</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>自提地址：</td>
                            <td><input type="text" class="form-control" disabled value="{{ $res -> address }}"  /></td>
                        </tr>
                        <tr>
                            <td>自提联系电话：</td>
                            <td><input type="text" class="form-control" disabled value="{{ $res -> address }}"  /></td>
                        </tr>
                        <tr>
                            <td>订单金额：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> goods_info -> price_no }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>客户备注：</td>
                            <td><input type="text" class="from-control" disabled value="{{ $res -> remark }}" /></td>
                        </tr>
                        <tr>
                            <td>供应商：</td>
                            <td><input type="text" class="from-control" disabled value="{{ $res -> gongying -> name }}" /></td>
                        </tr>
                        <tr>
                            <td>商品名称：</td>
                            <td><input type="text" class="from-control" disabled value="{{ $res -> goods_info -> title }}" /></td>
                        </tr>
                        <tr>
                            <td>购买单价：</td>
                            <td><input type="text" class="from-control" disabled value="{{ $res -> goods_info -> price_no }}" /></td>
                        </tr>
                        <tr>
                            <td>购买数量：</td>
                            <td><input type="text" class="from-control" disabled value="{{ $res -> number }}" /></td>
                        </tr>
                        <tr>
                            <td>支付账户：</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>是否发货：</td>
                            <td>@if($res -> fahuo_status == 0)未发货@else已发货@endif</td>
                        </tr>
                        <tr>
                            <td>订单状态：</td>
                            <td>@if($res -> fukuan_status == 0)未付款@else已付款@endif</td>
                        </tr>
                        <tr>
                            <td>评价星级：</td>
                            <td>{{ $res -> star }}</td>
                        </tr>
                        <tr>
                            <td>评价内容：</td>
                            <td>{{ $res -> pinglun }}</td>
                        </tr>
                        <tr>
                            <td>退货内容：</td>
                            <td>{{ $res -> tuikuan_content }}</td>
                        </tr>
                    </table>


                    <div><a>评价图片</a></div>
                    <div>
                        @if(!empty($res  -> imgs))
                            @foreach($res  -> imgs as $vo)
                                <img src="{{ asset('images').'/'.$vo }}"  style="width:250px;height:180px;"/>
                            @endforeach
                        @endif
                    </div>

                    <div><a>退货图片</a></div>
                    <div>
                        @if(!empty($res  -> tuikuan_imgs))
                            @foreach($res  -> tuikuan_imgs as $vo)
                                <img src="{{ asset('images').'/'.$vo }}"  style="width:250px;height:180px;"/>
                            @endforeach
                        @endif
                    </div>






                </div>


        </div>
    </div>


@stop