<?php

use yii\db\Migration;

class m160401_150857_create_petani extends Migration
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
      if (!in_array('petani', $tables))  {
        if ($dbType == "mysql") {
          $this->createTable('{{%petani}}', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'nama' => 'VARCHAR(100) NOT NULL',
            'alamat' => 'VARCHAR(255) NOT NULL',
            'lokasi_kode' => 'VARCHAR(20) NOT NULL',
            'no_ktp' => 'VARCHAR(45) NULL',
            'user_id' => 'VARCHAR(50) NOT NULL',
            'created' => 'DATETIME NULL DEFAULT \'CURRENT_TIMESTAMP\'',
            'updated' => 'DATETIME NULL',
          ], $tableOptions_mysql);
        }
      }


      $this->createIndex('idx_lokasi_kode_8342_00','petani','lokasi_kode',0);
      $this->createIndex('idx_user_id_8343_01','petani','user_id',0);

      $this->execute('SET foreign_key_checks = 0');
      $this->addForeignKey('fk_lokasi_8328_00','{{%petani}}', 'lokasi_kode', '{{%lokasi}}', 'kode', 'CASCADE', 'NO ACTION' );
      $this->addForeignKey('fk_user_8328_01','{{%petani}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
      $this->execute('SET foreign_key_checks = 0');
      $this->execute('DROP TABLE IF EXISTS `petani`');
      $this->execute('SET foreign_key_checks = 1;');
    }
}
