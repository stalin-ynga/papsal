(function(a){
    a.fn.webwidget_menu_vertical_menu1=function(p){
        var p=p||{};

        var g=p&&p.style_color?p.style_color:"red";
        var h=p&&p.font_color?p.font_color:"#666";
        var i=p&&p.font_decoration?p.font_decoration:"none";
        var m=p&&p.directory?p.directory:"images";
        var n=p&&p.animation_speed?p.animation_speed:"fast";
        var o=a(this);
        if(o.children("ul").length==0||o.children("ul").children("li").length==0){
            o.append("Require menu content");
            return null
        }
        init();
        function init(){
            o.children("ul").children("li").css("background-image","url("+m+"/vm_normal.gif)");
            o.children("ul").children(".top_border").css("background-image","url("+m+"/vm_top.gif)");
            o.children("ul").children(".bottom_border").css("background-image","url("+m+"/vm_bottom.gif)");
            o.children("ul").children("li:has(ul)").css("background-image","url("+m+"/vm_arrow.gif)");
            o.children("ul").children("li").children("a").css("color",h).css("text-decoration",i);
            o.children("ul").children("li:has(a)").hover(
                function(){
                    //alert(o.children("ul").children("li").index($(this)));
                    mouseover($(this));
                },
                function(){
                    mouseout($(this));
                }
            );
            o.children("ul").children("li").children("ul").children("li").css("background-image","url("+m+"/vm_normal2.gif)");
            o.children("ul").children("li").children("ul").children(".top_border").css("background-image","url("+m+"/vm_top.gif)");
            o.children("ul").children("li").children("ul").children(".bottom_border").css("background-image","url("+m+"/vm_bottom.gif)");
            o.children("ul").children("li").children("ul").children("li").children("a").css("color",h).css("text-decoration",i);
            o.children("ul").children("li").children("ul").children("li:has(a)").hover(
                function(){
                    $(this).css("background-image","url("+m+"/vm_normalover2.gif)");
                },
                function(){
                    $(this).css("background-image","url("+m+"/vm_normal2.gif)");
                }
            );
        }
        function mouseover(dom){
            dom.children("a").css("color","#FFF");
            if(dom.children().is("ul")){
                dom.css("background-image","url("+m+"/vm_arrowover.gif)");
            }else{
                dom.css("background-image","url("+m+"/vm_normalover.gif)");
            }
            dom.children("ul").fadeIn(n);
        }
        function mouseout(dom){
            dom.children("a").css("color",h);
            if(dom.children().is("ul")){
                dom.css("background-image","url("+m+"/vm_arrow.gif)");
            }else{
                dom.css("background-image","url("+m+"/vm_normal.gif)");
            }
            dom.children("ul").fadeOut(n);
        }
    }
})(jQuery);