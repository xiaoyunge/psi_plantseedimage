<?php

namespace app\psi\_stuff;
use app\psi\model\Species as SpeciesModel;
use app\psi\_stuff\Config as CustomConfig;

class Stuff {
    public static function generateSpeciesId( ){
        $speciesIdList = [];
        $speciesImageUrlList =[];
        $imageRootUrl = CustomConfig::$config['view']['__IMG_SPECIES__'];
        $specieses = SpeciesModel::order("id")->limit(5)->select();
        //dump($specieses->toArray());
        foreach ($specieses as $species) {
            array_push($speciesIdList, $species->id);
        }
        foreach ($speciesIdList as $id) {
            $url = "$imageRootUrl/$id/seed/$id"."_1.jpg";
            array_push($speciesImageUrlList, $url);
        }
        return $speciesImageUrlList;
    }
}
