<?php

use yii\db\Migration;

class m170201_151822_insert_country extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%country}}',
            [
                'title' => 'Russia',
            ]);
        $this->insert('{{%country}}',
            [
                'title' => 'Ukraine',
            ]);
        $this->insert('{{%country}}',
            [
                'title' => 'USA',
            ]);
        $this->insert('{{%country}}',
            [
                'title' => 'Great Britain',
            ]);
    }

    public function safeDown()
    {
        $this->delete('{{%country}}');
    }
}
