

		<div
			class="bc_column bc_hiddencolumn <?php if(($num_row) %2 == 0): ?>erow<?php endif;?>" col_name="<?= $db_name?>">
			<div class="bc_column_input bc_col_hidden">
				<input type="hidden" name="col_<?= $db_name?>" value="<?php if(isset($value)) echo $value;?>">
			</div>
			<div class="bc_error_text"></div>
		</div>