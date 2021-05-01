<?php
global $objMain;
class Main  extends Connection
{	
	var $image;
   var $image_type;
   function ResizeImage($filename, $save_filename, $width, $height){
        $this->load($filename);
        $this->resize_ratio($width,$height);
        $this->save($save_filename);
   }

   function ResizeShow($filename,$width,$height){
      $image->load($filename);
        $image->resize($width,$height); 
        $image->output();
   }
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=60, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename,$compression);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
       header('Content-type: image/jpeg');
         imagejpeg($this->image);
       exit;
      } elseif( $image_type == IMAGETYPE_GIF ) {
       header('Content-type: image/gif');
         imagegif($this->image);
       exit;
      } elseif( $image_type == IMAGETYPE_PNG ) {
       header('Content-type: image/png');
         imagepng($this->image);
       exit;
      }
   }
   
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize_ratio($width,$height) {
      
	$width_orig=$this->getWidth();
	$height_orig=$this->getHeight();
	$ratio_orig = $width_orig/$height_orig;

	if ($width/$height > $ratio_orig) {
	   $width = $height*$ratio_orig;
	} else {
	   $height = $width/$ratio_orig;
	}

   $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }

   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }    
   

	public function RecordLog($table,$page_type,$record_id,$action){
		$this->Query("insert into recordlog set table_name='".$table."', page_type='".$page_type."', record_id='".$record_id."', action_type='".$action."', userid=".$_SESSION['userid'].", action_date='".date("Y-m-d H:i:s")."'");
		
	}

	 public function accountSettings()
 {
	 $old_pass=md5($this->clean('old_pass'));
	 $user_pass=md5($this->clean('user_pass'));
	 	$count=$this->getResultscount("select id from customer where id='".$_SESSION['userid']."' and userpassword='".$old_pass."'");
	 if($count>0) {
		 $this->Query("update user set userpassword='".$user_pass."' where id='".$_SESSION['userid']."'");
		 header("location:change-password.php?msg=success");
	 } else header("location:change-password.php?msg=err");
	 	
	 
 }

	
	public function Month_Diff($start, $end){
	$ts1 = strtotime($start);
$ts2 = strtotime($end);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
return $diff;
}
	
	public function logout()
	{
		session_destroy();
		$this->redirectUrl("login.php?msg=logout");
	}
	public function getRow($query) { 
		//var_dump($query);
		//echo $query;
		$result = mysqli_query($this->connection,$query) or die($query);
		//$result = mysql_query($this->connection,$query);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		return $row;
	}
	public function Query($query){
		//echo $query;
		$res=mysqli_query($this->connection,$query);
		/*
		if($res){
			echo "---------1--------";
			print_r($res);
		} else {
			echo "---------2-----------";
			print_r($res);
			printf("error: %s\n", mysqli_error($this->connection));
			die("hai");
		} */
		return $res;
	}
	public function random_password(){
		//Length 20 65-90 (A-Z) / 97-122 (a-z)
		$pass=chr(rand(65,90)).chr(rand(65,90)).chr(rand(97,122)).chr(rand(65,90)).rand(99,9999).chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90)).rand(9,9999).chr(rand(97,122)).chr(rand(65,90)).chr(rand(97,122)).rand(9,999).chr(rand(65,90));
		return $pass;
	}
	public function getOneValue($query)
	{
		
		$result=mysqli_query($this->connection,$query);
		$one='';
	    if($result)
	    {
 			while($row=mysqli_fetch_array($this->connection,$result))
	
 			{
		
 				$one=$row[0];
	
 			}
	    }
	    
 		return $one;
	}
	public function insertID(){
		return mysqli_insert_id($this->connection);
	}
	public function getOneArray($query)
	{
		
		$result=mysqli_query($this->connection,$query);
		$res[]='';
	    if($result)
	    {
 			while($row=mysqli_fetch_array($result))
	
 			{
		
 				$res[]=$row[0];
	
 			}
	    }
	    
 		return $res;
	}

	public function getResultsArrayCount($result)
	{
		$totalCounts = @mysqli_num_rows($result);
		return $totalCounts;
	}
	
	public function getResults($query) {
				
		$result = @mysqli_query($this->connection,$query);
		$totalCounts = @mysqli_num_rows($result);
		if ($totalCounts > 0) {
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$results[] = $row;
			}
			return $results;
		} else {
			return 0;
		}
	}
	
	public function getResultscount($query) {
				
		$result = mysqli_query($this->connection,$query);
		$totalCounts = @mysqli_num_rows($result);
		return $totalCounts;
		
	}
	public function redirectUrl($url){
		echo '<SCRIPT language="JavaScript">
			<!--
			window.location="'.$url.'";
			//-->
		</SCRIPT>';
	}

	public function month_between_days($from_date, $to_date){
		
	}
	
	public function days_in_month($month, $year) {
	if($month!=2) {
		if($month==9||$month==4||$month==6||$month==11)
			return 30;
		else
			return 31;
	}
	else{
		return $year%4==""&&$year%100!="" ? 29 : 28;
	}
}
    public function cur_month()
	{
	$timezone = new DateTimeZone("Asia/Kolkata");
	$date = new DateTime();
	$date->setTimezone($timezone);
	return  $date->format('m')."<br>";
	}
	public function cur_year()
	{
	$timezone = new DateTimeZone("Asia/Kolkata");
	$year = new DateTime();
	$year->setTimezone($timezone);
	return  $year->format('Y')."<br>";
	}
	function calculateWorkingDaysInMonth($year = '', $month = '')
	{
	//in case no values are passed to the function, use the current month and year
	if ($year == '')
	{
	
	$year = date('Y');
	}
	if ($month == '')
	
	{
	$month = date('m');
	}
	//create a start and an end datetime value based on the input year 
	
	$startdate = strtotime($year . '-' . $month . '-01');
	
	$enddate = strtotime('+' . (date('t',$startdate) - 1). ' days',$startdate);
	
	$currentdate = $startdate;
	//get the total number of days in the month	
	$return = intval((date('t',$startdate)),10);
	
	//loop through the dates, from the start date to the end date
	while ($currentdate <= $enddate)
	{
	
	//if you encounter a Saturday or Sunday, remove from the total days count
	if (/*(date('D',$currentdate) == 'Sat') ||*/ (date('D',$currentdate) == 'Sun'))
	
	{
	$return = $return - 1;
	}
	
	$currentdate = strtotime('+1 day', $currentdate);
	} //end date walk loop
	
	//return the number of working days
	return $return;
	}


