<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $user_id
 * @property string $user_names
 * @property string $user_lastname
 * @property string $user_snd_lastname
 * @property string $user_curp
 * @property string $user_email
 * @property string $user_telephone
 * @property string $user_address
 * @property string $user_profile_photo
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property integer $status
 *
 * @property Lending[] $lendings
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_names', 'user_lastname', 'user_snd_lastname', 'user_curp', 'user_email', 'user_telephone', 'user_address'], 'required'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['user_names', 'user_address'], 'string', 'max' => 100],
            [['user_lastname', 'user_snd_lastname'], 'string', 'max' => 45],
            [['user_curp'], 'string', 'max' => 18],
            [['user_email'], 'string', 'max' => 70],
            [['user_telephone'], 'string', 'max' => 15],
            [['user_profile_photo'], 'string', 'max' => 200],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_names' => 'User Names',
            'user_lastname' => 'User Lastname',
            'user_snd_lastname' => 'User Snd Lastname',
            'user_curp' => 'User Curp',
            'user_email' => 'User Email',
            'user_telephone' => 'User Telephone',
            'user_address' => 'User Address',
            'user_profile_photo' => 'User Profile Photo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLendings()
    {
        return $this->hasMany(Lending::className(), ['user_id' => 'user_id']);
    }
}
