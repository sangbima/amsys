<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lahan".
 *
 * @property string $id
 * @property string $petani_id
 * @property string $lokasi_kode
 * @property string $luas_m2
 * @property string $keterangan
 * @property integer $user_id
 * @property string $status
 * @property string $keterangan
 * @property string $latitude
 * @property string $longitude
 * @property string $created
 * @property string $updated
 *
 * @property Petani $petani
 * @property Lokasi $lokasiKode
 * @property User $user
 * @property Produksi[] $produksis
 */
class Lahan extends \yii\db\ActiveRecord
{
    const STATUS_AKTIF = 'aktif';
    const STATUS_DIHAPUS = 'dihapus';
    const STATUS_PENDING_DIHAPUS = 'pending_dihapus';

    public $provinsi;
    public $kotakab;
    public $kec;
    public $keldes;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lahan';
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
            [['petani_id', 'lokasi_kode', 'luas_m2', 'user_id'], 'required'],
            [['petani_id', 'user_id'], 'integer'],
            [['luas_m2', 'latitude', 'longitude'], 'number'],
            [['status'], 'string'],
            [['created', 'updated'], 'safe'],
            [['lokasi_kode'], 'string', 'max' => 20],
            [['keterangan'], 'string', 'max' => 500],
            [['petani_id'], 'exist', 'skipOnError' => true, 'targetClass' => Petani::className(), 'targetAttribute' => ['petani_id' => 'id']],
            [['lokasi_kode'], 'exist', 'skipOnError' => true, 'targetClass' => Lokasi::className(), 'targetAttribute' => ['lokasi_kode' => 'kode']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'petani_id' => 'Petani ID',
            'lokasi_kode' => 'Lokasi Kode',
            'luas_m2' => 'Luas M2',
            'status' => 'Status',
            'keterangan' => 'Keterangan',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'provinsi' => 'Provinsi',
            'kotakab' => 'Kota/Kabupaten',
            'kec' => 'Kecamatan',
            'keldes' => 'Kelurahan/Desa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetani()
    {
        return $this->hasOne(Petani::className(), ['id' => 'petani_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasiKode()
    {
        return $this->hasOne(Lokasi::className(), ['kode' => 'lokasi_kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduksis()
    {
        return $this->hasMany(Produksi::className(), ['lahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function get_status()
    {
        return [
          self::STATUS_AKTIF => 'Aktif',
          self::STATUS_DIHAPUS => 'Dihapus',
          self::STATUS_PENDING_DIHAPUS => 'Pending Dihapus',
        ];
    }

    public static function status_style($status)
    {
      if($status == self::STATUS_AKTIF){
        return '<span class="label label-success" data-toggle="tooltip" data-placement="right" title="Aktif"><i class="glyphicon glyphicon-ok"></i> </span>';
      } elseif($status == self::STATUS_DIHAPUS){
        return '<span class="label label-danger" data-toggle="tooltip" data-placement="right" title="Dihapus"><i class="glyphicon glyphicon-remove"></i> </span>';
      } else {
        return '<span class="label label-warning" data-toggle="tooltip" data-placement="right" title="Pending Hapus"><i class="glyphicon glyphicon-trash"></i> </span>';
      }

    }
}
