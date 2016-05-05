<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lapak".
 *
 * @property string $id
 * @property string $kode
 * @property string $penanggung_jawab
 * @property string $alamat
 * @property string $lokasi_kode
 * @property string $keterangan
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 *
 * @property Lokasi $lokasiKode
 */
class Lapak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lapak';
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
            [['kode', 'penanggung_jawab', 'alamat', 'lokasi_kode'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['keterangan'], 'string'],
            [['created', 'updated'], 'safe'],
            [['kode', 'penanggung_jawab'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 255],
            [['lokasi_kode'], 'string', 'max' => 20],
            [['id'], 'unique'],
            [['kode'], 'unique'],
            [['lokasi_kode'], 'exist', 'skipOnError' => true, 'targetClass' => Lokasi::className(), 'targetAttribute' => ['lokasi_kode' => 'kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'penanggung_jawab' => 'Penanggung Jawab',
            'alamat' => 'Alamat',
            'lokasi_kode' => 'Lokasi',
            'keterangan' => 'Keterangan',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'Userid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasiKode()
    {
        return $this->hasOne(Lokasi::className(), ['kode' => 'lokasi_kode']);
    }
}
