



<div class="bc_column <?php if(($num_row) %2 == 0): ?>erow<?php endif;?>" col_name="<?= $db_name?>">
	<p class="bc_column_header"><?= $display_as?>:</p>
	<?php if(isset($col_info) && $col_info != ""):?>
        <p class="bc_column_info">
		<i><?= $col_info ?></i>
        </p>
    <?php endif; ?>
	<div class="bc_column_input bc_col_select">
		<select name="col_<?= $db_name?>">
		<?php foreach($options as $option): ?>
			<option value="<?= $option['key']?>"
			<?php if(isset($value) && $value == $option['key']) echo "SELECTED";?>><?= $option['value']?></option>
		<?php endforeach; ?>
		</select>
	</div>
	<div class="bc_error_text"></div>
</div>