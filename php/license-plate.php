<?php
	
	$pop = $_POST['pop'];

	function grammar($val, $word, $val2 = '', $word2 = '') {
		$phrase = 'The license plate pattern is <span class="val">';
		if ($val == 1) {
			$phrase .= $val.' '.$word;
		}
		if ($val > 1) {
			$phrase .= $val.' '.$word.'s';
		}
		if ($val > 0 && $val2 > 0) {
			$phrase .= '</span> and <span class="val">';
		}
		if ($val2 == 1) {
			$phrase .= $val2.' '.$word2;
		}
		if ($val2 > 1) {
			$phrase .= $val2.' '.$word2.'s';
		}
		$phrase .= '</span>.';
		return $phrase;
	}

	function plate_pattern($pop) {

		$bad = array('/', ';', '(', ')','~','!','@','#','$','%','^','&','*','+','=','{','}','[',']','|',':','?','>','<','_','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		$count_num = 1;
		$numbers = 0;
		$letters = 0;
		$skip = 0;
		###### TRIVIAL SOLUTIONS ######
		foreach( $bad as $s ) {
			if (is_string(stristr($pop, $s))) {
				$result = 'Please make sure your input is only numbers.';
				$skip = 1;
				break;
			}
		}
		unset($s);

		if ($skip == 0) {
			$bad[] = ',';
			$pop = str_replace($bad, '', $pop);

			if ($pop == '') {
				$result = 'Please enter a population. (e.g. 1234321)';
			}
			elseif (is_string(strstr($pop, '.'))) {
				$result = '... you have a fraction of a population. REALLY?!';
			}
			elseif ($pop < 0) {
				$result = 'ZOMG!! The living dead are risiing! WHAT ARE YOU DOING ON THE INTERNET, RUN FOR YOUR LIFE!';
			}
			elseif ($pop == 0) {
				$result = 'IF YOU HAVE NO POPULATION, WHAT ARE YOU DOING HERE?!?!';
			}
			elseif ($pop == 1) { // since log1 returns 0
				$result = grammar($pop, "number");
			}
			elseif ($pop == pow(10, (int)round(log10($pop)))) { //For exact powers of 10
				$numbers = log($pop, 10);
				$result = grammar($numbers, "number");
			}
			elseif ($pop == pow(26, (int)round(log($pop, 26)))) { //for exact powers of 26
				$letters = log($pop, 26);
				#$result = grammar($letters, "letter");
				$result = grammar($letters, "letter");
			}
			########### END TRIVIAL ##############

			else {		// Solve for every other scenario
				for ($i = 0; $pop > $count_num; $i++) { 	//Count for max numbers's
					$count_num = $count_num * 10;
					$numbers++;
				}
				for ($x = 0; $x <= $numbers; $x++) { 		//Loop thru count of numbers's
					for ($y = 0; $y <= $numbers; $y++) { 	//Loop thru count of letters's
						$soln[] = pow(10, $x) * pow(26, $y);
						$patrn[] = array(
								"a" => $x,
								"b" => $y,
								);
					}
				}
				array_multisort($soln, $patrn); 	//sort soln and arrange patrn accordingly
				$c = count($soln);
				for ($i = 0; $pop > $soln[$i]; $i++) {
					$patKey = $i +1;
				}
				$result = grammar($patrn[$patKey]["a"], "number", $patrn[$patKey]["b"], "letter");
			
			}

		}
	return $result;
	}
?>