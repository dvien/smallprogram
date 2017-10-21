@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">投票列表</h1>
        <ol class="breadcrumb">
            <li><a data-toggle="modal" href="{{ url('admin/addtoupiao') }}">新增投票</a></li>
            <li><a data-toggle="modal" href="{{ url('admin/exportExcel') }}">导出投票结果</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge"></span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th> <span class="visible-lg">ID</span></th>
                    <th> <span class="visible-lg">投票名称</span></th>
                    <th> <span class="visible-lg">投票类型</span></th>
                    <th> <span class="visible-lg">投票人数</span></th>
                    <th style="width:200px;"><span class="visible-lg">可投票身份</span></th>
                    <th><span class="visible-lg">创建时间</span></th>
                    <th><span class="visible-lg">投票状态</span></th>
                    <th><span class="visible-lg">是否重要</span></th>
                    <th><span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td>{{$vo['title']}}</td>
                            <td>@if($vo['type'] == 0)投票@else报名@endif</td>
                            <td>{{$vo['number']}}</td>
                            <td>{{$vo['shenfen']}}</td>
                            <td>{{ date('Y-m-d H:i',$vo['created_at']) }}</td>
                            <td>@if($vo['status'] == 0)开启@else关闭@endif</td>
                            <td>@if($vo['ishot'] == 0)不重要@else重要@endif</td>

                            <td data="{{$vo['id']}}"><a href="{{ url('admin/toupiaoRes').'/'.$vo['id'] }}">查看结果 </a> @if($vo['status'] == 0)<a  href="{{ url('admin/toupiao/close',['id'=>$vo['id']]) }}" >关闭投票</a>@else<a  href="{{ url('admin/toupiao/open',['id'=>$vo['id']]) }}" >开启投票</a>@endif </td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="9"></td>
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