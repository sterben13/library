<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Copy".
 *
 * @property string $copy_id
 * @property integer $book_id
 * @property string $copy_edition
 * @property string $copy_language
 * @property string $copy_available
 * @property string $copy_state
 *
 * @property Book $book
 * @property Lending[] $lendings
 * @property User[] $users
 */
class Copy extends \yii\db\ActiveRecord
{

    const AVAILABLE = 'Disponible';
    const UNAVAILABLE = 'Ocupado';

    const STATE_OK = 'Ok';
    const STATE_DAMAGED = 'Damaged';
    const STATE_INCOMPLETE = 'Incomplete';
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
            [['copy_id'], 'required'],
            ['book_id', 'required', 'message' => 'Ingrese el titulo del Ejemplar.'],
            ['copy_edition', 'required', 'message' => 'Ingrese la edición del Ejemplar.'],
            ['copy_language', 'required', 'message' => 'Ingrese el Idioma del Ejemplar.'],
            ['copy_state', 'required', 'message' => 'Ingrese las condiciones del Ejemplar.'],
            [['copy_id', 'book_id'], 'safe'],
            [['copy_edition', 'copy_language', 'copy_state', 'copy_available'], 'string'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'copy_id' => 'ID',
            'book_id' => 'Libro',
            'copy_edition' => 'Edición',
            'copy_language' => 'Idioma',
            'copy_available' => 'Disponibilidad',
            'copy_state' => 'Condición',
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
