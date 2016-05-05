<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // $this->createTable('{{%user}}', [
        //     'id' => Schema::TYPE_PK,
        //     'username' => Schema::TYPE_STRING . ' NOT NULL',
        //     'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
        //     'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
        //     'password_reset_token' => Schema::TYPE_STRING,
        //     'email' => Schema::TYPE_STRING . ' NOT NULL',
        //
        //     'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
        //     'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        //     'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        // ], $tableOptions);

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255)->unique(),
            'email' => $this->string(100)->notNull()->unique(),
            'nama' => $this->string(100),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'user_id'=> $this->string(50),
            'created' => 'DATETIME NULL DEFAULT \'CURRENT_TIMESTAMP\'',
            'created' => 'DATETIME NULL',
        ], $tableOptions);

        // $this->createTable('{{%user}}', [
        //     'id' => Schema::TYPE_STRING . '(50) NOT NULL',
        //     'name' => Schema::TYPE_STRING . '(100) NOT NULL',
        //     'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
        //     'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
        //     'password_reset_token' => Schema::TYPE_STRING,
        //     'email' => Schema::TYPE_STRING . ' NOT NULL',
        //
        //     'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
        //     'created' => Schema::TYPE_INTEGER . ' NOT NULL',
        //     'updated' => Schema::TYPE_INTEGER . ' NOT NULL',
        //     'user_id' => Schema::TYPE_STRING . '(50) NULL'
        // ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
