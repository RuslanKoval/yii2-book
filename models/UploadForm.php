<?php

namespace app\models;


use Yii;
use yii\base\Model;

class UploadForm extends Model
{
    const FIXTURE_PATCH = '@app/web/fixtureImages';
    const IMAGE_PATCH = '@app/web/images';


    public function uploadDemoImg($name)
    {
        $patch = Yii::getAlias(self::FIXTURE_PATCH);
        $image = $patch.'/'.$name.'.jpg';
        $newPatch = Yii::getAlias(self::IMAGE_PATCH);

        if($this->checkFile($image)) {
            $newImageName = Yii::$app->getSecurity()->generateRandomString(rand(10,30)).'.jpg';
            if(copy($image, $newPatch.'/'.$newImageName)) {
                return $newImageName;
            }

        }

        return null;
    }

    public function checkFile($patch)
    {
        return file_exists($patch);
    }
}