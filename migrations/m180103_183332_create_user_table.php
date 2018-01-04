<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180103_183332_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'address' => $this->string(255)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
