<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "gudang_bangunan".
 *
 * @property integer $id
 * @property integer $gudang_id
 * @property string $kode
 * @property string $kapasitas_m3
 * @property string $latitude
 * @property string $longitude
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Gudang $gudang
 * @property GudangLot[] $gudangLots
 */
class GudangBangunan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gudang_bangunan';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        /*return [
            TimestampBehavior::className(),
        ];*/

        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
                'value' => function(){ return date('Y-m-d H:i:s'); /* MySql DATETIME */},
            ],
            'autouserid' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gudang_id', 'kode'], 'required'],
            [['gudang_id', 'user_id'], 'integer'],
            [['kapasitas_m3', 'latitude', 'longitude'], 'number'],
            [['created', 'updated'], 'safe'],
            [['kode'], 'string', 'max' => 100],
            [['kode'], 'unique'],
            [['gudang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gudang::className(), 'targetAttribute' => ['gudang_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gudang_id' => 'Gudang ID',
            'kode' => 'Kode',
            'kapasitas_m3' => 'Kapasitas M3',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudang()
    {
        return $this->hasOne(Gudang::className(), ['id' => 'gudang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangLots()
    {
        return $this->hasMany(GudangLot::className(), ['gudang_bangunan_id' => 'id']);
    }
}
