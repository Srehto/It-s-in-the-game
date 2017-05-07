<?php

	class Date
	{
	
		public static function getMois($numero)
		{
			if($numero == '01')
				return 'Janvier';
			else if($numero == '02')
				return 'Février';
			else if($numero == '03')
				return 'Mars';
			else if($numero == '04')
				return 'Avril';
			else if($numero == '05')
				return 'Mai';
			else if($numero == '06')
				return 'Juin';
			else if($numero == '07')
				return 'Juillet';
			else if($numero == '08')
				return 'Août';
			else if($numero == '09')
				return 'Septembre';
			else if($numero == '10')
				return 'Octobre';
			else if($numero == '11')
				return 'Novembre';
			else if($numero == '12')
				return 'Décembre';
		}


		public static function toString($date)
		{
			$heure = substr($date, 11);
			if($heure)
				$heure = Date::toStringHeure($heure);
			$date = Date::toStringDate(substr($date, 0, 10));
			return $date . ' ' . $heure;
		}
	
		public static function toStringDate($date)
		{
			$annee = substr($date, 0, 4);
			$mois = Date::getMois(substr($date, 5, 2));
			$jour = substr($date, -2);
			return $jour . ' ' . $mois . ' ' . $annee;
		}
	
		public static function toStringHeure($heure)
		{
			return substr($heure, 0, 5);
		}
	}

?>