
            
            <!-- CSS -->
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/menueditor.css"); ?>">
        
        	<!-- JS -->
        	<script type="text/javascript" src="<?=site_url("items/general/js/jquery-ui.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/menu.js"); ?>"></script>

        	
        	<!-- moduledata -->
        	<script>
                var clientId = <?= $client->id?>;
                var clientLang = <?= $currentLang?>;
        	</script>
          
            <div id="menu_menu">
                <div class="menu_menu_item nofloat">Currently editing: <strong><?= $client->name ?></strong></div>
                <div class="menu_menu_item">
                    <span>Language:</span> 
                    <select id="menu_lang_select">    
                        <?php foreach($languages->result() as $lang):?>
                            <option value=<?= $lang->id?> <?php if($lang->id == $currentLang):?>SELECTED<?php endif;?> ><?= $lang->name?></option>
                        <?php endforeach;?>
                    </select>
                    <div class="menu_menu_item_button" id="menu_lang_switch">Switch</div>
                </div>
                <br clear="both">
                <div class="menu_menu_item">
                    <div class="menu_menu_item_button" id="menu_copy">Copy from menu</div>
                </div>
                <div class="menu_menu_item">
                    <div class="menu_menu_item_button" id="menu_add">Add menu item</div>
                </div>
                <div class="menu_menu_separator">|</div>
                <div class="menu_menu_item">
                    <div class="menu_menu_item_button" id="menu_save">Save changes</div>
                    <div class="menu_menu_item_button" id="menu_discard">Discard changes</div>
                </div>
            </div>
            
          
            <ul id="menu_container" class="unselectable has_placeholder" data-text="EMPTY!!!"><?php foreach($menuItems->result() as $menuitem):?>
                <li class="menu_menuitem">
                    <div class="menu_menuitem_anchor"><img src="<?= site_url('items/backend/img/icon_drag.png')?>" /></div>
                    <div class="menu_menuitem_name"><input type="text" value="<?= $menuitem->name?>"/></div>
                    <div class="menu_menuitem_metatag">
                        <select>
                            <option value=0 <?php if($menuitem->metatag_id == null):?>SELECTED<?php endif;?>>Menu header - no metatag link</option>
                            <?php foreach($metatags->result() as $metatag):?>
                                <option value=<?= $metatag->id?> <?php if($menuitem->metatag_id == $metatag->id):?>SELECTED<?php endif;?>><?= $metatag->name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="menu_menuitem_delete"><img src="<?= site_url('items/backend/img/icon_delete.png')?>" /></div>
                </li>
            <?php endforeach;?></ul>
            
            <li class="menu_menuitem is_template">
                <div class="menu_menuitem_anchor"><img src="<?= site_url('items/backend/img/icon_drag.png')?>" /></div>
                <div class="menu_menuitem_delete"><img src="<?= site_url('items/backend/img/icon_delete.png')?>" /></div>
                <div class="menu_menuitem_name"><input type="text" /></div>
                <div class="menu_menuitem_metatag">
                    <select>
                        <option value=0>Menu header - no metatag link</option>
                        <?php foreach($metatags->result() as $metatag):?>
                            <option value=<?= $metatag->id?>><?= $metatag->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </li>
            
            
            
            
            <div id="menu_copy_dialog">
                <table>
                    <tr>
                        <td colspan=2 style="padding-bottom: 10px;">COPY menu from client</td>
                    </tr>
                    <tr>
                        <td>Client</td>
                        <td>
                            <select id="menu_copy_client">
                            <option value="0">Select client ...</option>
                            <?php foreach($clients->result() as $c):?>
                                <option value="<?= $c->id?>"><?= $c->name?></option>                                
                            <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Language</td>
                        <td>
                            <select id="menu_copy_lang">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><div id="menu_copy_copy" class="">Copy</div></td>
                        <td><div id="menu_copy_cancel" class="">Cancel</div></td>
                    </tr>
                </table>
            </div>
            
            