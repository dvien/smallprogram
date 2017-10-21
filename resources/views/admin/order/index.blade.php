@extends('layouts.admin_common')
@section('right-box')
    <style>
        #mytable tr td{
            border:1px solid #000000;
        }
    </style>
    <script src="{{ asset('js/laydate/laydate.js') }}"></script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">订单列表</h1>
        <form method="post">
        <table class="table">
            <tr>
                <td>订单号：</td>
                <td>
                    <input type="text" name="orderid"  class="form-control" value="@if(!empty($_POST['orderid'])){{ $_POST['orderid'] }}@endif"/>
                </td>

                <td>收货人姓名</td>
                <td>
                    <input type="text" name="ordername"  class="form-control" value="@if(!empty($_POST['ordername'])){{ $_POST['ordername'] }}@endif" />
                </td>

                <td>配送方式</td>
                <td>
                    <select name="peisong">
                        <option value="0">货物自提</option>
                        <option value="1">送货上门</option>
                    </select>
                </td>

                <td>发货状态</td>
                <td>
                    <select name="status">
                        <option value="0">待收货</option>
                        <option value="1">待评价</option>
                        <option value="2">已完成</option>
                        <option value="3">退货／退款</option>
                    </select>
                </td>



            </tr>
            <tr>
                <td>售后状态</td>
                <td>
                    <select name="shouhou">
                        <option value="">请售后</option>
                        <option value="1">申请售后</option>
                        <option value="0">未售后</option>
                    </select>
                </td>
                <td>订单起始时间</td>
                <td>
                    <input type="text" name="createtime_left"  value="@if(!empty($_POST['createtime_left'])){{ $_POST['createtime_left'] }}@endif" class="form-control" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"/>
                </td>
                <td>订单截止时间</td>
                <td>
                    <input type="text" name="createtime_right"  value="@if(!empty($_POST['createtime_right'])){{ $_POST['createtime_right'] }}@endif" class="form-control" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"/>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <button class="btn btn-default" type="submit">搜索</button>
                    <button class="btn btn-default" type="button" onclick="location.href='{{Request::getRequestUri()}}' ">重置</button>
                    <button class="btn btn-default" type="button">导出</button>
                </td>
            </tr>
        </table>
            {{ csrf_field() }}
        </form>

            <!--
            <li><a data-toggle="modal" href="{{ url('admin/addtoupiao') }}">新增投票</a></li>
            -->

        <h1 class="page-header">管理 <span class="badge"></span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" id="mytable">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">订单编号</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">商品名称</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">购买人</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">购买数量</span></th>
                    <th><span class="glyphicon glyphicon-camera"></span> <span class="visible-lg">购买地址</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">付款状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">发货状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">售后状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">配送方式</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo -> id }}</td>
                            <td>{{$vo -> order_id }}</td>
                            <td>{{$vo -> goods_info -> title }}</td>
                            <td>{{$vo -> user_info -> name }}</td>
                            <td>{{$vo -> number}}</td>
                            <td>{{$vo -> address}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td>@if($vo -> fukuan_status == 0)未付款@else已付款@endif</td>
                            <td>@if($vo -> fahuo_status == 0)未发货@else已发货@endif</td>
                            <td>@if($vo -> shouhou_status == 0)未售后@else已售后@endif</td>
                            <td>@if($vo -> peisong_type == 0)货物自提@else送货上门@endif</td>
                            <td data="{{$vo -> id}}">@if($vo -> fukuan_status == 1 && $vo -> fahuo_status == 0 )<a  name="edit"  href="{{ url('admin/fahuo').'/'.$vo -> id }}">发货</a>@endif <a href="{{ url('admin/orderDetail',['id'=>$vo -> id ]) }}" >详情</a> </td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="12">{{ $res -> links() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



    <script>
        @if (session('insertres'))
            alert('添加成功！');
        @endif
        @if (session('editres'))
            alert('修改成功！');
        @endif

    </script>
    <script>
        $(function(){
            @if (session('show'))
                $('#editShequ').modal('show')
            @endif

            //数据验证
            $('#myAddShequForm').submit(function(){

                if($.trim($('#myAddShequForm input[name=password]').val()) && $.trim($('#myAddShequForm input[name=password]').val()) != $.trim($('#myAddShequForm input[name=new_password]').val())){
                    alert('两次填写密码不一致');return false;
                }
            })
            $('#myEditShequForm').submit(function(){

                if($.trim($('#myEditShequForm input[name=password]').val()) != $.trim($('#myEditShequForm input[name=new_password]').val())){
                    alert('两次填写密码不一致');return false;
                }
            })

            $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.parent().attr("data"); //对应id
                if (name.attr("name") === "delete") {
                    if (window.confirm("此操作不可逆，是否确认？")) {

                        var url = '{{ url('admin/deleteShequ') }}';

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id:id},
                            //dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data){
                                if(data == 'success'){
                                    alert('删除成功');
                                    location.reload();
                                }
                            },
                            error: function(xhr, type){
                                alert('Ajax error!')
                            }
                        });
                    };
                };
            });
        })
    </script>
@stop