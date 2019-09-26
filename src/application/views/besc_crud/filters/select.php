



    <div class="bc_filter" col_name="<?= $db_name?>" type="<?= $type ?>">
    	<p class="bc_filter_header"><?= $display_as?>:</p>
    		<select name="<?= $db_name?>">
    		<?= $filter_value?>
    		<option value="null" <?php if($filter_value == ''):?>SELECTED<?php endif;?>>...</option>
    		<?php foreach($options as $option): ?>
    			<option value="<?= $option['key']?>"
    			<?php if($filter_value == $option['key'] && $filter_value != '') echo "SELECTED";?>><?= $option['value']?></option>
    		<?php endforeach; ?>
    		</select>
    </div>