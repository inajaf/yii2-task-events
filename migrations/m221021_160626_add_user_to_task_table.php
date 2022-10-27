<?php

use yii\db\Migration;

/**
 * Class m221021_160626_add_user_to_task_table
 */
class m221021_160626_add_user_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'user_id', $this->integer()->notNull()->after('id'));
        $this->addForeignKey(
            'fk-task-user_id',
            'task',
            'user_id',
            'user',
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
        $this->dropForeignKey('user_id', 'task');
        $this->dropColumn('task', 'user_id');
    }
}