public function dateDiff($start, $end) 
{
$start_ts = strtotime($start);
$end_ts = strtotime($end);
$diff = $end_ts - $start_ts;
$result= round($diff / 86400);
if($result!=0 && $result>=1) {
return $result;//." day ago";
} else {
return "Today";	
}
}

public function INRZero($num){
 $pos = strpos((string)$num, ".");
 if ($pos === false) {
 $decimalpart="00";
 }
 if (!($pos === false)) {
 $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos);
 }

 if(strlen($num)>3 & strlen($num) <= 12){
 $last3digits = substr($num, -3 );
 $numexceptlastdigits = substr($num, 0, -3 );
 $formatted = $this->makeComma($numexceptlastdigits);
 $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
 }elseif(strlen($num)<=3){
 $stringtoreturn = $num.".".$decimalpart ;
 }elseif(strlen($num)>12){
 $stringtoreturn = number_format($num, 2);
 }

 if(substr($stringtoreturn,0,2)=="-,"){
 $stringtoreturn = "-".substr($stringtoreturn,2 );
 }

 return $stringtoreturn;
 }

 public function INR($num){
 $pos = strpos((string)$num, ".");
 if ($pos === false) {
 $decimalpart="00";
 }
 if (!($pos === false)) {
 $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos);
 }

 if(strlen($num)>3 & strlen($num) <= 12){
 $last3digits = substr($num, -3 );
 $numexceptlastdigits = substr($num, 0, -3 );
 $formatted = $this->makeComma($numexceptlastdigits);
 $stringtoreturn = $formatted.",".$last3digits;
 }elseif(strlen($num)<=3){
 $stringtoreturn = $num;
 }elseif(strlen($num)>12){
 $stringtoreturn = number_format($num, 2);
 }

 if(substr($stringtoreturn,0,2)=="-,"){
 $stringtoreturn = "-".substr($stringtoreturn,2 );
 }

 return $stringtoreturn;
 }

 public function makeComma($input){
 // This function is written by some anonymous person - I got it from Google
 if(strlen($input)<=2)
 { return $input; }
 $length=substr($input,0,strlen($input)-2);
 $formatted_input = $this->makeComma($length).",".substr($input,-2);
 return $formatted_input;
 }

