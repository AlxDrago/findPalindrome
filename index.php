<?php

$str = 'Sum summus mus';
$str = 'А роза упала на лапу Азора!';
$str = 'банана';

class Palindrome
{
    /**
     * @param $str
     */
	public static function start ($str) {
	    $arr = self::compareStr($str);
		$res = self::getPalindrome($arr);

		$res === 1 ? $res = $str : $res = self::getPodPalindrome($arr);

		echo $res;
	}

    /**
     * Метод преобразования и очистки строки в массив
     * @param $str
     * @return array
     */
	public static function compareStr($str){
        $str = mb_strtolower($str);
		$arr = preg_split('//u',$str);

		foreach ($arr as $key => $value) {
			if(preg_match_all('/\s/', $value) >= 1 || empty($value)) {
				unset($arr[$key]);
			}
		}
		return array_values($arr);
	}

    /**
     * Проверка на палиндром
     * @param $arr
     * @return int
     */
	public static function getPalindrome($arr) {
		$count = floor(count($arr) / 2);
		$error = 0;

		for($i=0; $i<$count; $i++) {
			if($arr[$i] !== $arr[count($arr) - (1 + $i)]) {
				$error = 1;
				break;
			}
		}

        $error === 1 ? $response = 0 : $response = 1;
		return $response;
	}

    /**
     * Метод поиска смаого длинного под-палиндрома строки
     * @param $arr
     * @return mixed
     */
	public static function getPodPalindrome ($arr) {
	    $result = [];

        for ($i=0; $i < count($arr); $i++) {
            $left = [];
            $right = [];
            for($j=0; $j < count($arr); $j++) {
                if (isset($arr[$i - $j]) && isset($arr[$i + $j]) && $arr[$i - $j] === $arr[$i + $j]) {
                    $right[] = $arr[$i - $j];
                    $left[] = $arr[$i + $j];
                } elseif(isset($arr[$i-$j]) && isset($arr[$i+ ($j + 1)]) && $arr[$i - $j] === $arr[$i+($j + 1)]){
                    $right[] = $arr[$i - $j];
                    $left[] = $arr[$i + ($j + 1)];
                } else {
                    unset($right[0]);
                    $result[] = implode(array_reverse($right)) . implode ($left);

                    break;
                }
            }
        }
        $max = 0;
        foreach ($result as $key => $value) {
            if(mb_strlen($value) > $max) {
                $max = mb_strlen($value);
                $result['result'] = $value;
            }
        }
	    return $result['result'];
    }
}

Palindrome::start($str);