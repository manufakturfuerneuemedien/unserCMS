
  
    <div class="bc_filter" col_name="<?= $db_name?>" type="<?= $type ?>">
    	<p class="bc_filter_header"><?= $display_as?>:</p>
		<input type="text" name="<?= $db_name?>" value="<?php if($filter_value != ''):?><?=$filter_value?><?php endif;?>">
    </div>