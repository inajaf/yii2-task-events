<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m221021_090833_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'due_date' => $this->date()->notNull(),
            'complete' => $this->tinyInteger()->defaultValue(0)->null(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
