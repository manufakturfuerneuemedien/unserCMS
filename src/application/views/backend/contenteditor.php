
            
            <!-- CSS -->
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/imgareaselect-default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/contenteditor.css"); ?>">
        	<link rel="stylesheet" type="text/css" href="<?=site_url("items/general/css/content.css"); ?>">
        
        	<!-- JS -->
        	<script type="text/javascript" src="<?=site_url("items/backend/js/jquery.imgareaselect.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/imagesloaded.pkgd.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/ckeditor/ckeditor.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/ckeditor/adapters/jquery.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/jquery.dialogextend.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/content.js?ver=2"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/module_text.js?ver=2"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/module_headline.js?ver=2"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/module_image.js?ver=2"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/module_video.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/module_pdf.js"); ?>"></script>


        	<!-- moduledata -->
        	<script>
                var contentId = <?= $content->id?>;
        	</script>

        
        	<div id="content_menu_container">
                <div id="content_menu">
                    <div class="content_menu_item nofloat">Currently editing: <strong><?= $content->name ?></strong></div>
                    <div class="content_menu_item">
                        <select id="content_module_select">
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                            <option value="headline">Headline</option>
                  <!--          <option value="pdf">PDF</option> -->
                        </select>
                        <div class="content_menu_item_button" id="content_module_add">Add</div>
                    </div>
                    <div class="content_menu_separator">|</div>
                    <div class="content_menu_item">
                        <div class="content_menu_item_button" id="content_save">Save changes</div>
                        <div class="content_menu_item_button" id="content_discard">Go back</div>
                    </div>
                </div>
            </div>
      
            <div id="content_container_big" parent_id=0 class="content_container isBackend has_placeholder" data-text="EMPTY!!!"><?= $module_html[MODULE_PARENT_BIG]?></div>
            
            <div id="content_container_small" parent_id=1 class="content_container isBackend has_placeholder" data-text="EMPTY!!!"><?= $module_html[MODULE_PARENT_SMALL]?></div>
            
            <div id="dialogContainer"></div>
            
            <div id="module_prototypes">
                <div id="module_prototype_text"><?= $module_templates['text']?></div>
                <div id="module_prototype_image"><?= $module_templates['image']?></div>
                <div id="module_prototype_pdf"><?= $module_templates['pdf']?></div>
                <div id="module_prototype_headline"><?= $module_templates['headline']?></div>
            </div>
            
            <div id="filemanPanel" style="display: none;">
                <iframe src="" style="width:100%;height:100%" frameborder="0"></iframe>
            </div>
            
            <div id="dialog_templates">
                <div id="addModuleDialog">
                    In which column do you want to add the element?
                </div>
                
                <div id="popup_module_text" class="popup_edit">
                    <div class="popup_edit_container">
                        <textarea class="popup_module_text_textarea" id="module_text_editor"></textarea>
                    </div>
                </div>
                
                
                 <div id="popup_module_headline" class="popup_edit">
                    <div class="popup_edit_container">
                    	<table style="width:100%;">
                            <tr>
                                <td><label>Text:</label></td>
                                <td><input style="width:100%" type="text" class="input content" /></td>
                            </tr>
                            
                            <tr>
                                <td><label>Menu display text:</label></td>
                                <td><input style="width:100%" type="text" class="input display" /></td>
                            </tr>
                            <tr style="height:20px;">
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label>Headline Type:</label></td>
                                <td>
                                    <select class="select_type">
				                        <option value="small">Small</option>
				                        <option value="big">Big</option>
				                    </select>
                                </td>
                            </tr>
                            <tr style="height:20px;">
                                <td></td>
                                <td></td>
                            </tr> 
                            <tr>
                                <td><label>Section:</label></td>
                                <td><input type="text" class="input section" /></td>
                            </tr>                                               
                        </table>
                    </div>
                    	
                </div>
                
                <div id="module_image_dialog">
                
                    <div class="module_dialog">
                        <div class="module_image_preview_container">
                            <img class="module_image_preview" src="" />
                        </div>
                        
                        <table>
                            <tr>
                                <td><button class="filemanager">Filemanager</button></td>    
                            </tr>
                            <tr>
                                <td><label>Stretch image:</label></td>
                                <td><input class="input stretch" type="checkbox"></td>
                            </tr>
                            <tr>
                                <td><label>Align:</label></td>
                                <td>
                                    <select class="select align">
                                        <option value="left">Left</option>
                                        <option value="center">Center</option>
                                        <option value="right">Right</option>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                                <td><label>Caption:</label></td>
                                <td><input type="text" class="input caption" /></td>
                            </tr>                                               
                        </table>
                    </div>
                </div>
                
                
                <div id="popup_module_pdf" class="popup_edit">
                	<div class="module_dialog">
		                <div class="header">Edit PDF module</div>
		                <table>
	                            <tr>
	                                <td><button class="filemanager">Filemanager</button></td>    
	                            </tr>
	                            <tr>
	                                <td><label>Selected:</label></td>
	                                <td><input type="text" class="selected_pdf" class="input" disabled/></td>
	                            </tr>
	                            <tr>
	                                <td><label>Align:</label></td>
	                                <td>
	                                    <select class="select align">
	                                        <option value="left">Left</option>
	                                        <option value="center">Center</option>
	                                        <option value="right">Right</option>
	                                    </select>
	                                </td>
	                            </tr> 
	                            <tr>
	                                <td><label>Caption:</label></td>
	                                <td><input type="text" class="input caption" /></td>
	                            </tr>                                               
	                        </table>
	                </div>
	            </div>
                
            </div>

             
           
            