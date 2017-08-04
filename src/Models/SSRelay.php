<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 21/06/17
 * Time: 15:01
 */

namespace Tchoblond59\SSRelay\Models;


use App\Sensor;
use Tchoblond59\SSRelay\Models\SSRelayConfig;
use App\Message;
use DB;

class SSRelay extends Sensor
{
    public function getWidget(\App\Widget $widget)
    {
        $sensor  = $widget->sensor;
        $state = 0;
        $last_message = Message::where('node_address', '=', $sensor->node_address)
            ->where('sensor_address', '=', $sensor->sensor_address)
            ->orderBy('created_at', 'desc')->first();

        if($last_message!=null)
        {
            $state = $last_message->value;
        }
        $ssrelay_config = SSRelayConfig::getFromSensor($sensor->id);
        if($ssrelay_config==null)
        {
            $ssrelay_config = new SSRelayConfig();
            $ssrelay_config->sensor_id = $sensor->id;
            $ssrelay_config->type = 'default';
            $ssrelay_config->save();
        }

        return view('sensors.ssrelay.widget')->with(['widget' => $widget,
        'sensor' => $sensor,
        'state' => $state,
        'ssrelay_config' => $ssrelay_config ]);
    }

    /*public function getCss()
    {
        return ['mycss.css'];
    }*/

    public function getJs()
    {
        return ['js/tchoblond59/ssrelay/ssrelay.js'];
    }
    public function getWidgetList()
    {
        return [1 => 'Relay NONC'];
    }

    public function onDelete()
    {
        DB::table('ssrelay_config')->where('sensor_id', '=', $this->id)->delete();
    }
}