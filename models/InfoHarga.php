<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "info_harga".
 *
 * @property string $id
 * @property string $komoditas_kode
 * @property string $tanggal
 * @property string $harga_kg
 * @property string $pasar
 * @property string $created
 * @property string $updated
 *
 * @property Komoditas $komoditasKode
 */
class InfoHarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_harga';
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
            [['komoditas_kode', 'tanggal', 'harga_kg'], 'required'],
            [['tanggal', 'created', 'updated'], 'safe'],
            [['harga_kg'], 'number'],
            [['komoditas_kode'], 'string', 'max' => 50],
            [['pasar'], 'string', 'max' => 100],
            [['komoditas_kode'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['komoditas_kode' => 'kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'komoditas_kode' => 'Komoditas Kode',
            'tanggal' => 'Tanggal',
            'harga_kg' => 'Harga Kg',
            'pasar' => 'Pasar',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomoditasKode()
    {
        return $this->hasOne(Komoditas::className(), ['kode' => 'komoditas_kode']);
    }
}
