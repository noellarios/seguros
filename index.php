<?php
	$result = new stdClass();
	$result->end1 = rand(10, 50);
	$result->end2 = rand(20, 100);
	$result->inc = rand(1, 50);
	$result->sum = 1;

	for ($i=0; $i < $result->end1 ; $i++) { 
		for ($i=0; $i < $result->end2; $i++) { 
			$result->sum += $result->sum * $result->inc;
		}
	}
	header('Content-Type: application/json');
	echo json_encode($result);

?>