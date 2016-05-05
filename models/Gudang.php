<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gudang".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $lokasi_kode
 * @property string $latitude
 * @property string $longitude
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property AngkutGudang[] $angkutGudangs
 * @property Lokasi $lokasiKode
 * @property GudangBangunan[] $gudangBangunans
 * @property GudangMasuk[] $gudangMasuks
 */
class Gudang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gudang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'lokasi_kode'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 255],
            [['lokasi_kode'], 'string', 'max' => 20],
            [['nama'], 'unique'],
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
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'lokasi_kode' => 'Lokasi Kode',
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
    public function getAngkutGudangs()
    {
        return $this->hasMany(AngkutGudang::className(), ['gudang_id' => 'id']);
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
    public function getGudangBangunans()
    {
        return $this->hasMany(GudangBangunan::className(), ['gudang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangMasuks()
    {
        return $this->hasMany(GudangMasuk::className(), ['gudang_id' => 'id']);
    }
}
