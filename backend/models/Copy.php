<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Copy".
 *
 * @property integer $copy_id
 * @property integer $book_id
 * @property string $copy_edition
 * @property string $copy_language
 * @property integer $copy_available
 * @property string $copy_state
 *
 * @property Book $book
 * @property Lending[] $lendings
 * @property User[] $users
 */
class Copy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Copy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['copy_id', 'book_id', 'copy_edition'], 'required'],
            [['copy_id', 'book_id', 'copy_available'], 'integer'],
            [['copy_edition', 'copy_language', 'copy_state'], 'string'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'copy_id' => 'Copy ID',
            'book_id' => 'Book ID',
            'copy_edition' => 'Copy Edition',
            'copy_language' => 'Copy Language',
            'copy_available' => 'Copy Available',
            'copy_state' => 'Copy State',
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
    public function getLendings()
    {
        return $this->hasMany(Lending::className(), ['copy_id' => 'copy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_id' => 'user_id'])->viaTable('Lending', ['copy_id' => 'copy_id']);
    }
}
