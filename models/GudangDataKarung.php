<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "gudang_data_karung".
 *
 * @property integer $id
 * @property integer $gudang_masuk_id
 * @property integer $gudang_lot_id
 * @property string $bobot_kg
 *
 * @property GudangLot $gudangLot
 * @property GudangMasuk $gudangMasuk
 */
class GudangDataKarung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gudang_data_karung';
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
            [['id', 'gudang_masuk_id', 'gudang_lot_id', 'bobot_kg'], 'required'],
            [['id', 'gudang_masuk_id', 'gudang_lot_id'], 'integer'],
            [['bobot_kg'], 'number'],
            [['gudang_lot_id'], 'exist', 'skipOnError' => true, 'targetClass' => GudangLot::className(), 'targetAttribute' => ['gudang_lot_id' => 'id']],
            [['gudang_masuk_id'], 'exist', 'skipOnError' => true, 'targetClass' => GudangMasuk::className(), 'targetAttribute' => ['gudang_masuk_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gudang_masuk_id' => 'Gudang Masuk ID',
            'gudang_lot_id' => 'Gudang Lot ID',
            'bobot_kg' => 'Bobot Kg',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangLot()
    {
        return $this->hasOne(GudangLot::className(), ['id' => 'gudang_lot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangMasuk()
    {
        return $this->hasOne(GudangMasuk::className(), ['id' => 'gudang_masuk_id']);
    }
}
