(function($){
    $(document).ready(function(){
        $(".area-for-drop").sortable();
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
                _draggable.clone().appendTo($(this)).addClass( "dropindrop ui-droppable" );
                // $(this).droppable('option', 'accept', ui.draggable);
                $(ui.droppable).clone().appendTo($(this));
                // $(ui.draggable).remove();
            }
        });
        $(".area-for-drop div").ondrag({

        });
    });
})(jQuery);
