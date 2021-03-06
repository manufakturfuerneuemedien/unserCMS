



		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/fonts.css"); ?>">
		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/lightbox.css"); ?>">
		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/jquery-ui.css"); ?>">
		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/jquery-ui.theme.css"); ?>">
		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/imgareaselect-default.css"); ?>">
		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/spectrum.css"); ?>">
		<link rel="stylesheet" type="text/css" href="<?=site_url("items/besc_crud/css/besc_crud.css"); ?>">
		
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/jquery-1.11.2.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/jquery-ui.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/lightbox.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/jquery-fieldselection.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/jquery.imgareaselect.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/imagesloaded.pkgd.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/spectrum.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/ckeditor/ckeditor.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/besc_crud.js"); ?>"></script>
		<script type="text/javascript" src="<?=site_url("items/besc_crud/js/besc_crud_edit.js"); ?>"></script>
		<script>
			<?php foreach($bc_urls as $key => $value):?>
				var <?= $key?> = "<?= $value?>";
			<?php endforeach;?>
				var bc_edit_or_add = "<?= $edit_or_add?>";
			<?php if(isset($pk_value)):?>
				var bc_pk_value = "<?= $pk_value?>";
			<?php endif;?>
		</script>

		<div class="bc_message_container"></div>

		<div class="bc_title"><?= $title?></div>

		<div class="bc_edit_table">
			<?php foreach($columns as $column):?>
				<?= $column?>
			<?php endforeach; ?>
		</div>

		<div class="bc_message">
			<div class="bc_message_icon"></div>
			<div class="bc_message_text"></div>
		</div>

		<div class="bc_column_actions">
			<ul>
				<?php if($edit_or_add == BC_ADD):?>
					<li class="bc_add">Save</li>
					<li class="bc_add_and_go_back">Save and go back to list</li>
					<li class="bc_add_cancel">Back to list</li>
				<?php else:?>
					<li class="bc_update">Update</li>
					<li class="bc_update_and_go_back">Update and go back to list</li>
					<li class="bc_update_cancel">Cancel</li>
				<?php endif;?>
			</ul>
		</div>

