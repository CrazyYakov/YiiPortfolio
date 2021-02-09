<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portfolio".
 *
 * @property int $id
 * @property string $name
 * @property string|null $link
 * @property int|null $category_id
 * @property int|null $image_id
 * @property string|null $description
 * @property int $state
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Image $image
 * @property Category $category
 */
class Portfolio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['category_id', 'image_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::class, 'targetAttribute' => ['image_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
            'category_id' => 'Category ID',
            'image_id' => 'Image ID',
            'description' => 'Description',
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
