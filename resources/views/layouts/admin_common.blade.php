<!doctype html>
<html lang="zh-CN">
<head>
    @include('layouts.common_admin')
</head>
<body class="user-select">
<section class="container-fluid">
    @include('layouts.admin_header')

    <div class="row">
        @include('layouts.admin_left')
        @section('right-box')

        @show
    </div>
</section>
<!--个人信息模态框-->
<div class="modal fade" id="seeUserInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >个人信息</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                        <tr> </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td wdith="20%">姓名:</td>
                            <td width="80%"><input type="text" value="王雨" class="form-control" name="truename" maxlength="10" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">用户名:</td>
                            <td width="80%"><input type="text" value="admin" class="form-control" name="username" maxlength="10" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">电话:</td>
                            <td width="80%"><input type="text" value="18538078281" class="form-control" name="usertel" maxlength="13" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">旧密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="old_password" maxlength="18" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">新密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="password" maxlength="18" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">确认密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" /></td>
                        </tr>
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
<!--个人登录记录模态框-->
<div class="modal fade" id="seeUserLoginlog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >登录记录</h4>
            </div>
            -->
            <div class="modal-body">
                <table class="table" style="margin-bottom:0px;">
                    <thead>
                    <tr>
                        <th>登录IP</th>
                        <th>登录时间</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>::1:55570</td>
                        <td>2016-01-08 15:50:28</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>::1:64377</td>
                        <td>2016-01-08 10:27:44</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>::1:64027</td>
                        <td>2016-01-08 10:19:25</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>::1:57081</td>
                        <td>2016-01-06 10:35:12</td>
                        <td>成功</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">朕已阅</button>
            </div>
        </div>
    </div>
</div>
<!--微信二维码模态框-->
<div class="modal fade user-select" id="WeChat" tabindex="-1" role="dialog" aria-labelledby="WeChatModalLabel">
    <div class="modal-dialog" role="document" style="margin-top:120px;max-width:280px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="WeChatModalLabel" style="cursor:default;">微信扫一扫</h4>
            </div>
            <div class="modal-body" style="text-align:center"> <img src="images/weixin.jpg" alt="" style="cursor:pointer"/> </div>
        </div>
    </div>
</div>




<!--提示模态框-->
<div class="modal fade user-select" id="areDeveloping" tabindex="-1" role="dialog" aria-labelledby="areDevelopingModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="areDevelopingModalLabel" style="cursor:default;">该功能正在日以继夜的开发中…</h4>
            </div>
            <div class="modal-body"> <img src="images/baoman/baoman_01.gif" alt="深思熟虑" />
                <p style="padding:15px 15px 15px 100px; position:absolute; top:15px; cursor:default;">很抱歉，程序猿正在日以继夜的开发此功能，本程序将会在以后的版本中持续完善！</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">朕已阅</button>
            </div>
        </div>
    </div>
</div>
<!--右键菜单列表-->
<div id="rightClickMenu">
    <ul class="list-group rightClickMenuList">
        <li class="list-group-item disabled">欢迎访问异清轩博客</li>
        <li class="list-group-item"><span>IP：</span>172.16.10.129</li>
        <li class="list-group-item"><span>地址：</span>河南省郑州市</li>
        <li class="list-group-item"><span>系统：</span>Windows10 </li>
        <li class="list-group-item"><span>浏览器：</span>Chrome47</li>
    </ul>
</div>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/admin-scripts.js')}}"></script>
<!--增加用户模态框-->
<div class="modal fade " id="addUser" tabindex="-1" role="dialog"  >
    <div class="modal-dialog" role="document" style="max-width:450px;">
        <form action="@if(Request::getPathInfo() == '/admin/numberBack' ){{url('admin/addRes')}}@elseif(Request::getPathInfo() == '/admin/numberBusiness' ){{url('admin/addBusinessRes')}}@elseif(Request::getPathInfo() == '/admin/shequ_number') {{ url('admin/shequ_addRes') }} @elseif(Request::getPathInfo() == '/admin/wuye_number') {{ url('admin/wuye_addRes') }} @endif" method="post" autocomplete="off" draggable="false" id="myAddForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >增加用户</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                        <tr> </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td wdith="20%">用户名:</td>
                            <td width="80%"><input type="text" value="" class="form-control" name="username" maxlength="10" autocomplete="off" /></td>
                        </tr>
                        <!--
                        <tr>
                            <td wdith="20%">电话:</td>
                            <td width="80%"><input type="text" value="" class="form-control" name="usertel" maxlength="13" autocomplete="off" /></td>
                        </tr>
                        -->
                        <tr>
                            <td wdith="20%">新密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="password" maxlength="18" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">确认密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" /></td>
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
<div class="modal fade " id="editUser" tabindex="-1" role="dialog"  >
    <div class="modal-dialog" role="document" style="max-width:450px;">
        <form action="@if(Request::getPathInfo() == '/admin/numberBack' ){{url('admin/editUserRes')}}@elseif(Request::getPathInfo() == '/admin/numberBusiness' ) {{ url('admin/editBusinessRes') }}@elseif(Request::getPathInfo() == '/admin/shequ_number' ){{ url('admin/shequ_editUserRes') }} @elseif(Request::getPathInfo() == '/admin/wuye_number') {{ url('admin/wuye_editUserRes') }} @endif" method="post" autocomplete="off" draggable="false" id="myEditForm" >
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
                        <input type="hidden" name="id" value="@if(session('userres')){{ session('userres')['id'] }}@endif" />
                        <tr>
                            <td wdith="20%">用户名:</td>
                            <td width="80%"><input type="text" value="@if(session('userres')){{ session('userres')['username'] }}@endif" class="form-control" name="username"  maxlength="10" autocomplete="off" disabled/></td>
                        </tr>
                        <!--
                        <tr>
                            <td wdith="20%">电话:</td>
                            <td width="80%"><input type="text" value="" class="form-control" name="usertel" maxlength="13" autocomplete="off" /></td>
                        </tr>
                        -->
                        <tr>
                            <td wdith="20%">新密码:</td>
                            <td width="80%"><input type="password"  class="form-control" name="password" maxlength="18" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td wdith="20%">确认密码:</td>
                            <td width="80%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" /></td>
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
    $(function(){
        $('#myAddForm').submit(function(){
            if(!$.trim($('#myAddForm input[name=username]').val())){
                alert('请填写用户名');return false;
            }
            if(!$.trim($('#myAddForm input[name=password]').val())){
                alert('请填写密码');return false;
            }
            if($.trim($('#myAddForm input[name=password]').val()) != $.trim($('#myAddForm input[name=new_password]').val())){
                alert('两次填写密码不一致');return false;
            }
        })
        $('#myEditForm').submit(function(){

            if(!$.trim($('#myEditForm input[name=password]').val())){
                alert('请填写密码');return false;
            }
            if($.trim($('#myEditForm input[name=password]').val()) != $.trim($('#myEditForm input[name=new_password]').val())){
                alert('两次填写密码不一致');return false;
            }
        })
    })
</script>
</body>
</html>