<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m210201_060255_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(null),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'state' => $this->boolean()->notNull()->defaultValue(1),//Состояние
            'user_id' =>  $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey(
            'fk_categories_user_id', 
            '{{%categories}}', 
            'user_id', 
            'users', 
            'id', 
            'CASCADE', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_categories_parent_id',
            '{{%categories}}', 
            'parent_id',
            '{{%categories}}', 
            'id',
            'CASCADE', 
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-parent_id',
            '{{%categories}}',
            'parent_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-post-parent_id', '{{%categories}}');
        $this->dropForeignKey('fk_categories_parent_id', '{{%categories}}');
        $this->dropForeignKey('fk_categories_user_id', '{{%categories}}');
        $this->dropTable('{{%categories}}');
    }
}
