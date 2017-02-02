<?php

use yii\db\Migration;

class m170201_152748_insert_user extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}',
            [
                'fio' => 'Vladimir Vladimirovich Putin',
                'phone' => '79009546799',
                'country_id' => 1
            ]);
        $this->insert('{{%user}}',
            [
                'fio' => 'Pyotr Alekseevich Poroshenko',
                'phone' => '38009546797',
                'country_id' => 2
            ]);
        $this->insert('{{%user}}',
            [
                'fio' => 'Donald John Trump',
                'phone' => '14009546759',
                'country_id' => 3
            ]);
        $this->insert('{{%user}}',
            [
                'fio' => 'Theresa Mary May',
                'phone' => '44009546979',
                'country_id' => 4
            ]);
    }

    public function safeDown()
    {
        $this->delete('{{%user}}');
    }

}
