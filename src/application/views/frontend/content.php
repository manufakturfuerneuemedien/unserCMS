        
    
    <? if($subsite->header_img != NULL && $subsite->header_img != ''):?>
    <div id="subsite_header">
        <img src="<?= site_url('items/uploads/header/' . $subsite->header_img)?>" />
    </div>
    <? endif;?>   
    <div id="content_container">            
        <div id="content_container_big"><?= $content[MODULE_PARENT_BIG]?></div>
                
        <div id="content_container_small"><?= $content[MODULE_PARENT_SMALL]?>
        <? if($subsite->show_section == 1):
	        foreach($sections as $section):
	        
	        	if($section->section != ''):?>
        			<a href="#<?= $section->section?>"><div class="section_item"><? if($section->display_text != '' && $section->display_text != NULL){ echo $section->display_text; }else{ echo $section->content;}?></div></a>
			<?	endif;
			endforeach;
        endif;?>
        </div>
    </div>