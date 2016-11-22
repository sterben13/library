<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

use yii\web\UploadedFile;
/**
 * This is the model class for table "document".
 *
 */
class BookForm extends Model
{
    public $id;
    public $isbn;
    public $title;
    public $author;
    public $abstract;
    public $coverFile;
    public $editorial;
    public $categories;
    public $coverUrl;

    public $isNewRecord;

    function __construct() {
        $this->isNewRecord = true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'title', 
                'isbn', 
                'author',
                'categories',
            ], 'required'],
            ['categories', 'each', 'rule' => ['string']],
            [['coverFile'], 'file', 'skipOnEmpty' => true,
                'uploadRequired' => 'No has seleccionado ningún archivo', 
                'maxSize' => 1024*1024*8, //
                'tooBig' => 'El tamaño máximo permitido es 1MB', 
                'minSize' =>  10 ,
                'extensions' => 'png, jpg, jpeg',
                'wrongExtension' => 'El archivo {file} es una extensión no permitida {extensions}',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'ISBN',
            'title' => 'Título',
            'author' => 'Author',
            'categories' => 'Categorías',
            'abstract' => 'Resumen',
            'editorial' => 'Editorial',
            'coverFile' => 'Portada',
        ];
    }

    private function storeCover()
    {
        Yii::info('Storing image cover');
        $this->coverFile = UploadedFile::getInstance($this, 'coverFile');
        $fileName = $this->isbn.'.'.$this->coverFile->extension;
        if( $this->coverFile->saveAs('img/covers/'. $fileName, false)){
            Yii::info('Image Cover stored');
            return Url::to('@web/img/covers/' . $fileName);
        } else {
            Yii::info('Image Cover NOT stored');
            return NULL;
        }
    }

    public function save()
    {
        $coverUrl = $this->storeCover();
        if ($coverUrl){
            $book = new Book();
            $book->book_isbn        = $this->isbn;
            $book->book_title       = $this->title;
            $book->book_author      = $this->author;
            $book->book_editorial   = $this->editorial;
            $book->book_abstract    = $this->title;
            $book->book_cover       = $this->coverUrl;

            if($book->save()){

                Yii::info('The Book was saved successfully.');
                foreach ($this->categories as $category) {

                    Yii::info('Category asigned to this document: ' . $category);
                    $join = new BookHasCategory();
                    $join->cat_name = $category;
                    $join->book_id  = $book->book_id;
                    $join->save();
                }
                //TODO: WE NEED TO FIND THE WAY to delete the temp file. 
                //unlink($model->file->tempName);}
                $this->id = $book->book_id;
                return true;
            }else{
                Yii::error('Problems saving the book: ' . print_r($book->getErrors(), true));
            }
        }
        return false;
    }

}
