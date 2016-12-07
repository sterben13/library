<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Category".
 *
 * @property string $cat_name
 * @property string $cat_descrption
 *
 * @property BookHasCategory[] $bookHasCategories
 * @property Book[] $books
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_name'], 'string', 'max' => 20],
            [['cat_descrption'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_name' => 'Categoría',
            'cat_descrption' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookHasCategories()
    {
        return $this->hasMany(BookHasCategory::className(), ['cat_name' => 'cat_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['book_id' => 'book_id'])->viaTable('Book_has_Category', ['cat_name' => 'cat_name']);
    }
}