public function mysqldate($dateformat, $mysqdate, $convert = true) {
    global $local_time;
    $m = $mysqdate;
    if ( empty($m) ) {
        return false;
    }
    $i = mktime(
        (int) substr( $m, 11, 2 ), (int) substr( $m, 14, 2 ), (int) substr( $m, 17, 2 ),
        (int) substr( $m, 5, 2 ), (int) substr( $m, 8, 2 ), (int) substr( $m, 0, 4 )
    );

    if( 'U' == $dateformat )
        return $i;

    if ( -1 == $i || false == $i )
        $i = 0;

    if ( !empty($local_time->month) && !empty($local_time->weekday) && $convert ) {
        $datemonth = $local_time->get_month(date('m', $i));
        $datemonth_abbrev = $local_time->get_month_abbrev($datemonth);
        $dateweekday = $local_time->get_weekday(date('w', $i));
        $dateweekday_abbrev = $local_time->get_weekday_abbrev($dateweekday);
        $datemeridiem = $local_time->get_meridiem(date('a', $i));
        $datemeridiem_capital = $local_time->get_meridiem(date('A', $i));
        $dateformat = ' '.$dateformat;
        $dateformat = preg_replace("/([^\\\])D/", "\\1".backslashit($dateweekday_abbrev), $dateformat);
        $dateformat = preg_replace("/([^\\\])F/", "\\1".backslashit($datemonth), $dateformat);
        $dateformat = preg_replace("/([^\\\])l/", "\\1".backslashit($dateweekday), $dateformat);
        $dateformat = preg_replace("/([^\\\])M/", "\\1".backslashit($datemonth_abbrev), $dateformat);
        $dateformat = preg_replace("/([^\\\])a/", "\\1".backslashit($datemeridiem), $dateformat);
        $dateformat = preg_replace("/([^\\\])A/", "\\1".backslashit($datemeridiem_capital), $dateformat);

        $dateformat = substr($dateformat, 1, strlen($dateformat)-1);
    }
    $j = @date($dateformat, $i);
    if ( !$j ) {
    }
    return $j;
}
function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}
function limit_charecters($string, $charecter_limit)
{
	if(strlen($string)<=$charecter_limit) return $string;
    $string=substr($string,0,$charecter_limit);
	$words = explode(" ",$string);
    return implode(" ",array_splice($words,0,count($words)-1));
}
public function clean($str) {
$str = @$_POST[$str];
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($this->connection,$str);
	}
	public function clean_text($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($this->connection,$str);
	}
public function clean_amount($str) {
$str = @$_POST[$str]; 
		$str = str_replace(",", "", @trim($str));
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($this->connection,$str);
	}
		public function clean_comma($str) {
		$str = str_replace(",", "", @trim($str));
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($this->connection,$str);
	}

