@extends('layouts.admin_common')
@section('right-box')

    <script src="{{ asset('admin/lib/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('admin/lib/ueditor/ueditor.all.min.js') }}"> </script>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="height:800px;overflow-y: scroll">
        <div class="row">
            <form action="{{ url('admin/addXieyi') }}" method="post" class="add-article-form">
                <div class="col-md-9">
                    <h1 class="page-header">社区协议</h1>

                    <div class="form-group">
                        <label for="article-content" class="sr-only">内容</label>
                        <script id="editor2" name="content" type="text/plain">{!! $res !!}</script>
                        <script type="text/javascript">
                        //实例化编辑器
                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                        //var ue = UE.getEditor('editor');
                        var ue = UE.getEditor('editor2', {
                            toolbars: [
                                [
                                    'undo', //撤销
                                    'redo', //重做
                                    'bold', //加粗
                                    'indent', //首行缩进

                                    'italic', //斜体
                                    'underline', //下划线
                                    'strikethrough', //删除线
                                    'subscript', //下标
                                    'fontborder', //字符边框
                                    'superscript', //上标


                                    'selectall', //全选


                                    'horizontal', //分隔线
                                    'removeformat', //清除格式
                                    'time', //时间
                                    'date', //日期


                                    'inserttitle', //插入标题

                                    'cleardoc', //清空文档


                                    'fontfamily', //字体
                                    'fontsize', //字号
                                    'paragraph', //段落格式
                                    'simpleupload', //单图上传
                                    'insertimage', //多图上传

                                    'justifyleft', //居左对齐
                                    'justifyright', //居右对齐
                                    'justifycenter', //居中对齐
                                    'justifyjustify', //两端对齐
                                    'forecolor', //字体颜色
                                    'backcolor', //背景色

                                    'fullscreen', //全屏

                                    'rowspacingtop', //段前距
                                    'rowspacingbottom', //段后距


                                    'imagecenter', //居中

                                    'lineheight', //行间距
                                    'source',

                                ]
                            ],

                        });
                        </script>
                    </div>

                </div>
                <div class="col-md-3">
                    <h1 class="page-header">操作</h1>

                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>发布</span></h2>
                        <!--
                        <div class="add-article-box-content">
                            <p><label>状态：</label><span class="article-status-display">未发布</span></p>
                            <p><label>公开度：</label><input type="radio" name="visibility" value="0" checked/>公开 <input type="radio" name="visibility" value="1" />加密</p>
                            <p><label>发布于：</label><span class="article-time-display"><input style="border: none;" type="datetime" name="time" value="2016-01-09 17:29:37" /></span></p>
                        </div>
                        -->
                        <div class="add-article-box-footer">
                            <button class="btn btn-primary" type="submit" name="submit">发布</button>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>




    @if (session('editres'))
        alert('修改成功！');
    @endif
@stop