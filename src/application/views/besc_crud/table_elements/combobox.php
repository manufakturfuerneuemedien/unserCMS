



        <td>
			<?php foreach($options as $option): ?>
				<?php if($option['key'] == $value): ?>
					<?= $option['value']?>
				<?php endif; ?>
			<?php endforeach; ?>
		</td>