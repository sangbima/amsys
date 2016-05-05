<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\models\Petani;
use app\models\Lokasi;

/**
 * This is the model class for table "produksi".
 *
 * @property string $id
 * @property string $lahan_id
 * @property string $komoditas_kode
 * @property string $tgl_tanam
 * @property string $tgl_panen
 * @property string $est_bobot_panen
 * @property string $harga_panen
 * @property string $bobot_panen_kotor
 * @property string $status
 * @property string $keterangan
 * @property string $latitude
 * @property string $longitude
 * @property string $no_proposal
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Lahan $lahan
 * @property User $user
 * @property Komoditas $komoditasKode
 */
class Produksi extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 'pending';
    const STATUS_DISETUJUI = 'disetujui';
    const STATUS_DIGANTI = 'diganti';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DIHAPUS = 'dihapus';
    const STATUS_PENDING_DIHAPUS = 'pending_hapus';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produksi';
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
            [['lahan_id', 'komoditas_kode', 'tgl_tanam', 'tgl_panen', 'est_bobot_panen', 'harga_panen', 'user_id'], 'required'],
            [['lahan_id', 'user_id'], 'integer'],
            [['status', 'keterangan'], 'string'],
            [['tgl_tanam', 'tgl_panen', 'created', 'updated'], 'safe'],
            [['est_bobot_panen', 'harga_panen', 'bobot_panen_kotor', 'latitude', 'longitude'], 'number'],
            [['komoditas_kode'], 'string', 'max' => 50],
            [['no_proposal'], 'string', 'max' => 100],
            [['lahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lahan::className(), 'targetAttribute' => ['lahan_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'lahan_id' => 'Lahan',
            'komoditas_kode' => 'Komoditas Kode',
            'tgl_tanam' => 'Tgl Tanam',
            'tgl_panen' => 'Tgl Panen',
            'est_bobot_panen' => 'Bobot (Ton)',
            'harga_panen' => 'Harga',
            'bobot_panen_kotor' => 'Bobot Panen Kotor',
            'status' => 'Status',
            'keterangan' => 'Keterangan',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'no_proposal' => 'No Proposal',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLahan()
    {
        return $this->hasOne(Lahan::className(), ['id' => 'lahan_id']);
    }

    public function getPetani()
    {
      return Petani::find()->where(['id' => $this->lahan['petani_id']]);
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
    public function getKomoditasKode()
    {
        return $this->hasOne(Komoditas::className(), ['kode' => 'komoditas_kode']);
    }

    public function getLokasi()
    {
      return Lokasi::find()->where(['kode' => $this->lahan['lokasi_kode']]);
    }

    /**
    * @return array lahan_id
    */
    public function getLahanPetani()
    {
      $query = new \yii\db\Query;
      $query->select('petani.nama, lokasi.nama as lokasi, lahan.id as idLahan, lahan.luas_m2')
            ->from('petani')
            ->leftJoin('lokasi', 'petani.lokasi_kode = lokasi.kode')
            ->leftJoin('lahan', 'petani.id = lahan.petani_id')
            ->where(['not', ['lahan.petani_id' => null]]);
      $command = $query->createCommand();

      $model = $command->queryAll();

      $lahanPetani = [];
      $i=0;
      foreach ($model as $key) {
        $lahanPetani[$i] = array('id' => $key['idLahan'], 'nama' => $key['nama'].' - '.$key['lokasi'].' - '.$key['luas_m2'].' m2' );
        $i++;
      }

      return $lahanPetani;
    }

    public static function get_status()
    {
      return [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_DISETUJUI => 'Disetujui',
        self::STATUS_DIGANTI => 'Diganti',
        self::STATUS_DITOLAK => 'Ditolak',
        self::STATUS_SELESAI => 'Selesai',
        self::STATUS_DIHAPUS => 'Dihapus',
        self::STATUS_PENDING_DIHAPUS => 'Pending Dihapus'
      ];
    }

    public static function status_style($status)
    {
      if($status == self::STATUS_PENDING) {
        return '<span class="label label-primary" data-toggle="tooltip" data-placement="right" title="Pending"><i class="glyphicon glyphicon-time"></i> </span>';
      } elseif($status == self::STATUS_DISETUJUI){
        return '<span class="label label-success" data-toggle="tooltip" data-placement="right" title="Disetujui"><i class="glyphicon glyphicon-ok"></i> </span>';
      } elseif($status == self::STATUS_DIGANTI){
        return '<span class="label label-info" data-toggle="tooltip" data-placement="right" title="Diganti"><i class="glyphicon glyphicon-pencil"></i> </span>';
      } elseif($status == self::STATUS_DITOLAK){
        return '<span class="label bg-teal" data-toggle="tooltip" data-placement="right" title="Ditolak"><i class="glyphicon glyphicon-minus-sign"></i> </span>';
      } elseif($status == self::STATUS_SELESAI){
        return '<span class="label label-default" data-toggle="tooltip" data-placement="right" title="Selesai"><i class="glyphicon glyphicon-thumbs-up"></i> </span>';
      } elseif($status == self::STATUS_DIHAPUS){
        return '<span class="label label-danger" data-toggle="tooltip" data-placement="right" title="Dihapus"><i class="glyphicon glyphicon-remove"></i> </span>';
      } else {
        return '<span class="label label-warning" data-toggle="tooltip" data-placement="right" title="Pending Hapus"><i class="glyphicon glyphicon-trash"></i> </span>';
      }
    }

    public static function getNoProposal()
    {
      $oldNo = \app\models\HelperNomor::findOne(['parameter' => 'last_proposal_tebas']);
      return $oldNo;
    }
}
