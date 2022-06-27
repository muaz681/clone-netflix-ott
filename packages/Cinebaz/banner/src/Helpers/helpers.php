<?php

use Cinebaz\Banner\Models\Slider;
use Cinebaz\Media\Models\Media;

if (!function_exists('is_banner')) {
    function is_banner()
    {

        return true;
    }
}

if (!function_exists('getSliderArr')) {
    function getSliderArr()
    {
        $data = Slider::get();
        $result = [];
        foreach($data as $list){
            $result[$list->id] = $list->title;
        }

        return $result;
    }
}
if (!function_exists('getMeidaArr')) {
    function getMeidaArr()
    {

        $data = Media::get();
        $result = [];
        foreach($data as $list){
            $result[$list->id] = $list->title_en;
        }

        return $result;
    }
}
if (!function_exists('getSliderImage')) {
    function getSliderImage($data, $size ='small')
    {

        $find = $data->getImage;
        if($find){
            return asset('storage/'.$find->$size);
        }else{
            $find = ($data->Bannermedia && $data->Bannermedia->featuredL)? $data->Bannermedia->featuredL: null;
            if($find){
            return asset('storage/'.$find->$size);
            }
        }
        return null;

    }
}
if (!function_exists('getSliderTitle')) {
    function getSliderTitle($data)
    {

        if(isset($data->title)){
            return $data->title;
        }elseif(isset($data->Bannermedia)){
            return $data->Bannermedia->title_en;
        }

    }
}

if (!function_exists('getSliderDescription')) {
    function getSliderDescription($data)
    {

        if(isset($data->description)){
            return $data->description;
        }elseif(isset($data->Bannermedia)){
            return $data->Bannermedia->description_en;
        }

    }
}

if (!function_exists('getSliderDetails')) {
    function getSliderDetails($data)
    {

        if(isset($data->slug)){
            return $data->slug;
        }elseif(isset($data->Bannermedia)){
            return $data->Bannermedia->slug;
        }

    }
}

if (!function_exists('getSliderButton')) {
    function getSliderButton($data)
    {

        if(isset($data->button_link)){
            return $data->button_link;
        }elseif(isset($data->Bannermedia)){
            return $data->Bannermedia->trailer_url;
        }

    }
}
