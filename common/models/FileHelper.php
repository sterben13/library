<?php 
namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class FileHelper
{

	private $destination;

	public function __construct($destination)
	{
		$this->destination = $destination;
		Yii::info('Constructor inicializated: ' . $this->destination);
	}

	public function upload($file, $name){

		if(!$file) return null;

		Yii::info('Storing file on path: ' . $this->destination);
		$filePath = $this->destination . $name . '.' .$file->extension;
        if($file->saveAs($filePath, false)){
            Yii::info('File stored');
            return Url::to('@web/' . $filePath);
        } else {
            Yii::info('File NOT stored');
            return null;
        }
	}
}

?>