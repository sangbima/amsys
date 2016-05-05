<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "angkut_gudang".
 *
 * @property integer $id
 * @property string $no_surat
 * @property string $no_proposal
 * @property integer $armada_id
 * @property integer $sopir_id
 * @property integer $lapak_log_id
 * @property integer $gudang_id
 * @property string $waktu_rencana
 * @property string $waktu_realisasi
 * @property string $status
 * @property integer $petugas_lapak
 * @property string $bobot_angkut_kg
 * @property string $jml_karung_angkut
 * @property integer $petugas_gudang
 * @property string $bobot_serah_kg
 * @property string $jml_karung_serah
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Armada $armada
 * @property Gudang $gudang
 * @property LapakLog $lapakLog
 * @property Sopir $sopir
 */
class AngkutGudang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'angkut_gudang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['armada_id', 'sopir_id', 'lapak_log_id', 'gudang_id', 'waktu_rencana'], 'required'],
            [['armada_id', 'sopir_id', 'lapak_log_id', 'gudang_id', 'petugas_lapak', 'petugas_gudang', 'user_id'], 'integer'],
            [['waktu_rencana', 'waktu_realisasi', 'created', 'updated'], 'safe'],
            [['status'], 'string'],
            [['bobot_angkut_kg', 'jml_karung_angkut', 'bobot_serah_kg', 'jml_karung_serah'], 'number'],
            [['no_surat', 'no_proposal'], 'string', 'max' => 100],
            [['armada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Armada::className(), 'targetAttribute' => ['armada_id' => 'id']],
            [['gudang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gudang::className(), 'targetAttribute' => ['gudang_id' => 'id']],
            [['lapak_log_id'], 'exist', 'skipOnError' => true, 'targetClass' => LapakLog::className(), 'targetAttribute' => ['lapak_log_id' => 'id']],
            [['sopir_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sopir::className(), 'targetAttribute' => ['sopir_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_surat' => 'No Surat',
            'no_proposal' => 'No Proposal',
            'armada_id' => 'Armada ID',
            'sopir_id' => 'Sopir ID',
            'lapak_log_id' => 'Lapak Log ID',
            'gudang_id' => 'Gudang ID',
            'waktu_rencana' => 'Waktu Rencana',
            'waktu_realisasi' => 'Waktu Realisasi',
            'status' => 'Status',
            'petugas_lapak' => 'Petugas Lapak',
            'bobot_angkut_kg' => 'Bobot Angkut Kg',
            'jml_karung_angkut' => 'Jml Karung Angkut',
            'petugas_gudang' => 'Petugas Gudang',
            'bobot_serah_kg' => 'Bobot Serah Kg',
            'jml_karung_serah' => 'Jml Karung Serah',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmada()
    {
        return $this->hasOne(Armada::className(), ['id' => 'armada_id']);
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
    public function getLapakLog()
    {
        return $this->hasOne(LapakLog::className(), ['id' => 'lapak_log_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSopir()
    {
        return $this->hasOne(Sopir::className(), ['id' => 'sopir_id']);
    }
}