public function url_slug($str, $options = array()) {

	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
$str = $_POST[$str];
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

	

	$defaults = array(

		'delimiter' => '-',

		'limit' => null,

		'lowercase' => true,

		'replacements' => array(),

		'transliterate' => false,

	);

	

	// Merge options

	$options = array_merge($defaults, $options);

	

	$char_map = array(

		// Latin

		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 

		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 

		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 

		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 

		'ß' => 'ss', 

		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 

		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 

		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 

		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 

		'ÿ' => 'y',

 

		// Latin symbols

		'©' => '(c)',

 

		// Greek

		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',

		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',

		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',

		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',

		'Ϋ' => 'Y',

		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',

		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',

		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',

		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',

		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

 

		// Turkish

		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',

		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

 

		// Russian

		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',

		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',

		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',

		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',

		'Я' => 'Ya',

		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',

		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',

		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',

		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',

		'я' => 'ya',

 

		// Ukrainian

		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',

		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

 

		// Czech

		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 

		'Ž' => 'Z', 

		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',

		'ž' => 'z', 

 

		// Polish

		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 

		'Ż' => 'Z', 

		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',

		'ż' => 'z',

 

		// Latvian

		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 

		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',

		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',

		'š' => 's', 'ū' => 'u', 'ž' => 'z'

	);

	

	// Make custom replacements

	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

	

	// Transliterate characters to ASCII

	if ($options['transliterate']) {

		$str = str_replace(array_keys($char_map), $char_map, $str);

	}

	

	// Replace non-alphanumeric characters with our delimiter

	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

	

	// Remove duplicate delimiters

	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

	

	// Truncate slug to max. characters

	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

	

	// Remove delimiter from ends

	$str = trim($str, $options['delimiter']);

	

	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;

}

