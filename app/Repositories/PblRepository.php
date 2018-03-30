<?php

namespace App\Repositories;
use Illuminate\Http\Request;

// use DB;
use App\User;
use App\Role;
use App\Order;

class PblRepository {
	
	public function checkNewOrders() {
		$ords_new = Order::where('status', 0)->count();
		return $ords_new;
	}
	
    public function checkEnter($permit = FALSE) {

        // $userid = \Entrust::user()->id;
        if (\Entrust::hasRole(['admin', 'editor'])) {
            $permit = TRUE;
        }

        return $permit;
    }

    public function transliterate($string) {
		$str = mb_strtolower($string, 'UTF-8');
		
		$leter_array = array(
			'a' => 'а',
			'b' => 'б',
			'v' => 'в',
			'g' => 'г,ґ',
			'd' => 'д',
			'e' => 'е,є,э',
			'jo' => 'ё',
			'zh' => 'ж',
			'z' => 'з',
			'i' => 'и,і',
			'ji' => 'ї',
			'j' => 'й',
			'k' => 'к',
			'l' => 'л',
			'm' => 'м',
			'n' => 'н',
			'o' => 'о',
			'p' => 'п',
			'r' => 'р',
			's' => 'с',
			't' => 'т',
			'u' => 'у',
			'f' => 'ф',
			'kh' => 'х',
			'ts' => 'ц',
			'ch' => 'ч',
			'sh' => 'ш',
			'shch' => 'щ',
			'' => 'ъ',
			'y' => 'ы',
			'' => 'ь',
			'yu' => 'ю',
			'ya' => 'я',
		);
		
		if(preg_match('/[^\\p{Common}\\p{Latin}]/u', $str)) {
			foreach($leter_array as $leter => $kyr) {
				$kyr = explode(',',$kyr);
				$str = str_replace($kyr,$leter, $str);
			}
		} 
		
		$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);
		
		$str = trim($str,'-');
		
		return $str;
	}

}

?>