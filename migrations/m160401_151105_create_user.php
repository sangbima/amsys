<?php

use yii\db\Migration;

class m160401_151105_create_user extends Migration
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
      if (!in_array('user', $tables))  {
        if ($dbType == "mysql") {
          $this->createTable('{{%user}}', [
            'id' => 'VARCHAR(50) NOT NULL',
            0 => 'PRIMARY KEY (`id`)',
            'pass' => 'VARCHAR(255) NOT NULL',
            'nama' => 'VARCHAR(100) NOT NULL',
            'email' => 'VARCHAR(100) NULL',
            'created' => 'DATETIME NULL DEFAULT \'CURRENT_TIMESTAMP\'',
            'updated' => 'DATETIME NULL',
            'user_id' => 'VARCHAR(50) NULL',
          ], $tableOptions_mysql);
        }
      }


      $this->createIndex('idx_UNIQUE_id_1754_00','user','id',1);
      $this->createIndex('idx_user_id_1754_01','user','user_id',0);

      $this->execute('SET foreign_key_checks = 0');
      $this->addForeignKey('fk_user_1738_00','{{%user}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
      $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
      $this->execute('SET foreign_key_checks = 0');
      $this->execute('DROP TABLE IF EXISTS `user`');
      $this->execute('SET foreign_key_checks = 1;');
    }
}