public function url_slug_name($str, $options = array()) {

	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

	

	$defaults = array(

		'delimiter' => '-',

		'limit' => null,

		'lowercase' => true,

		'replacements' => array(),

		'transliterate' => false,

	);

	

	// Merge options

	$options = array_merge($defaults, $options);

	

	$char_map = array(

		// Latin

		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 

		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 

		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 

		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 

		'ß' => 'ss', 

		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 

		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 

		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 

		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 

		'ÿ' => 'y',

 

		// Latin symbols

		'©' => '(c)',

 

		// Greek

		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',

		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',

		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',

		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',

		'Ϋ' => 'Y',

		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',

		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',

		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',

		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',

		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

 

		// Turkish

		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',

		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

 

		// Russian

		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',

		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',

		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',

		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',

		'Я' => 'Ya',

		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',

		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',

		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',

		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',

		'я' => 'ya',

 

		// Ukrainian

		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',

		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

 

		// Czech

		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 

		'Ž' => 'Z', 

		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',

		'ž' => 'z', 

 

		// Polish

		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 

		'Ż' => 'Z', 

		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',

		'ż' => 'z',

 

		// Latvian

		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 

		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',

		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',

		'š' => 's', 'ū' => 'u', 'ž' => 'z'

	);

	

	// Make custom replacements

	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

	

	// Transliterate characters to ASCII

	if ($options['transliterate']) {

		$str = str_replace(array_keys($char_map), $char_map, $str);

	}

	

	// Replace non-alphanumeric characters with our delimiter

	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

	

	// Remove duplicate delimiters

	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

	

	// Truncate slug to max. characters

	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

	

	// Remove delimiter from ends

	$str = trim($str, $options['delimiter']);

	

	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;

}
 public function ImportShippingRates()
 {
	 $row = 1;
$filename=rand(99,9999).$_FILES['file']['name'];
$target="upload/".$filename;
move_uploaded_file($_FILES['file']['tmp_name'],$target);

if (($handle = fopen($target, "r")) !== FALSE) { $i=0;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { $i++;
      if($i>1) {
		$res=$this->Query("select count(car_id) as cnt from tbl_shipping_rates where car_id=".$data[0]." and country_name='".$data[1]."' and city_name='".$data[2]."'");
		$count=mysql_fetch_array($res);
		if($count['cnt']>0) {
			$this->Query("update tbl_shipping_rates set car_id=".$data[0].",country_name='".$data[1]."',city_name='".$data[2]."',amount=".$data[3]." where car_id=".$data[0]." and country_name='".$data[1]."' and city_name='".$data[2]."'");
		}
		else 
            $this->Query("insert into tbl_shipping_rates set car_id=".$data[0].",country_name='".$data[1]."',city_name='".$data[2]."',amount=".$data[3]);
    } }
    fclose($handle);
}
header("location:import.php?msg=upd");
 }
 public function machine_coverimage($id){
	 $machine=$this->getRow("select * from machines where id=".$id);
	 $coverimg=$this->getRow("select * from machineimages where cover_image='yes' and machine_id=".$id);
	 $imgs=$this->getRow("select * from machineimages where machine_id=".$id);
	 if(!empty($coverimg)){
		 	$cimg=DIR_MIMG.$coverimg['image_name'];
	 } else if(!empty($machine) && $machine['thumbnail']!=""){
		 	$cimg=DIR_MIMG.$resultmakerimages['image_name'];
	 } else if(!empty($imgs)){
		 	$cimg=DIR_MIMG.$imgs['image_name'];
	 } else $cimg=DIR_IMGS.'imgs/ask-car-small.jpg';
	return $cimg;
 }
  public function car_coverimage($id){ 
	 $car=$this->getRow("select * from cars where id=".$id);
	 $coverimg=$this->getRow("select * from carimages where status='yes' and car_id=".$id);
	 $imgs=$this->getRow("select * from carimages where car_id=".$id);
	 if(!empty($coverimg)){
		 	$cimg=DIR_CIMG.$coverimg['image_name'];
	 } else if(!empty($car) && $car['thumbnail']!=""){
		 	$cimg=DIR_CIMG.$resultmakerimages['image_name'];
	 } else if(!empty($imgs)){
		 	$cimg=DIR_CIMG.$imgs['image_name'];
	 } else $cimg=DIR_IMGS.'imgs/ask-car-small.jpg';
	return $cimg;
 }
 public function medical_coverimage($id){ 
	 $coverimg=$this->getRow("select * from pu_medical_images where cover='yes' and equip_id=".$id);
	 $imgs=$this->getRow("select * from pu_medical_images where equip_id=".$id);
	 if(!empty($coverimg)){
		 	$cimg=DIR_MEDICAL_IMAGE.$coverimg['image_name'];
	 } else if(!empty($imgs)){
		 	$cimg=DIR_MEDICAL_IMAGE.$imgs['image_name'];
	 } else $cimg=DIR_IMGS.'imgs/ask-car-small.jpg';
	return $cimg;
 }
 public function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ' ';
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
        return $negative . $this->convert_number_to_words(abs($number));
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
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
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

public function getUniqueID($id){ //get id from customer ID		
		$type=substr($id, strlen(ID_PREFIX),2);
		$aid=substr($id, (strlen(ID_PREFIX)+2));
		return ltrim($aid, '0');
	}
