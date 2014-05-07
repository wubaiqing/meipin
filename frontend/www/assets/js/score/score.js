/* 代码整理：懒人之家 lanrenzhijia.com */
var columnReadyCounter = 0;

// This is the callback function for the "hiding" animations
// it gets called for each animation (since we don't know which is slowest)
// the third time it's called, then it resets the column positions

// When the DOM is ready
$(function() {

    var $allContentBoxes = $(".content-box"),
        $allTabs = $(".tabs_score"),
        $el,hrefSelector = "";


    // first tab and first content box are default current
    $(".content-box:first").addClass("score_current");
    $(".box-wrapper .current .col").css("top", 0);

    $("#score").delegate(".tabs_score", "click", function() {

        $el = $(this);

        if ( (!$el.hasClass("current")) && ($(":animated").length == 0 ) ) {

            // current tab correctly set
            $allTabs.removeClass("current");
            $el.addClass("current");
            hrefSelector = $el.attr("href");
            var type = hrefSelector.replace('#','');
            var page=1;
            $.ajax({
                url:"/score/ajax",
                data:{"type":type,"page":page},
                type:"POST",
                dataType:"json",
                success:function(data){
                    var str = "";
                },
                error : function(data){
                return false;
            }
            })
            // new content box is marked as current
            $allContentBoxes.removeClass("score_current");
            $(hrefSelector).addClass("score_current");


        };

    });

});
