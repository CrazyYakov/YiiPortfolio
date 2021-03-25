<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;

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
class Image extends ActiveRecord
{

    /**
     * @var UploadedFile
     * 
     */
    public $imageFile;

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
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            [['type', 'size'], 'required'],
            [['image'], 'string'],
            [['user_id'], 'integer'],
            [['type', 'size'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Portfolios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolios()
    {
        return $this->hasMany(Portfolio::class, ['image_id' => 'id']);
    }
    /**
     * Set Image 
     * 
     * @return bool
     */
    public function upload()
    {
        if (isset($this->imageFile)) {
            $this->size = (string) $this->imageFile->size;
            $this->type = $this->imageFile->type;
            $this->name = $this->imageFile->name;
            $this->image = file_get_contents($this->imageFile->tempName);
            $this->user_id = (int) Yii::$app->user->id;

            return $this->validate() ? $this->save() : false;
        }
        return false;
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['user_id'] // If usr_id is required
                ]
            ],
        ];
    }
}
