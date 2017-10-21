@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">行家在线</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/addHangjia') }}">新增行家</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{ $count }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">行家姓名</span></th>
                    <th><span class="glyphicon glyphicon-camera"></span> <span class="visible-lg">行家头像</span></th>
                    <th><span class="glyphicon glyphicon-earphone"></span> <span class="visible-lg">行家手机</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">行家简介</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">行家状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td>{{$vo['name']}}</td>
                            <td><img src="{{ asset('uploads') }}/{{ $vo['img'] }}" style="width:80px;height:100px;" /></td>
                            <td>{{ $vo['tel'] }}</td>
                            <td>{{ mb_substr($vo['content'],0,10,'utf-8') }}</td>
                            <td>@if($vo -> status == 1)无效@else有效@endif</td>
                            <td>{{ date('Y-m-d H:i',$vo['created_at']) }}</td>
                            <td data="{{$vo['id']}}">
                                <a  name="edit"  href="{{ url('admin/editHangjia',['id'=>$vo['id']]) }}">修改</a>

                                @if($vo -> status == 0)
                                    <a class="jinyong">禁用</a>
                                @else
                                    <a class="huifu">恢复</a>

                                @endif</td>
                            </td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">{{ $res -> links() }}</td>
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

            //禁用
            $('.jinyong').click(
                function(){
                    var id =  $(this).parent().attr('data');
                    var url = '{{ url('admin/hangjia/checkstatus') }}'


                    layer.confirm('是否禁用', {
                        btn: ['是','否'] //按钮
                    }, function(){
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id:id,status:1},

                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function(data){
                                alert('已禁用');
                                location.reload();
                            },
                            error: function(xhr, type){
                                alert('Ajax error!')
                            }
                        });


                    }, function(){
                        layer.msg('已取消');
                        //修改用户状态


                    });
                }
            );


            //恢复
            $('.huifu').click(
                function(){
                    var id =  $(this).parent().attr('data');
                    var url = '{{ url('admin/hangjia/checkstatus') }}'


                    layer.confirm('是否恢复', {
                        btn: ['是','否'] //按钮
                    }, function(){

                        //修改用户状态
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id:id,status:0},

                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function(data){
                                alert('已恢复');
                                location.reload();
                            },
                            error: function(xhr, type){
                                alert('Ajax error!')
                            }
                        });

                    }, function(){
                        layer.msg('已取消');


                    });
                }
            );


            $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.parent().attr("data"); //对应id
                if (name.attr("name") === "delete") {
                    if (window.confirm("此操作不可逆，是否确认？")) {

                        var url = '{{ url('admin/deleteHangjia') }}';

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