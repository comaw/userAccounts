<?php

use yii\db\Migration;

/**
 * Handles the creation of table `account`.
 */
class m180104_160632_create_account_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%account}}', [
            'id' => $this->primaryKey(11),
            'user_id' => $this->integer(11)->notNull(),
            'account' => $this->integer(11)->notNull(),
            'added' => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP"),
        ]);

        $this->createIndex('user_id', '{{%account}}', 'user_id', true);
        $this->addForeignKey('user_id', '{{%account}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('user_id', '{{%account}}');
        $this->dropTable('{{%account}}');
    }
}
