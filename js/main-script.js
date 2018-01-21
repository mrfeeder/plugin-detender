(function($){
    $(document).ready(function(){
        var area_element_for_drag = [$(".tab-content div"),$(".dropindrop")];
        var area_element_for_drop = [$(".area-for-drop"),$(".dropindrop")];
        var count = 1;
        // $(".area-for-drop").sortable();
        $(".area-for-drop").disableSelection();
        $.each(area_element_for_drag,function(){
            $(this).draggable({
                containment : "#container",
                helper : 'clone',
                revert : 'valid',
                cancel:false
            });
        });
        $.each(area_element_for_drop,function(){
            $(this).droppable({
                hoverClass : 'ui-state-highlight',
                accept: ":not(.ui-sortable-helper)",
                drop : function(ev, ui) {
                    var _draggable = $(ui.draggable);
                    // _draggable = _draggable.attr("a");
                    _draggable.clone().appendTo($(this)).attr('id', 'a' + count).addClass( "dropindrop ui-droppable" );
                    $(ui.droppable).clone().appendTo($(this));
                    // $(ui.draggable).remove();
                    count ++ ;
                }
            });
        });
    });
})(jQuery);
