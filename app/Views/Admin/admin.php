<?= $this->extend('layouts/main') ?> <!-- Extend the base layout -->
<?= $this->section('content') ?> <!-- Start the main content section -->

<?php


function paginateNumber (&$count, $items = 3)
{
	if ($count < $items)
	{
		$count++;
		return true;
	}
	return false;
}

# Display banned datas
function bannedDatas ($entity,$entity_name, $columns_entity, $resetData, $valueResetData)
{ ?>
	<div class="table-responsive">
		<h4 class="centerTitle"><?= $entity_name ?> bannis</h4>
		<table class="table table-striped table-bordered mt-3">
			<tbody>
				<!-- Test if atleast one <?= $entity_name ?> is banned -->
				<?php if (empty($entity))
				{ ?>

					<!-- None banned <?= $entity_name ?> -->
					<tr>
						<td class="labelAlign"> Aucun <?= $entity_name ?> banni</td>
					</tr>
				<?php
				}
				else
				{
				?>
					<!-- Display banned <?= $entity_name ?> -->
					<?php entityColumns($entity,$entity_name, $columns_entity, $resetData, $valueResetData);
				}
				?>
			</tbody>
		</table>
		<a href="<?= site_url(''.$entity_name.'') ?>" class="btn btn-secondary">Retour vers <?= $entity_name ?></a>
	</div>
	</br></br>
<?php
}

# Display datas columns
function entityColumns($entity, $entity_name, $columns_entity, $resetData, $valueResetData)
{
	array_map(function($item) use ($columns_entity, $entity_name, $resetData, $valueResetData)
	{
		static $count = 0;
		if (paginateNumber($count))
		{

			$columns_entity;
			$html = '<tr>'
				.'<td class="td-hidden table15pourcent">'.$entity_name.'</td>';
			$id = 0;

			foreach ($item as $c => $v) :

				if ($c == 'id'):
					$id = $v;
				endif;

				if (in_array($c, $columns_entity)):
					$html .= '<td data-label="'.$c.'">'.esc($v).'</td>';
				endif;

			endforeach;

			$html .= '<td data-label="Action" class="actionend">'
			.'<form method="post" action="'. site_url(''.$entity_name.'/update/'.$id) .'">'
			.'<!-- Enabled account button -->'
			.'<input type="hidden" name="'.$resetData.'" id="'.$resetData.'" value="'.$valueResetData.'">'
			.'<!-- Redirection button -->'
			.'<input type="hidden" name="redirect_url" value="'. current_url() .'">'
			.'<button type="submit" class="btn btn-danger btn-sm"> Rétablir '.$entity_name.' </button>'
			.'</form>'
			.'</td>'
			.'</tr>';
			echo $html;
		}
	}, $entity);
}


bannedDatas($user, 'User', ['nom','prenom'], 'actif', '1');
bannedDatas($ip, 'Ip', ['adresse_ip'], 'nb_echec', '0');
?>

<?= $this->endSection() ?> <!-- End the content section -->

