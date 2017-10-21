@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">轮播图</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/addLunbo') }}">新增</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge"></span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-camera"></span> <span class="visible-lg">轮播图</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">外链地址</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">内链地址</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($res))
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td><img src="{{ asset('uploads') }}/{{ $vo['img'] }}" style="width:100px;height:80px;" /></td>
                            <td>{{ $vo['url_out'] }}</td>
                            <td>{{ $vo['url_in'] }}</td>
                            <td>{{ date('Y-m-d H:i',$vo['created_at']) }}</td>
                            <td data="{{$vo['id']}}"><a  name="edit"  href="{{ url('admin/editLunbo',['id'=>$vo['id']]) }}">修改</a> <a name="delete" >删除</a> </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
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

                        var url = '{{ url('admin/deleteLunbo') }}';

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