@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">供应商列表</h1>
        <ol class="breadcrumb">
            <li><a data-toggle="modal" data-target="#add">新增供应商</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{ $count }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">供应商名称</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($res))
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo->id}}</td>
                            <td>{{$vo->name}}</td>
                            <td>@if($vo -> status == 0)有效@else无效@endif</td>
                            <td>{{ date('Y-m-d H:i',$vo->created_at) }}</td>
                            <td data="{{$vo->id}}"><a  name="edit"  href="{{ url('admin/editGongyingshang',['id'=>$vo->id]) }}">修改</a> @if($vo -> status == 0)<a href="{{ url('admin/changeGongyingshang',['id'=>$vo -> id,'status' => $vo -> status]) }}">禁用</a>@else<a href="{{ url('admin/changeGongyingshang',['id'=>$vo -> id,'status' => $vo -> status]) }}" >启用</a>@endif</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">{{ $res -> links() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--增加社区模态框-->
    <div class="modal fade " id="add" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="{{ url('admin/addGongyingshangRes') }}" method="post" autocomplete="off" draggable="false" id="myAddShequForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >增加供应商</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td wdith="30%">名称:</td>
                                <td width="70%"><input type="text" value="" class="form-control" name="name" maxlength="10" autocomplete="off" required/></td>
                            </tr>

                            {{ csrf_field() }}
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--  修改信息静态框-->
    <div class="modal fade " id="edit" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="{{ url('admin/editGongyingshangRes') }}" method="post" autocomplete="off" draggable="false" id="myEditShequForm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >修改供应商</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>
                            <input type="hidden" name="id" value="{{ session('res')['id'] }}" />
                            <tr>
                                <td wdith="30%">名称:</td>
                                <td width="70%"><input type="text" value="{{ session('res')['name'] }}" class="form-control" name="name" maxlength="10" autocomplete="off" required/></td>
                            </tr>

                            {{ csrf_field() }}
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
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
                $('#edit').modal('show')
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

                        var url = '{{ url('admin/deleteGongyingshang') }}';

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