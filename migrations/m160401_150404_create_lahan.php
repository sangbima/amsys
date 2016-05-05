<?php

use yii\db\Migration;

class m160401_150404_create_lahan extends Migration
{
    public function up()
    {
      $tables = Yii::$app->db->schema->getTableNames();
      $dbType = $this->db->driverName;
      $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
      $tableOptions_mssql = "";
      $tableOptions_pgsql = "";
      $tableOptions_sqlite = "";
      /* MYSQL */
      if (!in_array('lahan', $tables))  {
        if ($dbType == "mysql") {
          $this->createTable('{{%lahan}}', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'petani_id' => 'INT(10) UNSIGNED NOT NULL',
            'lokasi_kode' => 'VARCHAR(20) NOT NULL',
            'luas_m2' => 'DECIMAL(12,2) NOT NULL',
            'keterangan' => 'VARCHAR(500) NULL',
            'user_id' => 'VARCHAR(50) NOT NULL',
            'created' => 'DATETIME NULL DEFAULT \'CURRENT_TIMESTAMP\'',
            'updated' => 'DATETIME NULL',
          ], $tableOptions_mysql);
        }
      }


      $this->createIndex('idx_petani_id_8171_00','lahan','petani_id',0);
      $this->createIndex('idx_lokasi_kode_8171_01','lahan','lokasi_kode',0);
      $this->createIndex('idx_user_id_8171_02','lahan','user_id',0);

      $this->execute('SET foreign_key_checks = 0');
      $this->addForeignKey('fk_petani_8155_00','{{%lahan}}', 'petani_id', '{{%petani}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->addForeignKey('fk_lokasi_8156_01','{{%lahan}}', 'lokasi_kode', '{{%lokasi}}', 'kode', 'CASCADE', 'NO ACTION' );
      $this->addForeignKey('fk_user_8156_02','{{%lahan}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
      $this->execute('SET foreign_key_checks = 0');
      $this->execute('DROP TABLE IF EXISTS `lahan`');
      $this->execute('SET foreign_key_checks = 1;');
    }
}
