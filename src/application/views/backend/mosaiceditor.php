
            
            <!-- CSS -->
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/imgareaselect-default.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/spectrum.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/jquery.scombobox.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/general/css/mosaic.css"); ?>">
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/mosaiceditor.css"); ?>">
        
        	<!-- JS -->
        	<script type="text/javascript" src="<?=site_url("items/backend/js/jquery.imgareaselect.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/imagesloaded.pkgd.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/ckeditor/ckeditor.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/ckeditor/adapters/jquery.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/jquery.dialogextend.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/spectrum.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/latinize.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/missed.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/jquery.scombobox.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/mosaic.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/mosaic_text.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/mosaic_image.js"); ?>"></script>


        	<!-- moduledata -->
        	<script>
                var contentId = <?= $content->id?>;
                
                
                $(document).ready(function()
				{			
					prepareMosaicCanvas(<?= $content->mosaic_type;?>);
				});
        	</script>
        
        	<div id="content_menu_container">
                <div id="content_menu">
                    <div class="content_menu_item nofloat">Currently editing: <strong><?= $content->name ?></strong></div>
                    <div class="content_menu_item">
                        <select id="content_module_select">
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                        </select>
                        <div class="content_menu_item_button" id="content_module_add">Add</div>
                    </div>
                    <div class="content_menu_separator">|</div>
                    <div class="content_menu_item">
                        <div class="content_menu_item_button" id="content_module_clone">Clone</div>
                    </div>
                    <div class="content_menu_separator">|</div>
                    <div class="content_menu_item">
                        <div class="content_menu_item_button" id="content_save">Save changes</div>
                        <div class="content_menu_item_button" id="content_discard">Go back</div>
                    </div>
                </div>
            </div>
      
            <div id="mosaic_workspace">
                <div id="mosaic_item_container">
                    <div class="mosaic_dimensions width"></div>
                    <div class="mosaic_dimensions height"></div>
                    <div id="mosaic_item" class="isBackend">
                        <?= $mosaic_modules['html']?>
                    </div>
                </div>
                
                <div id="mosaic_module_list" class="has_placeholder" data-text="No modules ..."></div>
            </div>
            
            <div id="mosaic_itemlist"></div>
            
            
            <div id="dialogContainer"></div>
            
            <div id="module_prototypes">
                <div id="mosaic_prototype_text"><?= $mosaic_templates['text']?></div>
                <div id="mosaic_prototype_image"><?= $mosaic_templates['image']?></div>
                <div id="mosaic_prototype_text_list"><div class='mosaic_module_list_item text' mosaic_id=""></div></div>
                <div id="mosaic_prototype_image_list"><div class='mosaic_module_list_item image' mosaic_id=""><img src="" /></div></div>
            </div>
            
            
            <div id="filemanPanel" style="display: none;">
                <iframe src="" style="width:100%;height:100%" frameborder="0"></iframe>
            </div>
            
            <div id="cloneDialog">
                <select id="cloneMosaics">
                    <?php foreach($cloneMosaics->result() as $clone):?>
                        <?php if($clone->id != $content->id):?>
                            <option value="<?= $clone->id?>"><?= $clone->name?></option>
                        <?php endif;?>
                    <?php endforeach;?>
                </select>
                <div id="mosaic_preview"></div>
            </div>
            
            <div id="dialog_templates">
                
                <div id="popup_module_text" class="popup_edit">
                    <div class="popup_edit_container">
                        <table>
                            <tr>
                                <td><label>Position X:</label></td>
                                <td><input type="text" class="popup_module_text_input posX" /><span> px</span></td>
                                <td><label>Position Y:</label></td>
                                <td><input type="text" class="popup_module_text_input posY" /><span> px</span></td>
                                <td><label>Background color:</label></td>
                                <td><input type="text" class="popup_module_text_input bg_color" /></td>
                            </tr>
                            <tr>
                                <td><label>Width:</label></td>
                                <td><input type="text" class="popup_module_text_input width" /><span> px</span></td>
                                <td><label>Height:</label></td>
                                <td><input type="text" class="popup_module_text_input height" /><span> px</span></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    
                        <textarea class="popup_module_text_textarea"></textarea>
                    </div>
                </div>
                
                <div id="popup_module_image" class="popup_edit">
                    <div class="popup_edit_container">
                        <table>
                            <tr>
                                <td><label>Position X:</label></td>
                                <td><input type="text" class="popup_module_text_input posX" /><span> px</span></td>
                                <td><label>Position Y:</label></td>
                                <td><input type="text" class="popup_module_text_input posY" /><span> px</span></td>
                                <td><label>Background color:</label></td>
                                <td><input type="text" class="popup_module_text_input bg_color" /></td>
                            </tr>
                            <tr>
                                <td><button class="filemanager">Filemanager</button></td>
                            </tr>
                            <tr>
                                <td colspan=6 class="filemanager_preview_td"><img class="popup_module_image_preview" /></td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
            </div>