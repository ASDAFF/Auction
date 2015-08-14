<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%dealer_company}}".
 *
 * @property integer $id
 * @property integer $dealer
 * @property integer $company
 * @property string $create_date
 * @property string $update_date
 * @property string $aprv_date
 * @property integer $aprv_by
 * @property integer $status
 * @property integer $is_active
 * @property integer $mode
 *
 * @property Dealers $dealer0
 * @property Companies $company0
 * @property DealerCompanyPreferences[] $dealerCompanyPreferences
 */
class DealerCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dealer_company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dealer', 'company', 'create_date', 'is_active', 'mode'], 'required'],
            [['dealer', 'company', 'aprv_by', 'status', 'is_active', 'mode'], 'integer'],
            [['create_date', 'update_date', 'aprv_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dealer' => 'Dealer',
            'company' => 'Company',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'aprv_date' => 'Aprv Date',
            'aprv_by' => 'Aprv By',
            'status' => 'Status',
            'is_active' => 'Is Active',
            'mode' => 'Mode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealer0()
    {
        return $this->hasOne(Dealers::className(), ['id' => 'dealer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealerCompanyPreferences()
    {
        return $this->hasMany(DealerCompanyPreferences::className(), ['dc_id' => 'id']);
    }
}