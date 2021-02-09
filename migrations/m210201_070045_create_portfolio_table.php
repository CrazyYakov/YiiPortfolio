<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio}}`.
 */
class m210201_070045_create_portfolio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
            'link' => $this->string(255),
            'category_id' => $this->integer(),
            'image_id' => $this->integer(),
            'description' =>$this->text(),
            'state' => $this->boolean()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),            
        ]);

        $this->addForeignKey(
            'fk_portfolio_category_id', 
            '{{%portfolio}}', 
            'category_id', 
            'categories', 
            'id', 
            'SET NULL',
            'SET NULL'
        );
        $this->addForeignKey(
            'fk_porfolio_image_id',
            '{{%portfolio}}', 
            'image_id', 
            'images', 
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
        $this->dropForeignKey('fk_porfolio_image_id', '{{%portfolio}}');
        $this->dropForeignKey('fk_portfolio_category_id', '{{%portfolio}}');
        $this->dropTable('{{%portfolio}}');
    }
}
