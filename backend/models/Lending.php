<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Lending".
 *
 * @property integer $user_id
 * @property integer $copy_id
 * @property string $lend_auth_at
 * @property string $lend_return_at
 * @property string $lend_return_real
 *
 * @property Copy $copy
 * @property User $user
 */
class Lending extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Lending';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'copy_id', 'lend_auth_at', 'lend_return_at'], 'required'],
            [['user_id', 'copy_id'], 'integer'],
            [['lend_auth_at', 'lend_return_at', 'lend_return_real'], 'safe'],
            [['copy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Copy::className(), 'targetAttribute' => ['copy_id' => 'copy_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Usuario',
            'copy_id' => 'Copia',
            'lend_auth_at' => 'Fecha de Autorización',
            'lend_return_at' => 'Fecha de Devolución',
            'lend_return_real' => 'Fecha de Devolución Real',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopy()
    {
        return $this->hasOne(Copy::className(), ['copy_id' => 'copy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
