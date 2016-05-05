<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "angkut_lapak".
 *
 * @property integer $id
 * @property string $no_surat
 * @property string $no_proposal
 * @property integer $armada_id
 * @property integer $sopir_id
 * @property integer $produksi_id
 * @property integer $lapak_id
 * @property string $waktu_rencana
 * @property string $waktu_realisasi
 * @property string $status
 * @property integer $diterima_oleh
 * @property string $diterima_pada
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Armada $armada
 * @property Lapak $lapak
 * @property Produksi $produksi
 * @property Sopir $sopir
 */
class AngkutLapak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'angkut_lapak';
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
            [['no_surat', 'no_proposal', 'armada_id', 'sopir_id', 'produksi_id', 'lapak_id', 'waktu_rencana'], 'required'],
            [['armada_id', 'sopir_id', 'produksi_id', 'lapak_id', 'diterima_oleh', 'user_id'], 'integer'],
            [['waktu_rencana', 'waktu_realisasi', 'diterima_pada', 'created', 'updated'], 'safe'],
            [['status'], 'string'],
            [['no_surat', 'no_proposal'], 'string', 'max' => 100],
            [['armada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Armada::className(), 'targetAttribute' => ['armada_id' => 'id']],
            [['lapak_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lapak::className(), 'targetAttribute' => ['lapak_id' => 'id']],
            [['produksi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produksi::className(), 'targetAttribute' => ['produksi_id' => 'id']],
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
            'produksi_id' => 'Produksi ID',
            'lapak_id' => 'Lapak ID',
            'waktu_rencana' => 'Waktu Rencana',
            'waktu_realisasi' => 'Waktu Realisasi',
            'status' => 'Status',
            'diterima_oleh' => 'Diterima Oleh',
            'diterima_pada' => 'Diterima Pada',
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
    public function getLapak()
    {
        return $this->hasOne(Lapak::className(), ['id' => 'lapak_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduksi()
    {
        return $this->hasOne(Produksi::className(), ['id' => 'produksi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSopir()
    {
        return $this->hasOne(Sopir::className(), ['id' => 'sopir_id']);
    }
}
