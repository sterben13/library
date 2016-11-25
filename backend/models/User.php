<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

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
 * @property Copy[] $copies
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $image;

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
            [['image'], 'file', 'skipOnEmpty' => true,
                'uploadRequired' => 'No has seleccionado ningún archivo', 
                'maxSize' => 1024*1024*8, //
                'tooBig' => 'El tamaño máximo permitido es 1MB', 
                'minSize' =>  10 ,
                'extensions' => 'jpg,jpeg,png',
                'wrongExtension' => 'El archivo {file} es una extensión no permitida {extensions}',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'user_names' => 'Nombres',
            'user_lastname' => 'Apellido Paterno',
            'user_snd_lastname' => 'Apellido Materno',
            'user_curp' => 'CURP',
            'user_email' => 'Correo electrónico',
            'user_telephone' => 'Telefono',
            'user_address' => 'Dirección',
            'user_profile_photo' => 'Fotografía',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última actualización',
            'password_hash' => 'Contraseña',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'image' => 'Fotografía'
        ];
    }


    /**
     *
     *Override method
     */
     public function save($runValidation = true, $attributeNames = NULL)
    {

        if($this->storeCover() && parent::save($runValidation, $attributeNames)){
            Yii::info('Book data stored');
           
            return true;
        }
        
        return false;
    }

    /**
     *
     *Override method
     */
     public function update($runValidation = true, $attributeNames = NULL)
    {
        
        
        $this->storeCover();
        if(parent::update($runValidation, $attributeNames)){
          
          
            return true;
        }
        return false;
    }

    private function storeCover(){
        
        $this->image = UploadedFile::getInstance($this, 'image');
        
        if($this->image){
            $image = $this->image->baseName . '.' . $this->image->extension;
            if($this->image->saveAs('img/photos/' . $image, false)){
                $this->user_profile_photo = Url::to('@web/img/photos/' . $image);
                return true;
            }
        }
        
       return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLendings()
    {
        return $this->hasMany(Lending::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopies()
    {
        return $this->hasMany(Copy::className(), ['copy_id' => 'copy_id'])->viaTable('Lending', ['user_id' => 'user_id']);
    }

     /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['user_names' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['user_email' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
