<?php 
//new functions
function rc($res){
	switch($res){
		case 0:
				return " ";
break;
			case 1:
				return "RC-Parish";
break;

case 2:
				return "RC-Daisies";
break;

default:
				return "";
				break;
}
}

function hostel($res){
	switch($res){
		case 0:
				return " ";
break;
			case 1:
				return "BC-Hostel";
break;

case 2:
				return "SC-Hostel";
break;
case 3:
				return "Basco-Hostel";
break;
case 4:
				return "Savio-Hostel";
break;
case 5:
				return "Others";
break;
default:
				return "";
				break;
}
}

function days_scholar($res){
	switch($res){
		case 0:
				return " ";
break;
			case 1:
				return "cycle";
break;

case 2:
				return "walk";
break;
case 3:
				return "Bus";
break;
case 4:
				return "School Bus";
break;
case 5:
				return "Auto";
break;

case 6:
				return "Van";
break;
default:
				return "";
				break;
}
}
//
function nationality($res){
	switch($res){
			case 1:
				return "INDIAN";
break;
default:
				return "";
				break;
}
}

function castetype($res){
	switch($res){
			case '1':
				return "ST";
				break;
			case '2':
				return "SC";
				break;
			case '3':
				return "SCA";
				break;
			case '4':
				return "MBC";
				break;	
			case '5':
				return "DNC";
				break;
			case '6':
				return "BC";
				break;
			case '7':
				return "BCM";
				break;
			case '10':
				return "BCC";
				break;	
			case '11':
				return "BCH";
				break;
			case '8':
				return "SCC";
				break;
			case '9':
				return "OC";
				break;	
			case '0':
				return "others";
				break;	
					
			default:
				return "";
				break;
	}
}


function religion($res)
{		
		switch($res){
			case 1:
				return "HINDU";
				break;
			case 2:
				return "MUSLIM";
				break;
			case 3:
				return "CHRISTIAN";
				break;
			case 4:
				return "OTHERS";
				break;	
			default:
				return "";
				break;
		}
}

function DateFormat($value)
{
	if($value != "0000-00-00" &&  !empty($value))	
		return date('d-m-Y', strtotime($value));
	else
		return "";
}

function YesNo($value)
{
    return ($value=="Y")?"Yes":"No";
}


   function convert_number_to_words($number) {
    
	$number=ltrim($number,'0');
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

function convert_to_nth($number){
       $number=ltrim($number,"0");
         $dictionar  = array(
          0                   => 'zero',
       1                   => 'First',
       2                   => 'Second',
       3                   => 'Third',
       4                   => 'Fourth',
       5                   => 'Fifth',
       6                   => 'Sixth',
       7                   => 'Seventh',
      8                   => 'Eighth',
       9                   => 'Ninth',
       10                  => 'Tenth',
       11                  => 'Eleventh',
       12                  => 'Twelfth',
       13                  => 'Thirteenth',
       14                  => 'Fourteenth',
       15                  => 'Fifteenth',
       16                  => 'Sixteenth',
       17                  => 'Seventeenth',
       18                  => 'Eighteenth',
       19                  => 'Nineteenth',
       20                  => 'Twenteith',
               21                  => 'Twenty First',
               22                 => 'Twenty second',
               23                  => 'Twenty third',
               24                  => 'Twenty fourth',
               25                  => 'Twenty Fifth',
               26                  => 'Twenty sixth',
               27                  => 'Twenty seventh',
               28                 => 'Twenty eighth',
               29                  => 'Twenty ninth',
			   30                  => 'Thirty',
               31                  => 'Thirty First'
               );
               $string = $dictionar[$number];
        // echo "<script>alert( $number );</script>";
          return $string;
 }

 
 
?>