(function($){
    $(document)
    .ready(function(){
        // $(".area-for-drop").sortable();
        // $(".area-for-drop").disableSelection();
        // $(".dropindrop").droppable({
        //     drop: function(event, ui) {
        //     },
        //     out: function(event, ui){
        //         $(this).droppable('option', 'accept', '.drag-item');
        //     }
        // });
        $(".tab-content div").draggable({
            containment : "#container",
            helper : 'clone',
            revert : 'valid',
            cancel:false
        });
        $(".area-for-drop").droppable({
            hoverClass : 'ui-state-highlight',
            accept: ":not(.ui-sortable-helper)",
            drop : function(ev, ui) {
                var _draggable = $(ui.draggable);
                // _draggable = _draggable.attr("a");
                _draggable.clone().appendTo($(".outside-area-drop")).addClass( "dropindrop" ).removeClass("ui-draggable ui-draggable-handle");
                // $(this).droppable('option', 'accept', ui.draggable);
                $(ui.droppable).clone().appendTo($(".outside-area-drop"));
                // $(ui.draggable).remove();
            }
        });
        // $(".area-for-drop div").ondrag($(this).removeClass(""));
        $(".area-for-drop").click(function(){
            console.log("2");
        });
        $(".outside-area-drop div").click(function(){
            $(this).removeClass("ui-droppable");
            console.log("1");
        });
        $(".area-for-drop div").draggable({
            drag: function() {
                $(this).removeClass("ui-droppable");
            },
            containment : "#container",
            revert : 'valid',
            cancel:false
        });
    })
    // .change(function(){
    // });
})(jQuery);
