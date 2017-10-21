@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">商品列表</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/addGoods') }}">新增商品</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">@if(!empty($res)){{ count($res) }}@endif</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">商品名称</span></th>
                    <th><span class="glyphicon glyphicon-camera"></span> <span class="visible-lg">商品主图</span></th>
                    <th><span class="glyphicon glyphicon-earphone"></span> <span class="visible-lg">商品价格</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">销量</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">总评价星级</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($res))
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo->id}}</td>
                            <td>{{$vo->title}}</td>
                            <td><img src="{{ asset('uploads') }}/{{ $vo->img }}" style="width:80px;height:100px;" /></td>
                            <td>{{ $vo->price_no }}</td>
                            <td>{{ $vo->number }}</td>
                            <td>{{ $vo->star }}</td>
                            <td>@if($vo -> status == 0)有效@else无效@endif</td>
                            <td>{{ date('Y-m-d H:i',$vo->created_at) }}</td>
                            <td data="{{$vo->id}}"><a  name="edit"  href="{{ url('admin/editGoods',['id'=>$vo->id]) }}">修改</a>  @if($vo -> status == 0)<a href="{{ url('admin/changeGoods',['id'=>$vo -> id,'status' => $vo -> status]) }}">禁用</a>@else<a href="{{ url('admin/changeGoods',['id'=>$vo -> id,'status' => $vo -> status]) }}" >启用</a>@endif </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">@if(!empty($res)){{ $res -> links() }}@endif</td>
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
            $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.parent().attr("data"); //对应id
                if (name.attr("name") === "delete") {
                    if (window.confirm("此操作不可逆，是否确认？")) {

                        var url = '{{ url('admin/deleteGoods') }}';

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