<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Book".
 *
 * @property integer $book_id
 * @property string $book_isbn
 * @property string $book_title
 * @property string $book_author
 * @property string $book_abstract
 * @property string $book_cover
 * @property string $book_editorial
 *
 * @property BookHasCategory[] $bookHasCategories
 * @property Category[] $catNames
 * @property Copy[] $copies
 */
class Book extends \yii\db\ActiveRecord
{
    public $coverImg;
    public $categories;

    private $rules = [
            [['book_isbn', 'book_title'], 'required'],
            [['book_isbn'], 'string', 'max' => 13],
            [['book_title', 'book_author'], 'string', 'max' => 100],
            [[ 'book_editorial'], 'string', 'max' => 45],
            [['book_abstract'], 'string', 'max' => 500],
            [['book_cover'], 'string', 'max' => 200],
        ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'ID',
            'book_isbn' => 'ISBN',
            'book_title' => 'Título',
            'book_author' => 'Autor',
            'book_abstract' => 'Resumen',
            'book_editorial' => 'Editorial',
        ];
    }

  
    /**
     *
     *Override method
     */
     public function update($runValidation = true, $attributeNames = NULL)
    {
        
        Yii::info('Cover url: ' . $this->book_cover);
        $this->storeCover();
        if(parent::save($runValidation, $attributeNames)){
            Yii::info('Book data updated');
            BookHasCategory::deleteAll(['book_id' => $this->book_id]);
            foreach ($this->categories as $category) {
                $rel = new BookHasCategory();
                $rel->book_id  = $this->book_id;
                $rel->cat_name = $category;
                if($rel->save()){
                   Yii::info('Category ' . $rel->cat_name . ' linked to book ' . $rel->book_id);
                }
            }
            return true;
        }
        return false;
    }

    private function storeCover(){
        
        $this->coverImg = UploadedFile::getInstance($this, 'coverImg');
        
        if($this->coverImg){
            $coverName = $this->coverImg->baseName . '.' . $this->coverImg->extension;
            if($this->coverImg->saveAs('img/covers/' . $coverName, false)){
                Yii::info('Cover stored');
                $this->book_cover = Url::to('@web/img/covers/' . $coverName);
                return true;
            }
        }
        
       return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasCategories()
    {
        return $this->hasMany(BookHasCategory::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatNames()
    {
        return $this->hasMany(Category::className(), ['cat_name' => 'cat_name'])->viaTable('Book_has_Category', ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopies()
    {
        return $this->hasMany(Copy::className(), ['book_id' => 'book_id']);
    }
}
