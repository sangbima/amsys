<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lapak_log".
 *
 * @property integer $id
 * @property string $no_proposal
 * @property string $no_antar_lapak
 * @property string $no_antar_gudang
 * @property string $status
 * @property string $timbang_kotor_kg
 * @property string $timbang_bersih_kg
 * @property string $waktu_masuk
 * @property string $waktu_keluar
 * @property string $jml_karung_masuk
 * @property string $jml_karung_keluar
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property AngkutGudang[] $angkutGudangs
 */
class LapakLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lapak_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_proposal', 'no_antar_lapak', 'timbang_kotor_kg', 'waktu_masuk', 'jml_karung_keluar'], 'required'],
            [['status'], 'string'],
            [['timbang_kotor_kg', 'timbang_bersih_kg', 'jml_karung_masuk', 'jml_karung_keluar'], 'number'],
            [['waktu_masuk', 'waktu_keluar', 'created', 'updated'], 'safe'],
            [['user_id'], 'integer'],
            [['no_proposal', 'no_antar_lapak', 'no_antar_gudang'], 'string', 'max' => 100],
            [['no_proposal'], 'unique'],
            [['no_antar_lapak'], 'unique'],
            [['no_antar_gudang'], 'unique'],
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
            'no_antar_lapak' => 'No Antar Lapak',
            'no_antar_gudang' => 'No Antar Gudang',
            'status' => 'Status',
            'timbang_kotor_kg' => 'Timbang Kotor Kg',
            'timbang_bersih_kg' => 'Timbang Bersih Kg',
            'waktu_masuk' => 'Waktu Masuk',
            'waktu_keluar' => 'Waktu Keluar',
            'jml_karung_masuk' => 'Jml Karung Masuk',
            'jml_karung_keluar' => 'Jml Karung Keluar',
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
        return $this->hasMany(AngkutGudang::className(), ['lapak_log_id' => 'id']);
    }
}
