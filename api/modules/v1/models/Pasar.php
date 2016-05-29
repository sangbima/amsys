<?php
namespace api\modules\v1\models;

use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class Pasar extends ActiveRecord
{
  public static function tableName()
  {
    return 'pasar';
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

  public static function primaryKey()
  {
    return ['id'];
  }

  public function rules()
  {
    return [
        [['id'], 'integer'],
        [['nama_pasar'], 'required'],
        [['nama_pasar','latitude','longitude'], 'string'],
    ];
  }
}
