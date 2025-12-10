<?php

# Display section
function createSection($entities, $entity_name1, $entity_name2, $columns_entity)
{
?>
	<!-- Creation of a section assurance -->
	<div style="margin-left: 3rem; margin-top: 1.5rem; width: 95%; padding: 1rem; border: 1px solid #ccc; border-left: 4px solid #6f42c1; border-radius: 8px;">
		<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
			<h6 style="margin: 0; color: #6f42c1;">↳ <?= $entity_name1 ?></h6>
		</div>
		<div id="table_<?= $entity_name1 ?>" class="table-responsive">

			<!-- Test if <?= $entity_name2 ?> has <?= $entity_name2 ?> or not -->
			<?php if (!isset($entities) || empty($entities))
			{
			?>
				<table class="table table-striped table-bordered mt-3">
					<tbody>
						<!-- <?= $entity_name2 ?> has no <?= $entity_name2 ?> yet -->
						<tr>
							<td class="label-permis">Pas <?= $entity_name1 ?> enregistré</td>
						</tr>
					</tbody>
				</table>
			<?php
			}
			else
			{
			?>
				<!-- <?php $entity_name1 ?> -->
				<table class="table table-striped table-bordered mt-3">
					<tbody>
						<?php entityColumnsSection($entities, $entity_name1, $columns_entity); ?>
					</tbody>
				</table>
			<?php
			}
			?>
		</div>
	</div>
<?php
}

# Display datas columns
function entityColumnsSection($entities, $entity_name1, $columns_entity)
{
	array_map(function($item) use ($columns_entity, $entity_name1)
	{
		$col_name = array_keys($columns_entity);
		foreach($item->toArray() as $c => $v):
		$html = '<tr>';
			if ($c == 'id'):
				$id = $v;
			endif;

			if (in_array($c, $col_name)):
			        $html .='<td class="td-hidden">'.$columns_entity[$c].'</td>';
				$html .= columnType($c, $v, $columns_entity);
			endif;

			$html .= '</tr>';
			echo $html;	
		endforeach;

	}, $entities);
}

function columnType(string $column_name, $column_value, $columns_entity)
{
	if ($column_value instanceof Time || $column_value instanceof \DateTimeInterface):
		return '<td data-label="'.$columns_entity[$column_name].'">'.date('d/m/Y', strtotime($column_value)).'</td>';
	endif;

	return '<td data-label="'.$columns_entity[$column_name].'">'.esc($column_value).'</td>';
}
?>
