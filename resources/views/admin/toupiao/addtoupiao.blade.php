@extends('layouts.admin_common')
@section('right-box')

    <script src="{{ asset('admin/lib/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('admin/lib/ueditor/ueditor.all.min.js') }}"> </script>
    <style>
        .myinput {
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            width:80%;
        }
        .mylabel{
            width:80px;
            margin-top:15px;
        }
        .fl{
            float:left;
            margin-top:3px;
        }
        .ml3{
            margin-left:3px;
            margin-top:3px;
        }
        .title-box{
            margin-bottom:10px;
            border:1px solid #000000;
            padding:10px;
        }
    </style>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="padding-bottom:100px;">
        <div class="row" style="">
            <form action="{{ url('admin/addToupiaoRes') }}" method="post" class="add-article-form" enctype="multipart/form-data">
                <div class="col-md-9" style="height:700px;overflow-y: auto;padding-bottom:100px;">
                    <h1 class="page-header">添加投票</h1>
                    @if(isset($res)) <input type="hidden" name="id" value="{{ $res -> id }}" /> @endif
                    <div class="form-group">
                        <label for="article-title" class="sr-only">标题</label>
                        <input type="text" id="article-title" name="toupiao_title" class="form-control" placeholder="在此处输入标题"  required autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="article-title" class="">楼栋号</label>
                        <div>
                            <input type="button" class="btn btn-primary" value="全部" id="quanbu"/> &nbsp;<input  type ="button" class="btn " id="zhiding" value="指定楼号" />
                        </div>
                        <div id="loudong-box" style="margin-top:20px;display:none;">
                            @if(!empty($res -> number_lou))
                                @for($i=1;$i<=$res -> number_lou;$i++)
                            <label style="border:1px solid #91d0fa;">{{ $i }}栋 <input type="checkbox" name="loudong[]" value="{{ $i }}" /></label>
                                @endfor
                            @endif
                        </div>
                        <input type="hidden" name="loudong_type" id="loudong_type" value="0" />
                    </div>

                    <div class="form-group" style="margin-top:15px;">
                        <div>请设置身份</div>
                        <div><label><input type="checkbox" name="shenfen[]" value="0" checked/>产权人</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="1" />居民</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="2" />业委会主任</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="3" />业委会副主任</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="4" />业委会秘书</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="5" />业委会委员</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="6" />业主代表</label></div>
                        <div><label><input type="checkbox" name="shenfen[]" value="7" />社区管理员</label></div>
                    </div>


                    <div class="form-group">
                        <label for="article-title" class="mylabel" style="margin-top:0;">投票前言：</label>
                        <input type="text" class="form-control" style="width:100%;" name="qianyan"  />
                    </div>
                    <div class="row" >
                        <div class="col-md-1" style="" ><button class="btn add-box" type="button" style="">添加</button></div>
                        <div class="col-md-11 title-box">
                            <label for="article-title" class="mylabel" style="margin-top:0;">题型：</label>
                            <select name="select_type[]">
                                <option value="1">单选</option>
                                <option value="2">多选</option>
                            </select>
                            <br>
                            <label for="article-title" class="mylabel">标题：</label>
                            <input type="text" id="article-title" name="title[]" class="myinput" placeholder="在此处输入标题" required autofocus autocomplete="off">
                            <br>
                            <label for="article-title" class="mylabel" style="display:block;">题目选项：</label>
                            <div class="option-box" style="display:inline-block;width: 50%;">
                                <input type="text" id="article-title" name="option[]" class="myinput" style="width:80%;" placeholder="在此处输入选项" required autofocus autocomplete="off">
                                <button class="btn add-option" type="button" >添加</button>

                                <input type="hidden" value="1" class="number" name="number[]"/>
                            </div>
                        </div>
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
                <div class="col-md-3">
                    <h1 class="page-header">操作</h1>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>发布</span></h2>
                        <div class="add-article-box-content">
                            <p><label>类型：</label><input type="radio" name="type" value="0" checked />投票<input type="radio" name="type" value="1" />报名</p>
                            <p><label>是否开启：</label><input type="radio" name="status" value="0" checked/>开启 <input type="radio" name="status" value="1" />关闭</p>
                            <p><label>是否重要：</label><input type="radio" name="ishot" value="0" checked/>重要 <input type="radio" name="ishot" value="1" />不重要</p>
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
    <script>
        $(function(){

            //添加选项按钮
            $('.row .col-md-9').on('click','.add-option',function(){

                //先看这是第几个
                var number = $(this).parent().children('.number').val();
                if(number != 4){
                    var mark = '';
                    /*
                    switch (number){
                        case '1':mark = 'B';break;
                        case '2':mark = 'C';break;
                        case '3':mark = 'D';break;
                    }
                    */


                    var html = '<div class="new"><input type="text" id="article-title" name="option[]" class="myinput fl" style="width:80%;" placeholder="在此处输入选项'+mark+'" required autofocus autocomplete="off"><button class="btn fl ml3 delete-option"   type="button">删除</button></div>';
                    $(this).parent().children('.number').before(html);
                    $(this).parent().children('.number').val(parseInt($(this).parent().children('.number').val()) + 1);
                }

            })


            $('.row .col-md-9').on('click','.delete-option',function(){

                var number = $(this).parent('.new').parent('.option-box').children('.number').val();
                $(this).parent('.new').parent('.option-box').children('.number').val(parseInt(number) - 1);
                $(this).parent('.new').remove();
            })

            $('.row .col-md-9').on('click','.delete-box',function(){

                $(this).parent('.col-md-1').parent('.row').remove();
            })


            //添加大框按钮

            $('.row .col-md-9').on('click','.add-box',function(){
                var html = '<div class="row" ><div class="col-md-1" ><button class="btn delete-box" type="button" style="">删除</button></div>';
                html += '<div class="col-md-11 title-box" ><label for="article-title" class="mylabel" style="margin-top:0;">题型：</label>';
                html += '<select name="select_type[]"><option value="1">单选</option ><option value="2" >多选</option></select><br><label for="article-title" class="mylabel">标题：</label>';
                html += '<input type="text" id="article-title" name="title[]" class="myinput" placeholder="在此处输入标题" required autofocus autocomplete="off">';
                html += '<br><label for="article-title" class="mylabel" style="display:block;">题目选项：</label>';
                html += '<div class="option-box" style="display:inline-block;width: 50%;">';
                html += '<input type="text" id="article-title" name="option[]" class="myinput" style="width:80%;" placeholder="在此处输入选项" required autofocus autocomplete="off">';
                html += '<button class="btn add-option" type="button" >添加</button>';
                html += '<input type="hidden" value="1" class="number" name="number[]"/></div></div></div>';
                $(this).parent('.col-md-1').parent('.row').after(html);
            })

            $('#zhiding').click(function(){
                $(this).addClass('btn-primary');
                $('#quanbu').removeClass('btn-primary');
                $('#loudong-box').show();
                $('#loudong_type').val(1);
            })
            $('#quanbu').click(function(){
                $(this).addClass('btn-primary');
                $('#zhiding').removeClass('btn-primary');
                $('#loudong-box').hide();
                $('#loudong_type').val(0);
            })




        })


    </script>

@stop