
        <td class="bc_td_image">
        	<?php if($filename != "" && $filename !== null): ?>
        		<a href="<?= site_url($uploadpath  . '/' . $filename)?>" data-lightbox="<?= $filename?>"> 
                    <img class="table_image_preview" src="<?= site_url($uploadpath  . '/' . $filename)?>" />
                </a>
        	<?php endif; ?>
        </td>
