<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%private_contact}}`.
 */
class m201110_120554_create_private_contact_table extends Migration
{
    public $tableName = '{{%private_contact}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // fk
        $this->addForeignKey('fk-private_contact-contact_id', $this->tableName, 'contact_id', '{{%contact}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-private_contact-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
