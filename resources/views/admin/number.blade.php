@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
        <h1 class="page-header">@if(isset($type) && $type=='shequ')社区管理员@elseif(isset($type) && $type=='wuye')物业@else后台@endif账户</h1>
        <ol class="breadcrumb">
            <li><a data-toggle="modal" data-target="#addUser">增加用户</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{ count($res) }}</span></h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">用户名</span></th>
                    <th @if(isset($type) && $type == 'wuye') style="display:none;" @endif ><span class="glyphicon glyphicon-bookmark" ></span> <span class="visible-lg">登录次数</span></th>
                    @if(isset($type) && $type == 'wuye')<th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">密码</span></th> @endif
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td>{{$vo['username']}}</td>
                            <td @if(isset($type) && $type == 'wuye') style="display:none;" @endif >{{ $vo['logintime'] }}</td>
                            @if(isset($type) && $type == 'wuye')<td>{{ $vo['password'] }}</td>@endif
                            <td>@if($vo -> status == 0)正常@else禁用@endif</td>
                            <td>{{ date('Y-m-d H:i',$vo['created_at']) }}</td>
                            <td data="{{$vo['id']}}">
                                @if($vo['username'] != 'admin')
                                <a  name="edit"  href="@if(isset($type) && $type == 'shequ'){{ url('admin/shequ_editUser',[ 'id'=>$vo['id'] ]) }}@elseif(isset($type) && $type == 'wuye'){{ url('admin/wuye_editUser',[ 'id'=>$vo['id'] ]) }}@else{{ url('admin/editUser',['id'=>$vo['id']]) }}@endif">修改</a>

                                @if(isset($type) && $type == 'wuye')
                                    @if($vo -> status == 0)<a href="{{ url('admin/changeBusiness',['id'=>$vo -> id,'status' => $vo -> status]) }}">禁用</a>@else<a href="{{ url('admin/changeBusiness',['id'=>$vo -> id,'status' => $vo -> status]) }}" >启用</a>@endif
                                @else
                                    @if($vo -> status == 0)<a href="{{ url('admin/changeUser',['id'=>$vo -> id,'status' => $vo -> status]) }}">禁用</a>@else<a href="{{ url('admin/changeUser',['id'=>$vo -> id,'status' => $vo -> status]) }}" >启用</a>@endif
                                @endif
                                    @endif
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
        $(function () {
            @if (session('isset'))
            alert('用户名重复！');
            $('#addUser').modal('show');
            @endif

            @if (session('show'))
            $('#editUser').modal('show')
            @endif

        $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.parent().attr("data"); //对应id
                if (name.attr("name") === "edit") {

                } else if (name.attr("name") === "delete") {
                    if (window.confirm("此操作不可逆，是否确认？")) {

                        @if(isset($type) && $type == 'wuye')
                        var url = '{{ url('admin/deleteBusiness') }}';
                        @else
                        var url = '{{ url('admin/deleteUser') }}';
                            @endif


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
        });
    </script>

@stop