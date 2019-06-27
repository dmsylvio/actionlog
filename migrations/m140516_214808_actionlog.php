<?php
use yii\db\Schema;
/**
 * DATABSE SCHEMA OF THIS MODULE
 *
 * @version 1.0.0
 * @see http://www.yiiframework.com/doc-2.0/guide-console-migrate.html
 */
class m140516_214808_actionlog extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%logs}}', [
            'id' => Schema::TYPE_BIGPK,
            'id_sistema' => Schema::TYPE_BIGINT . ' NOT NULL DEFAULT 0',
            'id_user' => Schema::TYPE_BIGINT . ' NOT NULL DEFAULT 0',
            'date' => Schema::TYPE_DATE . ' NOT NULL ',
            'log' => Schema::TYPE_TEXT . ' NULL',
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%logs}}');
    }
}