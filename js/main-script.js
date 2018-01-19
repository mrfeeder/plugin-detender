(function($){
    $(document).ready(function(){
        var area_element_for_drag = [$(".tab-content div"),$(".area-for-drop").find('*')];
        var area_element_for_drop = [$(".area-for-drop"),$(".area-for-drop").find('*')];
        $(".area-for-drop").sortable();
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
                    $(ui.draggable).clone().appendTo($(this));
                    $(ui.droppable).clone().appendTo($(this));
                    // $(ui.draggable).remove();
                }
            });
        });
    });
})(jQuery);
