@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">社区列表</h1>
        <ol class="breadcrumb">
            <li><a data-toggle="modal" data-target="#addShequ">新增社区</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{ $count }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">小区名称</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">楼栋数</span></th>
                    <th><span class="glyphicon glyphicon-camera"></span> <span class="visible-lg">负责人姓名</span></th>
                    <th><span class="glyphicon glyphicon-earphone"></span> <span class="visible-lg">负责人手机</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">用户数量</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">管理员账号</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">管理员密码</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td>{{$vo['title']}}</td>
                            <td>{{$vo['number_lou']}}</td>
                            <td>{{$vo['name']}}</td>
                            <td>{{$vo['tel']}}</td>
                            <td>{{$vo['people_numberr']}}</td>
                            <td>{{ $vo['manage'] -> username or '' }}</td>
                            <td>{{ $vo['manage'] -> password or '' }}</td>
                            <td>{{ date('Y-m-d H:i',$vo['created_at']) }}</td>
                            <td data="{{$vo['id']}}"><a href="{{ url('admin/enterXiaoqu').'/'.$vo['id'] }}">进入</a> <a  name="edit"  href="{{ url('admin/editShequ',['id'=>$vo['id']]) }}">修改</a>@if($vo['status'] == 0) <a href="{{ url('admin/changeShequ',['id'=>$vo['id'],'status' => $vo['status'] ]) }}">禁用</a>@else <a href="{{ url('admin/changeShequ',['id'=>$vo['id'],'status' => $vo['status'] ]) }}" >启用</a>@endif </td>
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
    <!--增加社区模态框-->
    <div class="modal fade " id="addShequ" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="{{ url('admin/addShequRes') }}" method="post" autocomplete="off" draggable="false" id="myAddShequForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >增加社区</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td wdith="30%">小区名称:</td>
                                <td width="70%"><input type="text" value="" class="form-control" name="title" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">楼栋数:</td>
                                <td width="70%"><input type="number" value="" class="form-control" name="number_lou" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">负责人姓名:</td>
                                <td width="70%"><input type="text" value="" class="form-control" name="name" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">负责人手机:</td>
                                <td width="70%"><input type="text" value="" class="form-control" name="tel" maxlength="11" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">管理员账号:</td>
                                <td width="70%"><input type="text" value="" class="form-control" name="username" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <!--
                            <tr>
                                <td wdith="20%">电话:</td>
                                <td width="80%"><input type="text" value="" class="form-control" name="usertel" maxlength="13" autocomplete="off" /></td>
                            </tr>
                            -->
                            <tr>
                                <td wdith="30%">管理员密码:</td>
                                <td width="70%"><input type="password" class="form-control" name="password" maxlength="18" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">确认密码:</td>
                                <td width="70%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" required/></td>
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
    <div class="modal fade " id="editShequ" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="{{ url('admin/editShequRes') }}" method="post" autocomplete="off" draggable="false" id="myEditShequForm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >修改用户</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>
                            <input type="hidden" name="id" value="{{ session('res')['id'] }}" />
                            <tr>
                                <td wdith="30%">小区名称:</td>
                                <td width="70%"><input type="text" value="{{ session('res')['title'] }}" class="form-control" name="title" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">楼栋数:</td>
                                <td width="70%"><input type="number" value="{{ session('res')['number_lou'] }}" class="form-control" name="number_lou" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">负责人姓名:</td>
                                <td width="70%"><input type="text" value="{{ session('res')['name'] }}" class="form-control" name="name" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">负责人手机:</td>
                                <td width="70%"><input type="text" value="{{ session('res')['tel'] }}" class="form-control" name="tel" maxlength="11" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td wdith="30%">管理员账号:</td>
                                <td width="70%"><input type="text" @if(session('res_manage'))value="{{ session('res_manage') -> username }}"@endif class="form-control" name="username" maxlength="10" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p>如不修改密码请不要填写</p>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td wdith="20%">电话:</td>
                                <td width="80%"><input type="text" value="" class="form-control" name="usertel" maxlength="13" autocomplete="off" /></td>
                            </tr>
                            -->
                            <tr>
                                <td wdith="30%">新密码:</td>
                                <td width="70%"><input type="password" class="form-control" name="password" maxlength="18" autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="30%">确认密码:</td>
                                <td width="70%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" /></td>
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

        @if (session('isset'))
            alert('用户名已存在！');
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