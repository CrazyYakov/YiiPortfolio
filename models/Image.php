<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $type
 * @property string $size
 * @property resource|null $image
 * @property string|null $name
 * @property int|null $user_id
 *
 * @property Users $user
 * @property Portfolio[] $portfolios
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'size'], 'required'],
            [['image'], 'string'],
            [['user_id'], 'integer'],
            [['type', 'size'], 'string', 'max' => 25],
            [['name'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'size' => 'Size',
            'image' => 'Image',
            'name' => 'Name',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Portfolios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolios()
    {
        return $this->hasMany(Portfolio::className(), ['image_id' => 'id']);
    }
}
