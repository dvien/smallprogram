
//获取邻里互动
function getInfo(index,data){
    var html = '';
    if(index == 0){
        for(var i=0; i<data.length; i++) {
            var img_list = data[i].img;
            //邻里说
            html += '<section class="comment-title" onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'">';
            html += '<header class="comment-head flex-justify">';
            html += '<h3>'+data[i].title+'<span class="hygiene">'+data[i].label+'</span><span class="pending">待解决</span></h3>';
            html += '<span>徐晴霞</span>';
            html += '</header>';
            html += '<p>'+data[i].miaoshu+'</p>';

            if(img_list){
                html += '<div class="comment-img clearfix">';
                for(var j=0;j<img_list.length;j++){
                    html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                }
                html += '</div>';
            }
            img_list = null;


            html += '<footer class="comment-foot flex-justify">';
            html += '<span>'+data[i].created_at+'</span>';
            html += '<div><i class="iconfont icon-good"></i>';
            html += '<span>'+data[i].liulan+'</span>';
            html += '<img src="images/comment.png" /><span>'+data[i].dianzan+'</span>';
            html += '</div></footer><div class="property-reply">物业回复：感谢提供线索，麻烦告知具体楼栋位置。</div> </section>';
        }

    }

    //友邻互助
    if(index == 1){
        for(var i=0; i<data.length; i++) {
            var img_list = data[i].img;
            html += '<section class="comment-title"><header class="comment-head flex-justify">';
            html += '<h3>'+data[i].title+'<strong><em>¥ </em>'+data[i].price+'</strong></h3>';
            html += '<span>徐晴霞</span></header>';
            html += '<p>'+data[i].miaoshu+'</p>';


            if(img_list){
                html += '<div class="comment-img clearfix">';
                for(var j=0;j<img_list.length;j++){
                    html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                }
                html += '</div>';
            }



            html += '<footer class="comment-foot flex-justify">';
            html += '<span>2017-06-03 13:42</span>';
            html += '<div><i class="iconfont icon-good"></i>';
            html += '<span>'+data[i].dianzan+'</span><img src="images/comment.png" /><span>'+data[i].liulan+'</span>';
            html += '</div></footer><div class="property-reply flex-justify"><div class="demand-time">';
            html += '<h4>需求时间</h4><p>2017-06-03 13:42</p></div>';
            html += '<div class="demand-btn"><a href="" class="hover">帮TA</a><a href="">联系看看</a></div></div></section>';
        }

    }

    //社区活动
    if(index == 2){
        for(var i=0; i<data.length; i++) {
            var img_list = data[i].img;
            html += '<section class="comment-title" onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'">';
            html += '<header class="comment-head flex-justify">';
            html += '<h3>'+data[i].title+'</h3>';
            html += '<span>徐晴霞</span></header>';
            html += '<p>'+data[i].miaoshu+'</p>';


            if(img_list){
                html += '<div class="comment-img clearfix">';
                for(var j=0;j<img_list.length;j++){
                    html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                }
                html += '</div>';
            }



            html += '<footer class="comment-foot flex-justify">';
            html += '<span>2017-06-03 13:42</span>';
            html += '<div><i class="iconfont icon-good"></i>';
            html += '<span>'+data[i].dianzan+'</span><img src="images/comment.png" /><span>'+data[i].liulan+'</span>';
            html += '</div></footer>';

        }
    }

    //
    if(index == 3){
        for(var i=0; i<data.length; i++) {
            var img_list = data[i].img;
            html += '<section class="comment-title"><header class="comment-head flex-justify">';
            html += '<h3>42寸TCL液晶电视折旧出售<strong><em>¥ </em>70</strong><i class="iconfont icon-dianhua"></i></h3>';
            html += '<span>徐晴霞</span></header>';
            html += '<div class="comment-time"><span>时间</span> 2017-07-09 08:00 至 2017-07-17 22:00 </div>';
            html += '<p>七区北面20幢西面的儿童游乐区，有一个很大的沙坑，沙坑深，沙子是白色的碎石子一样的，沙坑里面还有很多大石头，非常脏。</p>';
            html += '<div class="comment-img clearfix">';

            for(var j=0;j<img_list.length;j++){
                html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
            }
            html += '</div><footer class="comment-foot flex-justify">';
            html += '<span>2017-06-03 13:42</span></footer></section>';

        }
    }
    return html;
}