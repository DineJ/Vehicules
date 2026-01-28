<?php

# Display section
function createSection($entities, $entity_name1, $entity_name2, $columns_entity, $button_add = '0', $button_update = '0', $id = "0")
{
?>
	<!-- Creation of a section assurance -->
	<div style="margin-left: 3rem; margin-top: 1.5rem; width: 95%; padding: 1rem; border: 1px solid #ccc; border-left: 4px solid #6f42c1; border-radius: 8px;">
		<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
			<h6 style="margin: 0; color: #6f42c1;">↳ <?= $entity_name1 ?></h6>
		</div>
		<div id="table_<?= $entity_name1 ?>" class="table-responsive">

			<?php if ($button_add)
			{ ?>
			<button type="button" class="btn btn-purple btn-popup-post" data-url-id="<?= site_url($entity_name1 .'/create') ?>" data-object-id="<?= $id ?>" data-title-id="Modal : Ajouter <?= $entity_name1 ?>">Ajouter <?= $entity_name1 ?></button>
			</br>
			<?php
			} ?>

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
				<?php entityColumnsSection($entities, $entity_name1, $columns_entity, $button_add, $button_update); ?>
			<?php
			}
			?>
		</div>
	</div>

	<div>
		<div class="modal fade" id="modalGeneric" aria-hidden="true">
			<!-- Size -->
			<div class="modal-dialog modal-lg">
				<!-- Content -->
				<div class="modal-content">
					<!-- Title -->
					<div class="modal-header">
						<h5 class="modal-title" id="modal-title">Modal <?= $entity_name1 ?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<!-- Form body -->
					<div class="modal-body" id="modalGenericContent">
						<?= view('Partials/navbar', ['no_navbar' => 'no_navbar']); ?>
						<!-- In case loading takes time -->
							Chargement...
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

# Display datas columns
function entityColumnsSection($entities, $entity_name1, $columns_entity, $button_add, $button_update)
{
	array_map(function($item) use ($columns_entity, $entity_name1, $button_add, $button_update)
	{
		$html  = '<table class="table table-striped table-bordered mt-3">';
		$html .= '<tbody>';
		$col_name = array_keys($columns_entity);
		foreach($item->toArray() as $c => $v):
		$html .= '<tr>';
			if ($c == 'id'):
				$id = $v;
			endif;

			if (in_array($c, $col_name)):
			        $html .='<td class="td-hidden">'.$columns_entity[$c].'</td>';
				$html .= columnType($c, $v, $columns_entity);
			endif;

			$html .= '</tr>';
		endforeach;
		$html .= '</tbody>';
		$html .= '</table>';

		if ($button_update)
		{
			$html .= '<button type="button" class="btn btn-orange btn-popup-get" data-object-id="'.$id.'" data-url-id="' .site_url($entity_name1.'/edit/'). '" data-title-id="Modal : Modifier '.$entity_name1.'">Modifier '.$entity_name1.' </button>';
		}

		$html .= '</br> </br>';
		echo $html;

	}, $entities);
}

function columnType(string $column_name, $column_value, $columns_entity)
{
	if ($column_value instanceof \DateTimeInterface)
	{
		$isDataTime = $column_value->format('H:i:s') !== '00:00:00';
		$format = $isDataTime ? 'd/m/Y H:i' : 'd/m/Y';
		return '<td data-label="'.$columns_entity[$column_name].'">'.esc($column_value->format($format)).'</td>';
	}

	return '<td data-label="'.$columns_entity[$column_name].'">'.esc($column_value).'</td>';
}
?>
