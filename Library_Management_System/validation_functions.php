<?php
		
		//presence
		function has_presence($value){ //logic is reversed
			return isset($value) & $value !=="";
		}
		//max length 
		function has_max_length($value, $max){
				return strlen($value) <= $max;
		}
		
		//inclusion in set
		function has_inclusion_in($value, $set){
			return in_array($value,$set);
		}
		
		function validate_max_lengths($fields_with_max_lengths)
		{
			global $errors;
		foreach($fields_with_max_lengths as $field => $max){
			$value = trim($_POST[$field]);
			if(!has_max_length($value, $max)){
				$errors[$field] = ucfirst($field) . " is too Long";
			}
			
		}
		}
			
			//Add days
		function add_Days($date,$days){

			$date = strtotime("+".$days." days", strtotime($date));
			return  date("y-m-d", $date);

		}
		//date diff
		function days_between($date1, $date2){
			
				$date1=date_create($date1);
				$date2=date_create($date2);
				
				$diff=date_diff($date2,$date1);
				
				$result= $diff->format("%a");
				
				return $result;
		}
			

		
		function form_errors($error=array()){
			$output = "";
			if(!empty($error))
			{
				$output .= "<div class=\"error\">";
				
				$output .= "<ul>";
				foreach($error as $key => $erro){
					$output .= " <li>$erro</li>";
				}
				$output .= "</ul>";
				$output .= "</div>";
			}
		
			return $output;
		}
		
	
	?>
	

