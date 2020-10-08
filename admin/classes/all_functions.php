<?php

function clas($res)
{		
		switch($res){
			case 1:
				return "PRE-KG";
				break;
			case 2:
				return "UKG";
				break;
			case 3:
				return "LKG";
				break;
			case 4:
				return "I STD";
				break;
			case 5:
				return "II STD";
				break;	
			case 6:
				return "III STD";
				break;
			case 7:
				return "IV STD";
				break;
			case 8:
				return "V STD";
				break;
			case 9:
				return "VI STD";
				break;	
				
			case 10:
				return "VII STD";
				break;
			case 11:
				return "VIII STD";
				break;
			case 12:
				return "IX STD";
				break;
			case 13:
				return "X STD";
				break;	
			case 14:
				return "XI STD";
				break;
			case 15:
				return "XII STD";
				break;
			
				
			default:
				return "None";
				break;
		}
}

function section($res)
{
	switch($res){
			case 1:
				return "A-SEC";
				break;
				case 2:
				return "B-SEC";
				break;
				case 3:
				return "C-SEC";
				break;
				case 4:
				return "D-SEC";
				break;
				case 5:
				return "E-SEC";
				break;
				case 6:
				return "F-SEC";
				break;
				case 7:
				return "G-SEC";
				break;
				case 8:
				return "H-SEC";
				break;
				case 9:
				return "I-SEC";
				break;
				case 10:
				return "J-SEC";
				break;
				default:
				return "None";
				break;
	}
}

function castetype($res){
	switch($res){
			case 1:
				return "ST";
				break;
			case 2:
				return "SC";
				break;
			case 3:
				return "SCA";
				break;
			case 4:
				return "MBC";
				break;	
			case 5:
				return "DNC";
				break;
			case 6:
				return "BC";
				break;
			case 7:
				return "BCM";
				break;
			case 8:
				return "SCC";
				break;
			case 9:
				return "OC";
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
				return "None";
				break;
		}
}

function Education_year1($res)
{		
		switch($res){
			case 1:{
				return "2014 - 2015"; 
				break;
			}
			case 2:{
				return "2015 - 2016"; 
				break;
			}
			case 3:{
				return "2016 - 2017"; 
				break;
			}
			case 4:{
				return "2018 - 2019"; 
				break;
			}
			case 5:{
				return "2019 - 2020"; 
				break;
			}
			case 6:{
				return "2020 - 2021"; 
				break;
			}			
			case 7:	{
					return "2021 - 2022";
					break;
			}
			case 8:{
				return "2022 - 2023";
				break;
			}
			case 9:{
				return "2023 - 2024";
				break;
			}
			case 10:{
				return "2024 - 2025";
				break;
			}
			case 11:{
				return "2025 - 2026";
				break;
			}
			case 12:{
				return "2026 - 2027";
				break;
			}
			default:{
				return ""; 
				break;
			}
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

?>