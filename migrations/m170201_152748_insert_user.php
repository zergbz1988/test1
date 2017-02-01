<?php

use yii\db\Migration;

class m170201_152748_insert_user extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}',
            [
                'fio' => 'Vladimir Vladimirovich Putin',
                'phone' => '7900954679',
                'country_id' => 1
            ]);
        $this->insert('{{%user}}',
            [
                'fio' => 'Pyotr Alekseevich Poroshenko',
                'phone' => '3800954679',
                'country_id' => 2
            ]);
        $this->insert('{{%user}}',
            [
                'fio' => 'Donald John Trump',
                'phone' => '1400954679',
                'country_id' => 3
            ]);
        $this->insert('{{%user}}',
            [
                'fio' => 'Theresa Mary May',
                'phone' => '4400954679',
                'country_id' => 4
            ]);
    }

    public function safeDown()
    {
        $this->delete('{{%user}}');
    }

}
