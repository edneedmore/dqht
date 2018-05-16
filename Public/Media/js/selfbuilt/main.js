$(function(){
    $(".nav li,.list li").on("click",function(){
        $(this).addClass("current").siblings().removeClass("current");
    });
    $(".paging .page").on("click",function(){
        var $current_page=$(".paging .current_page");
        var $nextPage=$current_page.next();
        if($(this).hasClass("next")){
            if($nextPage.hasClass("next")){
                return;
            }else{
                $nextPage.addClass("current_page").siblings().removeClass("current_page");
            }
        }else{
            $(this).addClass("current_page").siblings().removeClass("current_page");
        }
    })
});
/*tab*/
$(function(){
    $(".tab_li").on("mouseover",function(){
        $(this).addClass('current').siblings().removeClass("current");
        var tab=$(this).attr("data-tab");
        $(".news[data-tab='"+tab+"']").removeClass("none").siblings().addClass("none");
    })
    $('.service_link').on('click', function(e){
        Do('http://dl.ntalker.com/js/xn6/ntkfstat.js?siteid=kf_9745', function(){
            NTKF_PARAM = {
              siteid:"kf_9745",                            //Ntalker提供平台基础id,
              settingid:"kf_9745_1429166113044",          //Ntalker分配的缺省客服组id  
              uid:parseInt(TKJ.config.user_id) || 0,                                //用户id
              uname:TKJ.config.username || 0,                     //用户名  
              ntalkerparam:{
            　　item: {       
            　　    id: "",     //商品ID
                    name: Cute.config.SITENAME,         //商品名称
                    url:Cute.config.SITEURL,          //商品地址
                    uid:["用户ID",parseInt(TKJ.config.user_id) || 0],
                    uname:["用户名",TKJ.config.username || 0],
                    gid:["游戏ID",""],
                    gname:["游戏名称",""],               
                    sid:["区服ID",""],
                    sname:["区服名称",""],                        
                    role_name:["角色名称",""],
                    role_level:["角色等级",""]   
            　   }
              }
            };
            NTKF.im_openInPageChat();
        });
        e.preventDefault();
    });
});