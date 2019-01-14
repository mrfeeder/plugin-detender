(function($){
    $(document)
    .ready(function(){
        $( "#datepicker" ).datepicker();
        $(".remove-template").remove();
        $(".nav-tabs a").click(function() {
            var tabcontent = $(this).attr('href');
            $(".tab-content .tab-pane").removeClass("active");
            $(tabcontent).addClass("active");
        });
        $("#collapseExample .close").click(function() {
            $( ".set-new .btn-primary" ).trigger( "click" );
        });
    })
})(jQuery);