public function getUniqueType($id){ //get id from customer ID		
		$type=substr($id, strlen(ID_PREFIX),2);
		return $type;
	}

	public function getCusID($id){ 
		$cus=$this->getRow("select * from customer where id=".$id);
		$prefix=ID_PREFIX;
		if($cus['customer_type']=='dealer') $prefix=ID_PREFIX."DL";
		else if($cus['customer_type']=='mediator') $prefix=ID_PREFIX."DL";
		else if($cus['customer_type']=='customer') $prefix=ID_PREFIX."CS";
		if($cus['customer_id'] <10) $id="000".$cus['customer_id'];
		else if($cus['customer_id'] <100) $id="00".$cus['customer_id'];
		else if($cus['customer_id'] <1000) $id="0".$cus['customer_id'];
		else $id=$cus['customer_id'];
		return $prefix.$id;
		//return 'AS0004';
	}

	public function getEmpID($id){ 
		$cus=$this->getRow("select * from user where employee_id=".$id);
		$prefix=ID_PREFIX;
		if($cus['employee_id'] <10) $id="00".$cus['employee_id'];
		else if($cus['employee_id'] <100) $id="0".$cus['employee_id'];
		else $id=$cus['employee_id'];
		return $prefix.$id;
	}

	public function getVendorID($id){ 
		$cus=$this->getRow("select * from vendor where id=".$id);
		$prefix=ID_PREFIX;
		if($cus['vendor_type']=='finance') $vendor_prefix=FINANCE_VENDOR_PREFIX;
		if($cus['vendor_id'] <10) $id="00".$cus['vendor_id'];
		else if($cus['vendor_id'] <100) $id="0".$cus['vendor_id'];
		else $id=$cus['vendor_id'];
		return $prefix.$vendor_prefix.$id;
	}

	public function BMV($maker,$model,$varient){
		$maker=$this->getRow("select * from maker where id=".$maker);
        $model=$this->getRow("select * from model where id=".$model);
        $varient=$this->getRow("select * from varient where id='".$varient."'");
        $bmv=$maker['maker_name']." ".$model['model_name']." ".$varient['varient_name'];
        return $bmv;
	}
	public function BM($maker,$model){
		$maker=$this->getRow("select * from maker where id=".$maker);
        $model=$this->getRow("select * from model where id=".$model);
        $bmv=$maker['maker_name']." ".$model['model_name'];
        return $bmv;
	}
	public function getCreditorName($id){
		$result=$this->getRow("select * from credit where id=".$id);
		if($result['customer_type']=='dealer'){ 
			$res=$this->getRow("select * from customer where id=".$result['parent_id']);
			$cname=$res['cname']."-D";
		} else if($result['customer_type']=='finance'){
		    $res=$this->getRow("select * from vendor where id=".$result['parent_id']);
		    $cname=$res['vendor_name']."-F";
		}
		return $cname;
	}
	public function CreditStatusUpdate($id){
		$res=$this->getRow("select * from credit where id=".$id);
		
		$result=$this->getRow("select sum(amount) as amount from credit_payment where parent_id='".$id."' and payment_for='receive'");
		if(!empty($result)){
			$amount=$result['amount'];
		} else $amount=0;
		if($res['amount']==$amount){
			$this->Query("update credit set payment_status='paid' where id=".$res['id']);
		} 
	}

	public function UpdateCustomerID($customer_type,$id){
		if($customer_type=='dealer' || $customer_type=='mediator') 
		$cnt=$this->getRow("select max(customer_id) as cusid from customer where customer_type='dealer' or customer_type='mediator' order by customer_id desc");
		else 
		$cnt=$this->getRow("select max(customer_id) as cusid from customer where customer_type='".$customer_type."' order by customer_id desc");

		if(!empty($cnt)){
			$customer_id=$cnt['cusid']+1;

			$prefix=ID_PREFIX;
		if($customer_type=='dealer' || $customer_type=='mediator') $prefix=ID_PREFIX."DL";
		else if($customer_type=='customer') $prefix=ID_PREFIX."CS";
		if($customer_id <10) $cid="000".$customer_id;
		else if($customer_id <100) $cid="00".$customer_id;
		else if($customer_id <1000) $cid="0".$customer_id;
		else $cid=$customer_id;
		$customer_code=$prefix.$cid;

			$this->Query("update customer set customer_id=".($cnt['cusid']+1).", customer_code='".$customer_code."' where id=".$id);
		}
		else{
			$customer_id=1;
			$prefix=ID_PREFIX;
		if($customer_type=='dealer' || $customer_type=='mediator') $prefix=ID_PREFIX."DL";
		else if($customer_type=='customer') $prefix=ID_PREFIX."CS";
		if($customer_id <10) $cid="000".$customer_id;
		else if($customer_id <100) $cid="00".$customer_id;
		else if($customer_id <1000) $cid="0".$customer_id;
		else $cid=$customer_id;
		$customer_code=$prefix.$cid;
			$this->Query("update customer set customer_id=1, customer_code='".$customer_code."' where id=".$id);
		}
	}


}

$objMain = new Main();

?>
