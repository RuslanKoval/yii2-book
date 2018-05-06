<?php

use yii\db\Migration;

/**
 * Class m180506_144835_book
 */
class m180506_144835_book extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'preview' => $this->string(255),
            'user_id' => $this->integer()->defaultValue(null),
            'author' => $this->string()->notNull(),
            'exchange_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("fk_user", "{{%book}}", "user_id", "{{%user}}", "id");
        $this->addForeignKey("fk_exchange", "{{%book}}", "exchange_id", "{{%exchange_point}}", "id");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user','{{%book}}');
        $this->dropForeignKey('fk_exchange','{{%book}}');
        $this->dropTable('{{%book}}');
    }

}
