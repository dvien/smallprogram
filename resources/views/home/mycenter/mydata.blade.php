<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<article class="user-center">
    <header class="public-header">
        <i class="iconfont icon-fanhui" onclick="history.go(-1)"></i>
        <img src="{{asset('images/logo.png')}}">
    </header>
    <div class="user-main">
        <div class="user-photo">
            <div style="background:url('{{ $res -> img }}') no-repeat center;background-size:cover;"></div>
        </div>
        <h3>{{ $res -> xiaoquname -> title }}{{ $res -> louhao }}栋{{ $res -> menpaihao }}</h3>
    </div>
</article>
<form>
    <div class="personal-data">
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>真实姓名</span>
                <label class="label-switch">
                    <input type="checkbox">
                    <div class="checkbox"></div>
                </label>
                <div><i class="iconfont icon-gantanhao"></i>关闭后隐藏信息</div>
            </div>
            <input type="text" class="flex-1" value="{{ $res -> name }}"/>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>电话</span>
            </div>
            <input type="tel" class="flex-1" value="{{ $res -> tel }}"/>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>验证码</span>
            </div>
            <div class="flex-1 data-code">
                <input type="text" class="flex-1" placeholder="输入验证码" value=""/>
                <input type="button" class="get-code"  value="获取验证码"/>
            </div>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>小区</span>
            </div>
            <input type="text" class="flex-1" value="{{ $res -> xiaoquname -> title  }}"/>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>身份</span>
            </div>
            <input type="text" class="flex-1" value="产权人"/>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>楼号</span>
                <label class="label-switch">
                    <input type="checkbox">
                    <div class="checkbox"></div>
                </label>
                <div><i class="iconfont icon-gantanhao"></i>关闭后隐藏信息</div>
            </div>
            <input type="text" class="flex-1" value="{{ $res -> louhao }}栋"/>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>户号</span>
                <label class="label-switch">
                    <input type="checkbox">
                    <div class="checkbox"></div>
                </label>
                <div><i class="iconfont icon-gantanhao"></i>关闭后隐藏信息</div>
            </div>
            <input type="text" class="flex-1" value="{{ $res -> louhao }}"/>
        </div>
        <div class="data-list flex-justify">
            <div class="flex-align data-name">
                <span>家庭状态</span>
            </div>
            <select name="jiating">
                <option value="">家庭状态</option>
                <option value="1">单身青年</option>
                <option value="2">二人世界</option>
                <option value="3">三口之家</option>
            </select>
        </div>
    </div>
    <div class="id">
        <h3>身份证</h3>
        <div>
            <input type="file" />
        </div>
    </div>
    <div class="id certificate">
        <h3>房产证书</h3>
        <div>
            <input type="file" />
        </div>
    </div>
    <div class="hold">
        <a href="">保存</a>
    </div>
</form>
<script>
    $(".get-code").click(function(){
        var num = 60;
        function reduce(){
            if(num==0){
                $(".get-code").removeAttr("disabled");
                $(".get-code").val("重新发送");
                num = 60;
                clearInterval(time);
                return false;
            }else{
                $(".get-code").prop("disabled", true);
                $(".get-code").val(num+"秒");
                num--;
            }
        }
        var time = setInterval(reduce,1000);
    });
</script>
</body>
</html>


