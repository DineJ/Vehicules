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

# Display usefull datas
function usefullDatas ($entity,$entity_name, $columns_entity, $message, $resetData=null, $valueResetData=null)
{ ?>
	<div class="table-responsive">
		<h4 class="centerTitle"><?= $entity_name . ' : ' . $message ?></h4>
		<!-- Test if atleast one <?= $entity_name ?> exist -->
		<?php if (empty($entity))
		{ ?>
			<table class="table table-striped table-bordered mt-3">
				<tbody>
					<!-- None <?= $entity_name . ' : ' . $message ?> -->
					<tr>
						<td class="labelAlign"> Aucun <?= $entity_name ?></td>
					</tr>
				</tbody>
			</table>
		<?php
		}
		else
		{
		?>
			<!-- Display <?= $entity_name . ' ' . $message ?> -->
			<?php entityColumns($entity,$entity_name, $columns_entity, $message,  $resetData, $valueResetData);
		}
		?>
		<a href="<?= site_url(''.$entity_name.'') ?>" class="btn btn-secondary">Retour vers <?= $entity_name ?></a>
	</div>
	</br></br>
<?php
}

# Display datas columns
function entityColumns($entities, $entity_name, $columns_entity, $message, $resetData=null, $valueResetData=null)
{
	array_map(function($item) use ($columns_entity, $entity_name, $message, $resetData, $valueResetData)
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

			if ($resetData)
			{
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
				.'</tbody>'
				.'</table>';
			}
			else
			{
				$html .= '</tbody>'
					.'</table>';
			}
			echo $html;
		}
	}, $entities);
}


usefullDatas($user, 'User', ['Conducteur'], 'Banni', 'actif', '1');
usefullDatas($ip, 'Ip', ['IP'], 'Bannie', 'nb_echec', '0');
usefullDatas($vehicule, 'Vehicule', ['Plaque', 'Marque', 'Modèle'], 'Banni', 'actif', '1');
usefullDatas($lieu, 'Lieu', ['Adresse'], 'Banni', 'actif', '1');
usefullDatas($infraction, 'Infraction', ['Plaque', 'Conducteur', 'Date', 'Points', 'Prix'], 'Récent');
?>

<?= $this->endSection() ?> <!-- End the content section -->

