<?php

namespace backend\models;

use Yii;

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
        return [
            [['book_isbn', 'book_title'], 'required'],
            [['book_isbn'], 'string', 'max' => 13],
            [['book_title', 'book_author', 'book_editorial'], 'string', 'max' => 45],
            [['book_abstract'], 'string', 'max' => 500],
            [['book_cover'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_isbn' => 'Book Isbn',
            'book_title' => 'Book Title',
            'book_author' => 'Book Author',
            'book_abstract' => 'Book Abstract',
            'book_cover' => 'Book Cover',
            'book_editorial' => 'Book Editorial',
        ];
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
