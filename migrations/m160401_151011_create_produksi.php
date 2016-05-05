<?php

use yii\db\Migration;

class m160401_151011_create_produksi extends Migration
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
      if (!in_array('produksi', $tables))  {
        if ($dbType == "mysql") {
          $this->createTable('{{%produksi}}', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'lahan_id' => 'INT(10) UNSIGNED NOT NULL',
            'tgl_tanam' => 'DATE NOT NULL',
            'tgl_panen' => 'DATE NOT NULL',
            'est_bobot_panen' => 'DECIMAL(12,2) NOT NULL',
            'harga_panen' => 'DECIMAL(22,2) NOT NULL',
            'riil_bobot_panen' => 'DECIMAL(12,2) NULL',
            'user_id' => 'VARCHAR(50) NOT NULL',
            'created' => 'DATETIME NULL DEFAULT \'CURRENT_TIMESTAMP\'',
            'updated' => 'DATETIME NULL',
          ], $tableOptions_mysql);
        }
      }


      $this->createIndex('idx_lahan_id_1582_00','produksi','lahan_id',0);
      $this->createIndex('idx_user_id_1582_01','produksi','user_id',0);

      $this->execute('SET foreign_key_checks = 0');
      $this->addForeignKey('fk_lahan_1567_00','{{%produksi}}', 'lahan_id', '{{%lahan}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->addForeignKey('fk_user_1567_01','{{%produksi}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
      $this->execute('SET foreign_key_checks = 0');
      $this->execute('DROP TABLE IF EXISTS `produksi`');
      $this->execute('SET foreign_key_checks = 1;');
    }
}
