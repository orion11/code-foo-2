<?php

$radius = $_POST['radius'];
$dimx = $_POST['length'];
$dimy = $_POST['width'];
$dimz = $_POST['height'];


function fillBus($radius, $dimx, $dimy, $dimz) {


# SOLVE FOR SIMPLE CUBIC
	$ballsx = floor($dimx / 2 / $radius);
	$ballsy = floor($dimy / 2 / $radius);
	$ballsz = floor($dimz / 2 / $radius);
	$result[] = $ballsx * $ballsy * $ballsz;
# END SIMPLE CUBIC CALCULATION


#SOLVE FOR HEXAGONAL CLOSE PACKED
	$ballsxa = $dimx / ( 2 * $radius );
	$ballsya = floor((( $dimy - 2 * $radius ) / ( $radius * sqrt(3) ) ) + 1);
	$ballsz = floor((( $dimz - 2 * $radius ) * 3 / ( 2 * $radius * sqrt(6) ) ) + 1);
	$ballsyb = floor((($dimy - 2* $radius - $radius / 3 * sqrt(3)) / ( $radius * sqrt(3))) +1);

	if ( $ballsxa < round($ballsxa)) {
		$ballsxa = floor($ballsxa);

		$ba = $ballsxa * $ballsya;
		$bb = $ballsxa * $ballsyb;
	}
	else {
		$ballsxa = floor($ballsxa);

		if ( $odd = $ballsya % 2) {
			$ba = $ballsxa * $ballsya - ( $ballsya - 1 ) / 2;
		}
		else {
			$ba = $ballsxa * $ballsya - $ballsya / 2;
		}

		if ( $odd = $ballsyb % 2 ) {
			$bb = $ballsxa * $ballsyb - ( $ballsyb -1 ) / 2;
		}
		else {
			$bb = $ballsxa * $ballsyb - $ballsyb / 2;
		}
	}
	if ( $odd = $ballsz % 2) {
		$result[] = ($ba + $bb) * $ballsz / 2 + $ba;
	}
	else {
		$result[] = ($ba + $bb) * $ballsz / 2;
	}

	return $result;
}


?>