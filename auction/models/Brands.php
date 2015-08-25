<?php

namespace auction\models;

use auction\components\Auction;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%brands}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $create_date
 * @property string $update_date
 * @property integer $is_active
 *
 * @property AuctionPreference[] $auctionPreferences
 * @property DealerCompanyPreferences[] $dealerCompanyPreferences
 * @property DealerPreference[] $dealerPreferences
 * @property LotPreference[] $lotPreferences
 * @property Products[] $products
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    private $_uploadDirectory;

    public static function tableName()
    {
        return '{{%brands}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => 'update_date',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'is_active'], 'required'],
            [['description'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['is_active'], 'integer'],
            [[ 'image'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionPreferences()
    {
        return $this->hasMany(AuctionPreference::className(), ['brand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealerCompanyPreferences()
    {
        return $this->hasMany(DealerCompanyPreferences::className(), ['brand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealerPreferences()
    {
        return $this->hasMany(DealerPreference::className(), ['brand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLotPreferences()
    {
        return $this->hasMany(LotPreference::className(), ['brand' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['brand' => 'id']);
    }


    public function save($runValidation = true, $attributeNames = null){
        $this->image=UploadedFile::getInstance($this,'image');

        if($this->image){
            $uploadDirectory= $this->UploadDirectory();

            if(!is_dir($uploadDirectory)){
                FileHelper::createDirectory($uploadDirectory);
            }

            $this->image->saveAs($uploadDirectory.$this->image->baseName.'.'.$this->image->extension);

        }

        return parent::save();

    }

    public function afterSave(){

        $uploadDirectory=$this->UploadDirectory();
        Image::thumbnail($uploadDirectory.$this->image,100,100)
                ->save($uploadDirectory.'thumbs/'.$this->image,['quality' => 50]);

        return true;

    }


    private function UploadDirectory(){

        if($this->_uploadDirectory === null){
            $this->_uploadDirectory = Auction::getAlias('@auction').'/uploads/brands/';
        }

        return $this->_uploadDirectory;

    }
}
