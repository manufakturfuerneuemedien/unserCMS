
            
            <!-- CSS -->
            <link rel="stylesheet" type="text/css" href="<?=site_url("items/backend/css/menueditor.css"); ?>">
        
        	<!-- JS -->
        	<script type="text/javascript" src="<?=site_url("items/general/js/jquery-ui.min.js"); ?>"></script>
        	<script type="text/javascript" src="<?=site_url("items/backend/js/menu.js"); ?>"></script>

        	
        	<script>
                var contentType = <?= $content->type?>;
                var contentId = <?= $content->id?>
        	</script>
        	
        	<div id="menu_menu">
                <div class="menu_menu_item nofloat">Currently editing: <strong><?= $content->name ?></strong></div>
                <div class="menu_menu_item">
                    <div class="menu_menu_item_button" id="teaser_save">Save changes</div>
                    <div class="menu_menu_item_button" id="teaser_discard">Discard changes</div>
                </div>
            </div>
        	
            <div id="langlist">
                <?php foreach($languages as $key => $lang):?>
                    <div class="langlist_item" lang_id=<?=$key?>>
                        <div class="langlist_item_header"><?= $lang['name']?></div>
                        <div class="langlist_item_desc">Teaser text</div>
                        <div class="langlist_item_text"><input type="text"/ value="<?= $lang['teaser'] != null ? $lang['teaser']->teaser_text : ''?>"></div>
                        <div class="langlist_item_desc">Teaser subtext</div>
                        <div class="langlist_item_subtext"><textarea><?= $lang['teaser'] != null ? $lang['teaser']->teaser_subtext : ''?></textarea></div>
                    </div>
                <?php endforeach;?>
            </div>          

            
            