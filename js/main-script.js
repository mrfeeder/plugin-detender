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

        var table = $('.table table');
        $('#date, #name, #rating, #applied_position, #stage')
            .wrapInner('<span title="sort this column"/>')
            .each(function(){

                var th = $(this),
                    thIndex = th.index(),
                    inverse = false;
                th.click(function(){
                    table.find('td').filter(function(){
                        return $(this).index() === thIndex;
                    }).sortElements(function(a, b){
                        return $.text([a]) > $.text([b]) ?
                            inverse ? -1 : 1
                            : inverse ? 1 : -1;
                    }, function(){
                        // parentNode is the element we want to move
                        return this.parentNode;
                    });
                    inverse = !inverse;
                });
            });


          $("#typeInterview").change(function() {
            var val = $(this).val();
            if(val === "test") {
                $(".test-list").show();
            } else {
                $(".test-list").hide();
            }
          });
    })
})(jQuery);
