(function($){
    $(document).ready(function(){
        $('#form-mrfeeder').draggable();
        $(".area-for-drop").sortable();
        $(".area-for-drop").disableSelection();
        $(".tab-content button").draggable({
            containment : "#container",
            helper : 'clone',
            revert : 'invalid'
        });
        $(".area-for-drop, .tab-pane").droppable({
            hoverClass : 'ui-state-highlight',
            accept: ":not(.ui-sortable-helper)",
            drop : function(ev, ui) {
                $(ui.draggable).clone().appendTo(this);
                $(ui.draggable).remove();
            }
        });
    });
})(jQuery);
