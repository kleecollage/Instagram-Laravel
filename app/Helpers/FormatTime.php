<?php
namespace App\Helpers;

use Carbon\Carbon;

class FormatTime {

    public static function LongTimeFilter($date) {
        if ($date == null) {
            return "Sin fecha";
        }

        // Convertir la fecha en un objeto Carbon si es necesario
        $start_date = $date instanceof Carbon ? $date : new Carbon($date);
        $since_start = $start_date->diff(Carbon::now());

        if ($since_start->y > 0) {
            $result = $since_start->y == 1 ? '1 año' : $since_start->y . ' años';
        } elseif ($since_start->m > 0) {
            $result = $since_start->m == 1 ? '1 mes' : $since_start->m . ' meses';
        } elseif ($since_start->d > 0) {
            $result = $since_start->d == 1 ? '1 día' : $since_start->d . ' días';
        } elseif ($since_start->h > 0) {
            $result = $since_start->h == 1 ? '1 hora' : $since_start->h . ' horas';
        } elseif ($since_start->i > 0) {
            $result = $since_start->i == 1 ? '1 minuto' : $since_start->i . ' minutos';
        } else {
            $result = $since_start->s == 1 ? '1 segundo' : $since_start->s . ' segundos';
        }

        return "Hace " . $result;
    }
}
