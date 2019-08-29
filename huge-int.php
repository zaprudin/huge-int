
<?php
	// Работает по принципу сложения столбиком, только не по 1 цифре, а блоками по 9.
	// Максимальный 32 bit int содержит 10 символов, берем на 1 меньше для разделения на блоки.
	function sum_int_strings($a, $b) {
		$a = (string)$a;
		$b = (string)$b;

		// Выравниваем длину строк для применения str_split
		$length = max(strlen($a), strlen($b));
		$a = str_pad($a, $length, '0', STR_PAD_LEFT);
		$b = str_pad($b, $length, '0', STR_PAD_LEFT);

		$a_parts = str_split($a, 9);
		$b_parts = str_split($b, 9);

		$sum = '';
		$add = 0;

		while( count($a_parts) && count($b_parts) ) {
			$a_last = array_pop($a_parts);
			$b_last = array_pop($b_parts);

			$tmp_sum = (int)$a_last + (int)$b_last + $add;
			$tmp_sum = (string)$tmp_sum;
			$tmp_len = strlen($tmp_sum);

			if( $tmp_len > strlen($a_last) ) {
				$add = 1;
				$tmp_sum = substr($tmp_sum, 1);
			} else {
				$add = 0;
			}

			$sum = $tmp_sum . $sum;
		}

		if( $add ) {
			$sum = $add . $sum;
		}

		return $sum;
	}

	$sum = sum_int_strings("123555555555555555555555555", "555555555555555555555555");
	if( $sum != "124111111111111111111111110" ) {
		echo "WRONG: $sum <br>";
	} else {
		echo "Correct: $sum <br>";
	}
