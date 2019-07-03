$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height-100) + "px");
        }
    });

    /*var url = window.location;
    var element = $('ul#side-menu a').filter(function() {
        //console.log(this.href==url?this.href:"");
        var a = this.href.split("/");
        console.log(url);
        console.log(a[3]);
        var u = url.split("/"); 
        return u[3] == a[3];
    }).addClass('active').parent().parent().addClass('in').parent();
    
    if (element.is('li')) {
        element.addClass('active');
    }*/
    var height1 = $(".main-dash:eq(0)>div:eq(1)").height(); 
    var height2 = $(".main-dash:eq(1)>div:eq(1)").height(); 
    
    $(".main-dash:eq(0)>div>:eq(0).card").css('height', height1);
    $(".main-dash:eq(1)>div:eq(2)>.card").css('height', height2);


    var height_sdm_bottom_left_card = $(".sdm-bottom-left-card").parent().height();
    $(".just-right").css('height', height_sdm_bottom_left_card);

   /* $(".main-dash:eq(0)>div>:eq(0).card>.row>.card-home-title>h2").css('font-size', "2em");
    $(".main-dash:eq(0)>div>:eq(0).card>.row>div>.txt_card_subtitle").css('font-size', "1.5em");*/
});
