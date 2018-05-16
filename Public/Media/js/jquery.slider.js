;(function($){
	$.fn.extend({
		"slide":function(value){
			var $slide_wrapper=value?$(value+".slide_wrapper"):$(".slide_wrapper");
			var $slide=value?$(value+" .slide"):$(".slide");
			var $slide_item=$slide.children('.slide_item');
			var interval=value? value.replace(/^[\.|# ]/,""):interval;
			function loadStyle(){
				var i,html_str="";
				var $slide_item_len=$slide_item.length;
				var $slide_width=$slide_item_len*100;
				$slide.css({"width":$slide_width+"%",
							"height":$slide_item.height(),"position":"relative","right":$slide_item.width()});
				$slide_item.css({"float":"left"});
				for(i=1;i<$slide_item_len;i++){
					if(i===1){
						html_str+="<li class='dot dot_grew current_dot' data-slide='"+i+"''></li>";
					}else{
						html_str+="<li class='dot dot_grew' data-slide='"+i+"''></li>";
					}
				}
				$slide_wrapper.append("<ul class=' dot_wrapper'>"+html_str+"</ul>");
				i=0;
				slideTime(i);		
			}
			loadStyle();
			var $dot=value?$(value+" .dot"):$(".dot")
			$dot.on("click",function(event){
				var i=parseInt($(this).attr("data-slide"));
				autoSlide(i);
				if(i==$slide_item.length-1){
					slideTime(0);
				}else{
					slideTime(i);
				}
			});
			function slideTime(i){
				var $slide_item_len=$slide_item.length;
				clearInterval(interval);
				interval=setInterval(function(){
					i++;
					autoSlide(i);
					if(i==$slide_item_len-1){
						i=0;
					}
				},2000);
			}
			function autoSlide(i){
				$dot.filter(".current_dot").removeClass("current_dot");
				$dot.eq(i-1).addClass("current_dot");
				if($slide_item.filter(".current").attr("data-slide")==$slide_item.length-1&&i==1){
					$slide_item.eq(-1).removeClass('current');
					$slide_item.eq(0).addClass('current');
					$slide.css({"right":"0"});
				}
				$slide_item.eq(i).addClass('current').siblings().removeClass('current');
				var distance=i*$slide_item.width();
				$slide.animate({"right":distance},500);
			}
		},
		"fade":function(value){
			var $fade_wrapper=value?$(value+".fade_wrapper"):$(".fade_wrapper");
			var $fade=value?$(value+" .fade"):$(".fade");
			var $fade_item=$fade.children('.fade_item');
			var interval=value? value.replace(/^[\.|# ]/,""):interval;
			function loadStyle(){
				var i,html_str="";
				var $fade_item_len=$fade_item.length;
				$fade_item.eq(0).css({"display":"block"}).children("h1").addClass("h1")
					.siblings("p").addClass("p");
				for(i=1;i<=$fade_item_len;i++){
					if(i===1){
						html_str+="<li class='dot dot_grew current_dot' data-fade='"+i+"''></li>";
					}else{
						html_str+="<li class='dot dot_grew' data-fade='"+i+"''></li>";
					}
				}
				$fade_wrapper.append("<ul class='nav dot_wrapper'>"+html_str+"</ul>");
				i=1;
				fadeTime(i);		
			}
			loadStyle();
			var $dot=value?$(value+" .dot"):$(".dot")
			$dot.on("click",function(event){
				var i=parseInt($(this).attr("data-fade"));
				autoFade(i);
				if(i==$fade_item.length){
					fadeTime(0);
				}else{
					fadeTime(i);
				}
			});
			function fadeTime(i){
				var $fade_item_len=$fade_item.length;
				clearInterval(interval);
				interval=setInterval(function(){
					i++;
					autoFade(i);
					if(i==$fade_item_len){
						i=0;
					}
				},5000);
			}
			function autoFade(i){
				$dot.filter(".current_dot").removeClass("current_dot");
				$dot.eq(i-1).addClass("current_dot");
				if($fade_item.filter(".current").attr("data-slide")==$fade_item.length&&i==1){
					$fade_item.eq(-1).removeClass('current');
					$fade_item.eq(0).addClass('current');
				}
				$fade_item.eq(i-1).siblings().fadeOut("600").removeClass('current').children("h1").removeClass("h1").siblings("p").removeClass("p");
				setTimeout(function(){
					$fade_item.eq(i-1).fadeIn("800").addClass("current").children("h1").addClass("h1").siblings("p").addClass("p");
				},400);
			}
		}
	})
})(jQuery);