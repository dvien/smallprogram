@extends('layouts.admin_common')
@section('right-box')

    <script src="{{ asset('admin/lib/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('admin/lib/ueditor/ueditor.all.min.js') }}"> </script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" >
        <div class="row">
            <form action="@if(isset($res)){{ url('admin/editSchoolRes') }} @else{{ url('admin/addSchoolRes') }}@endif " method="post" class="add-article-form" enctype="multipart/form-data">
                <div class="col-md-9" >
                    <h1 class="page-header">学校详情编辑</h1>
                    @if(isset($res)) <input type="hidden" name="id" value="{{ $res -> id }}" /> @endif
                    <div class="form-group">
                        <label for="article-title" class="">学校名称</label>
                        <input type="text" id="article-title" name="schoolname" class="form-control" placeholder="学校名称" @if(isset($res))value="{{ $res->schoolname }}"@endif required autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="article-title" class="">官网</label>
                        <input type="text" id="article-title" name="guanwang" class="form-control" placeholder="官网" @if(isset($res))value="{{ $res->guanwang }}"@endif required autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="article-title" class="">创立年份</label>
                        <input type="tel" id="article-title" name="year" class="form-control" placeholder="创立年份" @if(isset($res))value="{{ $res->year }}"@endif required autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="article-title" class="">官方联系人</label>
                        <input type="tel" id="article-title" name="name" class="form-control" placeholder="官方联系人" @if(isset($res))value="{{ $res->name }}"@endif  autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="article-title" class="">官方联系人电话</label>
                        <input type="tel" id="article-title" name="tel" class="form-control" placeholder="官方联系人电话" @if(isset($res))value="{{ $res->tel }}"@endif  autofocus autocomplete="off">
                    </div>


                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>简介</span></h2>
                        <div class="add-article-box-content">
                            <textarea class="form-control" name="content" autocomplete="off">@if(isset($res)){{ $res->content }}@endif</textarea>
                            <!-- <span class="prompt-text"></span> -->
                        </div>
                    </div>

                    @if(isset($res))
                        <div class="add-article-box">
                            <h2 class="add-article-box-title"><span>LOGO</span></h2>
                            <div class="add-article-box-content">
                                <img src="{{asset('uploads/').'/'.$res->logo}}" style="width:80px;height:100px;" />
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-md-3">
                    <h1 class="page-header">操作</h1>

                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>logo</span></h2>
                        <div class="add-article-box-content">
                            <input type="file" class="form-control" placeholder="" id="pictureUpload" name="logo" autocomplete="off" @if(empty($res)){{ 'required' }}@endif>
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