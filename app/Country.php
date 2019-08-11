<?php
declare(strict_types=1);

namespace App;

class Country extends \stdClass
{
    public static function instance($id, $name)
    {
        $country = new self();
        $country->id = $id;
        $country->name = $name;

        return $country;
    }
}
