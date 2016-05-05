<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gudang_lot".
 *
 * @property integer $id
 * @property integer $gudang_bangunan_id
 * @property string $kode
 * @property string $kapasitas_m3
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property GudangDataKarung[] $gudangDataKarungs
 * @property GudangBangunan $gudangBangunan
 */
class GudangLot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gudang_lot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gudang_bangunan_id', 'kode'], 'required'],
            [['gudang_bangunan_id', 'user_id'], 'integer'],
            [['kapasitas_m3'], 'number'],
            [['created', 'updated'], 'safe'],
            [['kode'], 'string', 'max' => 100],
            [['kode'], 'unique'],
            [['gudang_bangunan_id'], 'exist', 'skipOnError' => true, 'targetClass' => GudangBangunan::className(), 'targetAttribute' => ['gudang_bangunan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gudang_bangunan_id' => 'Gudang Bangunan ID',
            'kode' => 'Kode',
            'kapasitas_m3' => 'Kapasitas M3',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangDataKarungs()
    {
        return $this->hasMany(GudangDataKarung::className(), ['gudang_lot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudangBangunan()
    {
        return $this->hasOne(GudangBangunan::className(), ['id' => 'gudang_bangunan_id']);
    }
}
