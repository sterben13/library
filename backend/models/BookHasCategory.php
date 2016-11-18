<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "book_has_category".
 *
 * @property integer $book_id
 * @property string $cat_name
 *
 * @property Book $book
 * @property Category $catName
 */
class BookHasCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_has_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'cat_name'], 'required'],
            [['book_id'], 'integer'],
            [['cat_name'], 'string', 'max' => 20],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
            [['cat_name'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_name' => 'cat_name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'cat_name' => 'Cat Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatName()
    {
        return $this->hasOne(Category::className(), ['cat_name' => 'cat_name']);
    }
}
