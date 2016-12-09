<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Lending".
 *
 * @property integer $lending_id
 * @property integer $user_id
 * @property string $copy_id
 * @property string $lend_auth_at
 * @property string $lend_return_at
 * @property string $lend_return_real
 *
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
            [['user_id'], 'integer'],
            [['lend_auth_at', 'lend_return_at', 'lend_return_real'], 'safe'],
            [['copy_id'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lending_id' => 'Lending ID',
            'user_id' => 'User ID',
            'copy_id' => 'Copy ID',
            'lend_auth_at' => 'Lend Auth At',
            'lend_return_at' => 'Lend Return At',
            'lend_return_real' => 'Lend Return Real',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
