@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">{{ $typename }}配置列表</h1>
        <ol class="breadcrumb">
            <li><a data-toggle="modal" data-target="#addSetting">新增</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{ count($res) }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">参数名称</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo -> id}}</td>
                            <td>{{$vo -> name}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td><a href="{{ url('admin/deleteSetting').'/'.$vo -> id .'/'.$type }}">删除</a></td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">{{ $res -> links() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--增加社区模态框-->
    <div class="modal fade " id="addSetting" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="{{ url('admin/addSettingRes') }}" method="post" autocomplete="off" draggable="false" id="myAddShequForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >添加配置</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">

                            <tbody>

                            <tr>
                                <td wdith="30%">名称:</td>
                                <td width="70%"><input type="text" value="" class="form-control" name="name" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <input type="hidden" name="type" value="{{ $type }}" />

                            {{ csrf_field() }}
                            </tbody>
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
        @if (session('deleteres'))
            alert('删除成功！');
        @endif

        @if (session('isset'))
            alert('已存在！');
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
        })
    </script>
@stop