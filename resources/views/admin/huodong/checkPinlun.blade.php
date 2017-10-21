@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >


        <h1 class="page-header">评论 <span class="badge">{{ count($res) }}</span></h1>
        <ol class="breadcrumb">
            <li><a onclick="history.go(-1)">返回</a></li>
        </ol>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">发布人</span></th>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">头像</span></th>

                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">评论</span></th>

                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">发布时间</span></th>

                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>

                <tbody>

                @if(!empty($res))
                    @foreach($res as $vo)
                        <tr>
                            <td>{{ $vo -> id }}</td>
                            <td>{{$vo -> userinfo -> name}}</td>
                            <td><img src="{{ $vo -> userinfo -> img }}" style="width:80px;height:80px;" /></td>
                            <td>{{$vo -> content}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td data="{{$vo -> id}}">
                                @if($vo -> flag == 0)
                                    <a href="{{ url('admin/pinlun/check').'/'.$vo->id.'/1/'.$vo -> news_id }}">隐藏</a>
                                    @else
                                    <a href="{{ url('admin/pinlun/check').'/'.$vo->id.'/0/'.$vo -> news_id }}">显示</a>
                                @endif
                            </td>
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