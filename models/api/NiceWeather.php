<?php

namespace app\models\api;

use Yii;
use yii\base\Model;

class NiceWeather extends Model
{

    public $city;
    public $lat;
    public $lng;

    public function rules()
    {
        return [
            ['city','string'],
            [['lat','lng'],'number'],

        ];
    }

    public function getForecast()
    {
        //获取数据
        $data =  $this->dayForecast();
        return $data;
    }

    public function load($data, $model = '')
    {

        $res = parent::load($data,$model);
        if($this->city && !$this->lat && !$this->lng)
        {
            if( $this->getGeoInfo() )
            {
                return $res;
            }
            else
            {
                return false;
            }
        }
        return $res;
    }

    private function getGeoInfo()
    {
        $url = "http://api.map.baidu.com/geocoder/v2/?address=".$this->city."&output=json&ak=RD914Pml5GFLIIAbtYium4iU";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        if(!$output)
        {
            var_dump(curl_error($ch));
        }
        curl_close($ch);
        if($output)
        {
           $data = json_decode($output,true);
           if($data && $data['status'] == 0)
           {

            $this->lat = sprintf("%.2f",$data['result']['location']['lat']);
            $this->lng = sprintf("%.2f",$data['result']['location']['lng']);
            return true;
           }
        }

        return false;
    }

    private function getWeatherInfo($type)
    {
        if($type == 'current')
        {
            $str = "wxd/v2/DHRecord/zh_CN/%s,%s";
        }
        else
        {
            $str = "/wxd/v2/15DayForecast/zh_CN/%s,%s";
        }

        $str = sprintf($str,$this->lat,$this->lng);
        $url = "http://dsx.weather.com/(%s)?api=7bb1c920-7027-4289-9c96-ae5e263980bc";
        $url = sprintf($url,$str);
        if(is_file('./'.md5($url)))
        {
            $output = file_get_contents('./'.md5($url));
            if($output)
            {

                return json_decode($output,true);
            }
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        if(!$output)
        {
            var_dump(curl_error($ch));
        }
        curl_close($ch);
        if($output)
        {
            file_put_contents('./'.md5($url), $output);
            return json_decode($output,true);
        }
    }

    private function dayForecast()
    {
        $info = $this->getWeatherInfo('cc');
        if(!$info)
        {
            return;
        }

        if(isset($info[0]) && isset($info[0]['doc']) && isset($info[0]['doc']['fcstdaily15alluoms']))
        {
            $datas = $info[0]['doc']['fcstdaily15alluoms']['forecasts'];
            $forecasts = [];
            foreach ($datas as $key => $data) {
                $item = $this->getItem($data);
                if($item)
                    $forecasts[] = $item;

            }
            return $forecasts;
        }
    }

    private function getItem($data)
    {

        $item = [];
        if(isset($data['day']))
        {
            $item['type'] = $data['day']['precip_type'];//天气英文
            $item['week'] = $data['day']['daypart_name'];
        }
        $item['sunrise'] = strtotime($data['sunrise']);//日出时间
        $item['sunset'] = strtotime($data['sunset']);//日落
        $item['moonrise'] = strtotime($data['moonrise']);//月出
        $item['moonset'] = strtotime($data['moonset']);//月落

        $item['metric'] = [
            "max_temp"=>$data['metric']['max_temp'],
            "min_temp"=>$data['metric']['min_temp'],
            "narrative"=>$data['metric']['narrative'],
        ];
        $item['imperial'] = [
            "max_temp"=>$data['imperial']['max_temp'],
            "min_temp"=>$data['imperial']['min_temp'],
            "narrative"=>$data['imperial']['narrative'],
        ];
        return $item;
    }
}
