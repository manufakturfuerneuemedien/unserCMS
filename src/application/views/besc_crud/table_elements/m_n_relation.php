

        <td>
			<?php foreach($n_values->result() as $n_value):?>
				<span class="bc_m_n_element"><?= $n_value->$table_n_value?></span>
			<?php endforeach;?>
		</td>