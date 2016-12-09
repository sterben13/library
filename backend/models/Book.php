<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\models\FileHelper;

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

    const SCENARIO_INSERT = "INSERT";
    const SCENARIO_UPDATE = "UPDATE";

    public $categories;
    public $coverFile;

    private $rules = [
            [['book_isbn', 'book_title', 'categories'], 'required'],
            [['book_isbn'], 'string', 'max' => 11],
            [['book_title', 'book_author'], 'string', 'max' => 100],
            [['book_editorial'], 'string', 'max' => 45],
            [['book_abstract'], 'string', 'max' => 500],
            [['book_cover'], 'string', 'max' => 200],
            ['book_isbn', 'string', 'max' => 13],
            ['book_isbn', 'unique', 
                'message' => 'Ya existe un libro con este ISBN.',
                'except' => self::SCENARIO_UPDATE
            ],
            ['book_isbn', 'validateIsbn', 'except' => self::SCENARIO_INSERT],
            [['coverFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
           
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
            'coverFile' => 'Portada',
            'categories' => 'Categorías'
        ];
    }

    public function validateIsbn($attribute, $params) 
    {
        Yii::info('Validating ISBN on update for book : ' . $this->book_id);
        $book = Book::findOne($this->book_id);
        if($book && !Book::findOne(['book_isbn' => $this->book_isbn])){
            Yii::info('Valid ISBN');
            return  true;
        }
        Yii::info('Invalid ISBN');
        return false;
    }



    public function save($runValidation = true, $attributeNames = NULL)
    {
        if(!$this->validate()){
            return false;
        }

        //Saving the book cover
        $file = UploadedFile::getInstance($this, 'coverFile');
        $fileName = $this->book_isbn;
        $fileHelper = new FileHelper('img/covers/');
        if($cover_url = $fileHelper->upload($file, $fileName)){
            $this->book_cover = $cover_url;
        } else {
            if($this->isNewRecord) 
               $this->book_cover = '/library/backend/web/img/covers/generic-book-cover.jpg';
        }

        $transaction = Book::getDb()->beginTransaction();
        if(parent::save()){
        
            $flag = true;
        
            Yii::info('The Book was saved successfully: ' . $this->book_id);
            //Deleting all the relationships between Book and Category if any
            BookHasCategory::deleteAll(['book_id'=> $this->book_id]);
            //Saving the new relationships
            foreach ($this->categories as $category) {
                Yii::info('Category asigned to this document: ' . $category);
                $join = new BookHasCategory();
                $join->cat_name = $category;
                $join->book_id  = $this->book_id;
                $flag = $join->save() && $flag;
            }
                //TODO: WE NEED TO FIND THE WAY to delete the temp file. 
                //unlink($model->file->tempName);}
            if($flag){
                $transaction->commit();
                return true;
            }
        }

        $transaction->rollback();
        Yii::error('Problems saving the book: ' . print_r($this->getErrors(), true));
        return false;
    }

    public function getCategoriesAsHtml(){
        $tags = '';
        foreach (BookHasCategory::find()->where(['book_id' => $this->book_id])->all() as $category){
            $tags = $tags . '<span class="label label-primary text-uppercase">' . $category->cat_name . '</span>  ';
        }
        return $tags;
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
