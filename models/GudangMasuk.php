<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gudang_masuk".
 *
 * @property integer $id
 * @property string $no_proposal
 * @property string $no_antar_gudang
 * @property integer $gudang_id
 * @property string $timbang_masuk_kg
 * @property string $waktu_masuk
 * @property integer $petugas_gudang
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property GudangDataKarung[] $gudangDataKarungs
 * @property Gudang $gudang
 */
class GudangMasuk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gudang_masuk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_proposal', 'no_antar_gudang', 'gudang_id', 'timbang_masuk_kg', 'waktu_masuk', 'petugas_gudang'], 'required'],
            [['gudang_id', 'petugas_gudang', 'user_id'], 'integer'],
            [['timbang_masuk_kg'], 'number'],
            [['waktu_masuk', 'created', 'updated'], 'safe'],
            [['no_proposal', 'no_antar_gudang'], 'string', 'max' => 100],
            [['no_proposal'], 'unique'],
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
            'no_proposal' => 'No Proposal',
            'no_antar_gudang' => 'No Antar Gudang',
            'gudang_id' => 'Gudang ID',
            'timbang_masuk_kg' => 'Timbang Masuk Kg',
            'waktu_masuk' => 'Waktu Masuk',
            'petugas_gudang' => 'Petugas Gudang',
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
        return $this->hasMany(GudangDataKarung::className(), ['gudang_masuk_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudang()
    {
        return $this->hasOne(Gudang::className(), ['id' => 'gudang_id']);
    }
}
