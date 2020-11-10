<?php

use yii\db\Migration;

/**
 * Class m201110_131946_insert_contacts
 */
class m201110_131946_insert_contacts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
// Users
        $this->batchInsert('{{%contact}}', ['id', 'first_name', 'last_name', 'phone', 'email', 'status', 'created_at', 'updated_at'], [
            [
                1,
                'Андрей',
                'Высоцкий',
                '77012342213',
                'andrey@gmail.com',
                1,
                time(),
                time()
            ],
            [
                2,
                'Виктор',
                'Берёзка',
                '77770007700',
                'victor@gmail.com',
                1,
                time(),
                time()
            ],
            [
                3,
                'Александр',
                'Винокурченко',
                '77012342213',
                'alex@gmail.com',
                1,
                time(),
                time()
            ],
            [
                4,
                'Надежда',
                'Петрова',
                '77074563737',
                'nadezhda@gmail.com',
                1,
                time(),
                time()
            ],
            [
                5,
                'Любовь',
                'Голубкина',
                '77054321245',
                'love@gmail.com',
                1,
                time(),
                time()
            ],
            [
                6,
                'Илья',
                'Муромец',
                '77712345678',
                'ilya@gmail.com',
                1,
                time(),
                time()
            ],
            [
                7,
                'Василиса',
                'Тополь',
                '77075674737',
                'vasilisa@gmail.com',
                1,
                time(),
                time()
            ],
            [
                8,
                'Константин',
                'Валерьев',
                '77777076757',
                'konst@gmail.com',
                1,
                time(),
                time()
            ],
            [
                9,
                'Виктория',
                'Васильева',
                '77059871234',
                'vika@gmail.com',
                1,
                time(),
                time()
            ],
            [
                10,
                'Алексей',
                'Добрый',
                '77777777777',
                'alesha@gmail.com',
                1,
                time(),
                time()
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201110_131946_insert_contacts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201110_131946_insert_contacts cannot be reverted.\n";

        return false;
    }
    */
}
