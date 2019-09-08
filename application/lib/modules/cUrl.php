<?php

namespace application\lib\modules;
use application\lib\Requirement;

interface cUrlInt
{
    public static function headerParser($dataForParsing);
    public static function reviewParser($dataForParsing);
    public static function allParser($dataForParsing);
}

final class cUrl implements cUrlInt
{
    public static function parserData($url=NULL, $setting=NULL)
    {
        if( ($url != NULL) && (is_bool($setting) == true) ):
            return array(
                'url' => $url,
                'setting' => $setting
            );
        else:
            //Requirement::mvcException();
            die();
        endif;
    }

    public static function headerParser($dataForParsing)
    {
        $curl = curl_init($dataForParsing['url']);
        curl_setopt($curl, CURLOPT_HEADER, $dataForParsing['setting']);
        return  self::dataFinish($curl, $dataForParsing['setting']);
    }

    public static function reviewParser($dataForParsing)
    {
        $curl = curl_init($dataForParsing['url']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $dataForParsing['setting']);
        return  self::dataFinish($curl, $dataForParsing['setting']);
    }

    public static function allParser($dataForParsing)
    {
        $curl = curl_init($dataForParsing['url']);
        curl_setopt($curl, CURLOPT_HEADER, $dataForParsing['setting']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $dataForParsing['setting']);
        return  self::dataFinish($curl, $dataForParsing['setting']);
    }

    private static function dataFinish($curlData, $setting)
    {
        switch ($setting):
            case true:
                return json_decode(curl_exec($curlData));
                break;
            case false:
                return curl_exec($curlData);
                break;
        endswitch;
    }
}

?>