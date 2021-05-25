<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m210201_070030_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(25)->notNull(),
            'size' => $this->string(25)->notNull(),
            'image' => $this->binary(4294967295),
            'name' => $this->string(50),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_images_user_id', 
            '{{%images}}', 
            'user_id',
            'users', 
            'id', 
            'CASCADE', 
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_images_user_id', '{{%images}}');
        $this->dropTable('{{%images}}');
    }
}
