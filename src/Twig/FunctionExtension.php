<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FunctionExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'datePassed']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('changeDate', [$this, 'datePassed']),
        ];
    }

    public function datePassed($date)
    {
        if(!ctype_digit($date)) {
		$date = strtotime($date);
	}
	if(date('Ymd', $date) == date('Ymd')) {
		$diff=(time())-$date;
		if($diff<60) {
			return 'Il y a '.$diff.' sec';
		}
		else if($diff < 3600) {
			return 'Il y a '.round($diff/60, 0).' min';
		}
		else if($diff<10800) {
			return 'Il y a '.round($diff/3600, 0).' heures';
		}
		else {
			return 'Aujourd\'hui à '.date('H:i', $date);
		}
	}
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY'))) {
		return 'Hier à '.date('H:i', $date);
	}
	else {
		$dateFR = utf8_encode(strftime('%e ',$date));
	    $dateFR .= utf8_encode(ucfirst(strftime('%B %Y',$date)));
		return $dateFR;
	}
    }
}
