@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">校友会列表</h1>
        <!--
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/addSchool') }}">新增</a></li>
        </ol>
        -->
        <h1 class="page-header">管理 <span class="badge">{{ count($res) }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">校委会名称</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">区域</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">人员规模</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">关联学校</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">添加人</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">简介</span></th>
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
                            <td>{{$vo -> area}}</td>
                            <td>{{$vo -> guimo}}</td>
                            <td>@if($vo -> schoolinfo){{$vo -> schoolinfo -> schoolname}}@endif</td>
                            <td>{{$vo -> add_user}}</td>
                            <td>{{$vo -> content}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td></td>
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

@stop