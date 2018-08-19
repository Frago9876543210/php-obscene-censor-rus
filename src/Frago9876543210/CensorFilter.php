<?php

declare(strict_types=1);

namespace Frago9876543210;


class CensorFilter{
	const P = 'пПnPp';
	const I = 'иИiI1u';
	const E = 'еЕeE';
	const D = 'дДdD';
	const Z = 'зЗ3zZ3';
	const M = 'мМmM';
	const U = 'уУyYuU';
	const O = 'оОoO0';
	const L = 'лЛlL';
	const S = 'сСcCsS';
	const A = 'аАaA@';
	const N = 'нНhH';
	const G = 'гГgG';
	const CH = 'чЧ4';
	const K = 'кКkK';
	const C = 'цЦcC';
	const R = 'рРpPrR';
	const H = 'хХxXhH';
	const YI = 'йЙy';
	const YA = 'яЯ';
	const YO = 'ёЁ';
	const YU = 'юЮ';
	const B = 'бБ6bB';
	const T = 'тТtT';
	const HS = 'ъЪ';
	const SS = 'ьЬ';
	const Y = 'ыЫ';
	const SH = "шшЩЩ";
	const V = "вВvVBb";
	const EXCEPTIONS = [
		'команд','манду', 'рубл', 'премь', 'оскорб', 'краснояр', 'бояр', 'ноябр', 'карьер', 'мандат',
		'употр', 'плох', 'интер', 'веер', 'фаер', 'феер', 'hyundai', 'тату', 'браконь',
		'roup', 'сараф', 'держ', 'слаб', 'ридер', 'истреб', 'потреб', 'коридор', 'sound', 'дерг',
		'подоб', 'коррид', 'дубл', 'курьер', 'экст', 'try', 'enter', 'oun', 'aube', 'ibarg', '16',
		'kres', 'глуб', 'ebay', 'eeb', 'shuy', 'ансам', 'cayenne', 'ain', 'oin', 'тряс', 'ubu', 'uen',
		'uip', 'oup', 'кораб', 'боеп', 'деепр', 'хульс', 'een', 'ee6', 'ein', 'сугуб', 'карб', 'гроб',
		'лить', 'рсук', 'влюб', 'хулио', 'ляп', 'граб', 'ибог', 'вело', 'ебэ', 'перв', 'eep', 'ying',
		'laun', 'чаепитие', 'oub', 'мандарин', 'гондольер', 'гоша', 'фраг', 'гав', 'говор', 'гавор',
		'помога', 'памага', 'гов', 'огонь', 'o1b2', 'ведро', 'догон'
	];

	public static function filterText(string $text, string $replace = "*") : string{
		preg_match_all('/
\b\d*(
	\w*[' . self::P . '][' . self::I . self::E . '][' . self::Z . '][' . self::D . ']\w* # пизда
|
	(?:[^' . self::I . self::U . '\s]+|' . self::N . self::I . ')?(?<!стра)[' . self::H . '][' . self::U . '][' . self::YI . self::E . self::YA . self::YO . self::I . self::L . self::YU . '](?!иг)\w* # хуй; не пускает "подстрахуй", "хулиган"
|
	\w*[' . self::B . '][' . self::L . '](?:
		[' . self::YA . ']+[' . self::D . self::T . ']?
		|
		[' . self::I . ']+[' . self::D . self::T . ']+
		|
		[' . self::I . ']+[' . self::A . ']+
	)(?!х)\w* # бля, блядь; не пускает "бляха"
|
	(?:
		\w*[' . self::YI . self::U . self::E . self::A . self::O . self::HS . self::SS . self::Y . self::YA . '][' . self::E . self::YO . self::YA . self::I . '][' . self::B . self::P . '](?!ы\b|ол)\w* # не пускает "еёбы", "наиболее", "наибольшее"...
		|
		[' . self::E . self::YO . '][' . self::B . ']\w*
		|
		[' . self::I . '][' .
			self::B . '][' . self::A . ']\w+
		|
		[' . self::YI . '][' . self::O . '][' . self::B . self::P . ']\w*
	) # ебать
|
	\w*[' . self::S . '][' . self::C . ']?[' . self::U . ']+(?:
		[' . self::CH . ']*[' . self::K . ']+
		|
		[' . self::CH . ']+[' . self::K . ']*
	)[' . self::A . self::O . self::I . ']\w* # сука
|
	\w*(?:
		[' . self::P . '][' . self::I . self::E . '][' . self::D . '][' . self::A . self::O . self::E . ']?[' . self::R . '](?!о)\w* # не пускает "Педро"
		|
		[' . self::P . '][' . self::E . '][' . self::D . '][' . self::E . self::I . ']?[' . self::G . self::K . ']
	) # пидарас
|
	\w*[' . self::Z . '][' . self::A . self::O . '][' . self::L . '][' . self::U . '][' . self::P . ']\w* # залупа
|
	\w*[' . self::M . '][' . self::A . '][' . self::N . '][' . self::D . '][' . self::A . self::O . self::U . ']\w* # манда
|
	\w*[' . self::SH . '][' . self::L . '][' . self::U . self::YU . '][' . self::H . ']*\w* # шлюха
|
	\w*[' . self::S . '][' . self::E . '][' . self::K . '][' . self::S . ']\w* # секс
|
	\w*[' . self::G . ' ][' . self::A . self::O . '][' . self::V . '][' . self::N . ']*\w* # говно
|
	\w*[' . self::G . '][' . self::A . self::O . '][' . self::N . '][' . self::D . ']*\w* #гондон
|
	\w*[' . self::D . '][' . self::R . '][' . self::O . '][' . self::CH . ']*\w* #дрочить
)\b
/xu', $text, $m);
		if(($count = count($m[1])) < 0){
			return $text;
		}
		for($i = 0; $i < $count; $i++){
			$word = mb_strtolower($m[1][$i]);
			foreach(self::EXCEPTIONS as $exception){
				if(mb_strpos($word, $exception) !== false){
					unset($m[1][$i], $word);
					break;
				}
			}
			if(isset($word)){
				$m[1][$i] = str_replace([' ', ',', ';', '.', '!', '-', '?', "\t", "\n"], '', $m[1][$i]);
			}
		}
		$m[1] = array_unique($m[1]);
		$bad = [];
		foreach($m[1] as $word){
			$bad[] = str_repeat($replace, mb_strlen($word));
		}
		return str_replace($m[1], $bad, $text);
	}

	public static function isAllowed(string $text) : bool{
		return $text === self::filterText($text);
	}
}
