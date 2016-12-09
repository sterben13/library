<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthItem extends \yii\db\ActiveRecord
{
  const CREATE_BOOK        = 'create-book';
   const CREATE_CATEGORY    = 'create-category';
   const CREATE_CONSULTOR   = 'create-consultor';
   const CREATE_COPY        = 'create-copy';
   const CREATE_LENDING     = 'create-lending';
   const CREATE_LIBRARIAN   = 'create-librarian';
   const DELETE_BOOK        = 'delete-book';
   const DELETE_CATEGORY    = 'delete-category';
   const DELETE_COPY        = 'delete-copy';
   const DISABLE_CONSULTOR  = 'disable-consultor';
   const DISABLE_LIBRARIAN  = 'disable-librarian';
   const READ_BOOK          = 'read-book';
   const READ_CATEGORY      = 'read-category';
   const READ_CONSULTOR     = 'read-consultor';
   const READ_LIBRARIAN     = 'read-librarian';
   const READ_ADMIN         = 'read-admin';
   const READ_COPY          = 'read-copy';
   const READ_LENDING       = 'read-lending';
   const UPDATE_BOOK        = 'update-book';
   const UPDATE_CATEGORY    = 'update-category';
   const UPDATE_COPY        = 'update-copy';
   const UPDATE_LENDING     = 'update-lending';
   const UPDATE_CONSULTOR   = 'update-consultor';
   const UPDATE_LIBRARIAN   = 'update-librarian';
   const ENABLE_CONSULTOR   = 'enable-consultor';
   const ENABLE_LIBRARIAN   = 'enable-librarian';
   const CREATE_ADMIN       = 'create-admin';
   const UPDATE_ADMIN       = 'update-admin';
   const DISABLE_ADMIN      = 'disable-admin';
   const ENABLE_ADMIN       = 'enable-admin';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'parent'])->viaTable('auth_item_child', ['child' => 'name']);
    }
}
