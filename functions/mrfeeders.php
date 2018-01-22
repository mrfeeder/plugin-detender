<?php
    function contact_mrfeeder_init(){
        echo "<h1>Contact of Mrfeeder</h1>
            <button type=''>Add New</button>
            <div id='form-mrfeeder'>
                <div class='area-for-element'>
                    <ul class='nav nav-tabs'>
                      <li class='active'><a data-toggle='tab' href='#home'>constructor</a></li>
                      <li><a data-toggle='tab' href='#menu1'>element</a></li>
                      <li><a data-toggle='tab' href='#menu2'>properties</a></li>
                    </ul>

                    <div class='tab-content'>
                      <div id='home' class='tab-pane fade in active show'>
                        <div class='col-md-1'>div 1/12 column</div>
                        <div class='col-md-2'>div 2/12 columns</div>
                        <div class='col-md-3'>div 3/12 columns</div>
                        <div class='col-md-4'>div 4/12 columns</div>
                        <div class='col-md-5'>div 5/12 columns</div>
                        <div class='col-md-6'>div 6/12 columns</div>
                        <div class='col-md-7'>div 7/12 columns</div>
                        <div class='col-md-8'>div 8/12 columns</div>
                        <div class='col-md-9'>div 9/12 columns</div>
                        <div class='col-md-10'>div 10/12 columns</div>
                        <div class='col-md-11'>div 11/12 columns</div>
                        <div class='col-md-12'>div 12/12 columns</div>
                        <div>section</div>
                        <div>color section</div>
                      </div>
                      <div id='menu1' class='tab-pane fade'>
                        <div>image</div>
                        <div>slider</div>
                        <div>text</div>
                        <div>email</div>
                        <div>input</div>
                        <div>div</div>
                        <div>ul</div>
                        <div>ol</div>
                        <div>li</div>
                        <div>video</div>
                        <div>link</div>
                        <div>table</div>
                        <div>td</div>
                        <div>th</div>
                        <div>tr</div>
                        <div>textarea</div>
                      </div>
                      <div id='menu2' class='tab-pane fade'>
                        <div>class</div>
                        <div>id</div>
                        <div>style</div>
                      </div>
                    </div>
                </div>
                <div class='outside-area-drop'><div class='area-for-drop'>

                </div></div>
                <button type='submit' id='custom_editor_box'>sav</button>
            </div>
        ";
    }
    add_action('admin_menu', 'contact_plugin_setup_menu');
?>
