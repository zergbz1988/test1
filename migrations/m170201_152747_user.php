<?php

use yii\db\Migration;

class m170201_152747_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(60)->notNull(),
            'country_id' => $this->integer()->notNull(),
            'phone' => $this->string(11),
        ], $tableOptions);

        $this->createIndex('IDX_user_country', '{{%user}}', 'country_id');
        $this->addForeignKey('FK_user_country', '{{%user}}', 'country_id', '{{%country}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_country', '{{%user}}');
        $this->dropIndex('IDX_user_country', '{{%user}}');
        $this->dropTable('{{%user}}');
    }

}
