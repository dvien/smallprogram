@extends('layouts.admin_common')
@section('right-box')

    <script src="{{ asset('admin/lib/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('admin/lib/ueditor/ueditor.all.min.js') }}"> </script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="height:700px;overflow-y: auto;padding-bottom:100px;">
        <div class="row">
            <form action="{{ url('admin/addGoodsRes') }}" method="post" class="add-article-form" enctype="multipart/form-data">
                <div class="col-md-9" >
                    <h1 class="page-header">@if(isset($res))编辑@else添加新商品@endif</h1>
                    @if(isset($res)) <input type="hidden" name="id" value="{{ $res -> id }}" /> @endif
                    <div class="form-group">
                        <label for="article-title" class="sr-only">标题</label>
                        <input type="text" id="article-title" name="title" class="form-control" placeholder="在此处输入标题" @if(isset($res))value="{{ $res->title }}"@endif required autofocus autocomplete="off">
                    </div>

                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">
                            <label for="article-title" >商品原价</label>
                            <input type="number"  name="price_pre" class="form-control" placeholder="" @if(isset($res))value="{{ $res->price_pre }}"@endif required autofocus autocomplete="off">

                        </div>
                        <div class="col-md-3">
                            <label for="article-title" >商品销价</label>
                            <input type="number"  name="price_no" class="form-control" @if(isset($res))value="{{ $res->price_no }}"@endif placeholder="" required autofocus autocomplete="off">

                        </div>
                        <div class="col-md-3">
                            <label for="article-title" >商品进价</label>
                            <input type="number"  name="price_jin" class="form-control" @if(isset($res))value="{{ $res->price_jin }}"@endif placeholder="" required autofocus autocomplete="off">

                        </div>
                        <div class="col-md-3">
                            <label for="article-title" >快递价格</label>
                            <input type="number"  name="price_kuaidi" class="form-control" @if(isset($res))value="{{ $res->price_kuaidi }}"@endif placeholder="" required autofocus autocomplete="off">

                        </div>



                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">
                            <label for="article-title" >商品库存</label>
                            <input type="number"  name="kucun" class="form-control" @if(isset($res))value="{{ $res->kucun }}"@endif placeholder="" required autofocus autocomplete="off">

                        </div>
                        <div class="col-md-3">
                            <label for="article-title" >限购数量</label>
                            <input type="number"  name="xiangou" class="form-control" @if(isset($res))value="{{ $res->xiangou }}"@endif placeholder="" required autofocus autocomplete="off">

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="article-content" >商品详情<a style="color:red;">（建议全屏操作）</a></label>
                        <script id="editor2" name="content" type="text/plain">@if(isset($res)) {!! $res -> content !!} @endif</script>
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

                    <!--
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>关键字</span></h2>
                        <div class="add-article-box-content">
                            <input type="text" class="form-control" placeholder="请输入关键字" name="keywords" autocomplete="off">
                            <span class="prompt-text">多个标签请用英文逗号,隔开。</span>
                        </div>
                    </div>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>描述</span></h2>
                        <div class="add-article-box-content">
                            <textarea class="form-control" name="describe" autocomplete="off"></textarea>
                            <span class="prompt-text">描述是可选的手工创建的内容总结，并可以在网页描述中使用</span>
                        </div>
                    </div>
                    -->

                </div>
                <div class="col-md-3"  >
                    <h1 class="page-header">操作</h1>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>配送方式</span></h2>
                        <div class="add-article-box-content">
                            <ul class="category-list">
                                <li>
                                    <label>
                                        <input name="peisongfangshi[]" type="checkbox" value="1" checked  @if(isset($res) && in_array('1',$res -> peisongfangshi)){{'checked'}}@endif checked />
                                        货物自提 <em class="hidden-md" style="display:none;">( 栏目ID: <span>1</span> )</em></label>
                                </li>
                                <li>
                                    <label>
                                        <input name="peisongfangshi[]" type="checkbox" value="2" @if(isset($res) && in_array('2',$res -> peisongfangshi)){{ 'checked' }}@endif  />
                                        快递配送 <em class="hidden-md" style="display:none;">( 栏目ID: <span>2</span> )</em></label>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>商品分类</span></h2>
                        <div class="add-article-box-content">
                            <select name="type">
                                <option value="">请选择分类</option>
                                @if(!empty($res_fenlei))
                                    @foreach($res_fenlei as $vo)
                                        <option  value="{{ $vo['id'] }}" @if( isset($res) && $vo['id'] == $res->type ) selected="selected" @endif >{{ $vo['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>供应商</span></h2>
                        <div class="add-article-box-content">
                            <select name="gongying_id">
                                <option value="">请选择供应商</option>
                                @if(!empty($res_gongying))
                                    @foreach($res_gongying as $vo)
                                        <option value="{{ $vo['id'] }}"  @if( isset($res) && $vo['id'] == $res->gongying_id ) selected="selected" @endif  >{{ $vo['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>商品主图（412*217px）</span></h2>
                        <div class="add-article-box-content">
                            <input type="file" class="form-control" placeholder="" id="pictureUpload" name="img" autocomplete="off" @if(empty($res)){{ 'required' }}@endif>
                        </div>
                        <h2 class="add-article-box-title"><span>轮播图 (421*321px)</span></h2>
                        <div class="add-article-box-content">
                            <input type="file" class="form-control" placeholder="" id="pictureUpload" name="imgs[]" multiple @if(empty($res)){{ 'required' }}@endif>
                        </div>
                    </div>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>发布</span></h2>
                        <div class="add-article-box-content">
                            <p><label>状态：</label><input type="radio" name="status" value="0" checked/>有效 <input type="radio" name="status" value="1" />无效</p>
                            <p><label>发布于：</label><span class="article-time-display"><input style="border: none;" type="datetime" name="time" value="{{ date('Y-m-d H:i') }}" /></span></p>
                        </div>
                        <div class="add-article-box-footer">
                            <button class="btn btn-primary" type="submit" name="submit">发布</button>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>

@stop