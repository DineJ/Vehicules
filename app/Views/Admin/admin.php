<?= $this->extend('layouts/main') ?> <!-- Extend the base layout -->
<?= $this->section('content') ?> <!-- Start the main content section -->

<?php

const COUNT_ITEMS = 3;

function paginateNumber (&$count)
{
	if ($count < COUNT_ITEMS)
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
		<!-- Test if atleast one <?= $entity_name ?> is banned -->
		<?php if (empty($entity))
		{ ?>
			<table class="table table-striped table-bordered mt-3">
				<tbody>
					<!-- None banned <?= $entity_name ?> -->
					<tr>
						<td class="labelAlign"> Aucun <?= $entity_name ?> banni</td>
					</tr>
				</tbody>
			</table>
		<?php
		}
		else
		{
		?>
			<!-- Display banned <?= $entity_name ?> -->
			<?php entityColumns($entity,$entity_name, $columns_entity, $resetData, $valueResetData);
		}
		?>
		<a href="<?= site_url(''.$entity_name.'') ?>" class="btn btn-secondary">Retour vers <?= $entity_name ?></a>
	</div>
	</br></br>
<?php
}

# Display datas columns
function entityColumns($entities, $entity_name, $columns_entity, $resetData, $valueResetData)
{
	array_map(function($item) use ($columns_entity, $entity_name, $resetData, $valueResetData)
	{
		static $count = 0;
		if (paginateNumber($count))
		{

			$html =  '<table class="table table-striped table-bordered mt-3"'
				.'<tbody>';
			$id = 0;

			foreach ($item as $c => $v) :
				$html .= '<tr>';

				if ($c == 'id'):
					$id = $v;
				endif;

				if (in_array($c, $columns_entity)):
					$html .= '<td class="td-hidden">'.$c.'</td>'
						.'<td data-label="'.$c.'">'.esc($v).'</td>';
				endif;
				$html .='</tr>';

			endforeach;

			$html .= '<td class="td_hidden">Action </td>'
			.'<td data-label="Action" class="actionend">'
			.'<form method="post" action="'. site_url(''.$entity_name.'/update/'.$id) .'">'
			.'<!-- Enabled account button -->'
			.'<input type="hidden" name="'.$resetData.'" id="'.$resetData.'" value="'.$valueResetData.'">'
			.'<!-- Redirection button -->'
			.'<input type="hidden" name="redirect_url" value="'. current_url() .'">'
			.'<button type="submit" class="btn btn-danger btn-sm"> Rétablir '.$entity_name.' </button>'
			.'</form>'
			.'</td>'
			.'</tr>'
			.'</tbody>'
			.'</table>';
			echo $html;
		}
	}, $entities);
}


bannedDatas($user, 'User', ['nom','prenom'], 'actif', '1');
bannedDatas($ip, 'Ip', ['adresse_ip'], 'nb_echec', '0');
bannedDatas($vehicule, 'Vehicule', ['plaque', 'marque', 'modele'], 'actif', '1');
bannedDatas($lieu, 'Lieu', ['numero', 'adresse', 'nom_lieu'], 'actif', '1');
?>

<?= $this->endSection() ?> <!-- End the content section -->

