@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">值得看列表</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('admin/addZhide') }}">新增</a>
                <form method="post" style="display:inline-block;" >
                <span style="margin-left:30px;">
                    发布管理员：
                    <select>
                        <option value="">请选择</option>
                        @foreach($managelist as $vo)
                        <option value="{{ $vo -> id }}">{{ $vo -> username }}</option>
                        @endforeach
                    </select>
                    {{ csrf_field() }}
                    <input type="submit" value="搜索" class="btn btn-default" style="padding:0;height:24px;width:40px;" />
                    <input type="button" value="重置" class="btn btn-default" style="padding:0;height:24px;width:40px;" />
                </span>
                </form>
            </li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">@if(!empty($res)){{ count($res) }}@endif</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">标题</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">状态</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">收藏数</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">点赞数</span></th>
                    <th><span class="glyphicon glyphicon-stats"></span> <span class="visible-lg">是否重要</span></th>
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
                            <td>正常</td>
                            <td>{{ $vo->shoucang }}</td>
                            <td>{{ $vo->dianzan }}</td>
                            <td>@if($vo -> ishot == 1)重要@else不重要@endif</td>
                            <td>{{ date('Y-m-d H:i',$vo->created_at) }}</td>
                            <td data="{{$vo->id}}"><a  name="edit"  href="{{ url('admin/editZhide',['id'=>$vo->id]) }}">修改</a> <a name="delete" >删除</a> </td>
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

                        var url = '{{ url('admin/deleteZhide') }}';

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id:id},
                            //dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
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