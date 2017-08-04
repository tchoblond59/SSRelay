<?php

namespace Tchoblond59\SSRelay\Models;

use Illuminate\Database\Eloquent\Model;

class SSRelayConfig extends Model
{
    protected $table = "ssrelay_config";

    public $timestamps = false;

    public static function getFromSensor($sensor_id)
    {
        return SSRelayConfig::where('sensor_id', '=', $sensor_id)->first();
    }
}
