<?php

if (! function_exists('isControleVehiculeJson')) {
	function isControleVehiculeJson(?string $description): bool
	{
		if (empty($description)) {
			return false;
		}

		json_decode($description, true);

		return json_last_error() === JSON_ERROR_NONE;
	}
}