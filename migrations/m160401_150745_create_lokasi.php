<?php

use yii\db\Migration;

class m160401_150745_create_lokasi extends Migration
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
      if (!in_array('lokasi', $tables))  {
        if ($dbType == "mysql") {
          $this->createTable('{{%lokasi}}', [
            'kode' => 'VARCHAR(20) NOT NULL',
            0 => 'PRIMARY KEY (`kode`)',
            'nama' => 'VARCHAR(100) NOT NULL',
            'level' => 'ENUM(\'Provinsi\',\'KabKota\',\'Kecamatan\',\'DesaKelurahan\') NOT NULL',
            'parent' => 'VARCHAR(20) NULL',
            'user_id' => 'VARCHAR(50) NULL',
            'created' => 'DATETIME NULL DEFAULT \'CURRENT_TIMESTAMP\'',
            'updated' => 'DATETIME NULL',
          ], $tableOptions_mysql);
        }
      }


      $this->createIndex('idx_UNIQUE_kode_396_00','lokasi','kode',1);
      $this->createIndex('idx_parent_3961_01','lokasi','parent',0);
      $this->createIndex('idx_user_id_3961_02','lokasi','user_id',0);

      $this->execute('SET foreign_key_checks = 0');
      $this->addForeignKey('fk_lokasi_3946_00','{{%lokasi}}', 'parent', '{{%lokasi}}', 'kode', 'CASCADE', 'NO ACTION' );
      $this->addForeignKey('fk_user_3946_01','{{%lokasi}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
      $this->execute('SET foreign_key_checks = 0');
      $this->execute('DROP TABLE IF EXISTS `lokasi`');
      $this->execute('SET foreign_key_checks = 1;');
    }
}
