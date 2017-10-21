@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
        <div class="row">
            <form action="@if($type == 'edit'){{ url('admin/editLunboRes') }}@else{{ url('admin/addLunboRes') }}@endif" method="post" class="add-article-form" enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="article-title" class="">内链地址</label>
                        <input type="text" name="url_in" class="form-control" @if($type == 'edit')value="{{ $res['url_in'] }}" @endif placeholder="" required autofocus autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="article-title" class="">外链地址</label>
                        <input type="text" name="url_out" class="form-control" @if($type == 'edit')value="{{ $res['url_out'] }}" @endif  placeholder="" required autofocus autocomplete="off" />
                    </div>

                    @if($type == 'edit')
                        <input type="hidden" name="id" value="{{ $res['id'] }}" />
                        <img src="{{ asset('uploads') }}/{{ $res['img'] }}" style="width:100px;height:80px;" />
                        <p>如不需要修改图片，请不要上传</p>
                    @endif
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>图片</span></h2>
                        <div class="add-article-box-content">
                            <input type="file" class="form-control" placeholder="点击按钮选择图片" id="pictureUpload" name="file" autocomplete="off" @if($type == 'add') required @endif>
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