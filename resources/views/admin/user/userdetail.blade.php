@extends('layouts.admin_common')
@section('right-box')

    <style>
        table tr{
            margin-top:5px;
        }
    </style>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="height:700px;overflow-y: scroll;padding-bottom:100px;">
        <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">用户信息</h1>

                    <table class="table table-striped table-bordered" style="width:400px;">
                        <tr>
                            <td style="width:120px;">姓名：</td>
                            <td><input type="text" value="{{ $res -> name }}" class="form-control" disabled/></td>
                        </tr>
                        <tr>
                            <td>注册时间：</td>
                            <td><input type="text" value="{{ date('Y-m-d H:i',$res -> created_at) }}" class="form-control" disabled/></td>
                        </tr>

                        <tr>
                            <td>手机号码：</td>
                            <td>
                                <input type="text" class="form-control" disabled value="{{ $res -> tel }}"  />
                            </td>
                        </tr>

                        <tr>
                            <td>微信号码：</td>
                            <td><input type="text" class="form-control" disabled value="{{ $res -> wx_number }}"  /></td>
                        </tr>
                        <tr>
                            <td>学校：</td>
                            <td><input type="text" class="form-control" disabled value="{{ $res -> school_id }}"  /></td>
                        </tr>
                        <tr>
                            <td>专业：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> zhuanye_id }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>学历：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> xueli }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>入学时间：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> school_time }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>班级：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> banji }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>公司：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> zhuanye_id }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>职位：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> zhiwei }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>行业：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> hangye }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>描述：</td>
                            <td>
                                <input type="text" class="from-control" disabled value="{{ $res -> content }}" />
                            </td>
                        </tr>

                    </table>





                </div>


        </div>
    </div>

@stop