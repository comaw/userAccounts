<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cache`.
 */
class m180104_160205_create_cache_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%cache}}', [
            'id' => $this->string(128)->notNull(),
            'expire' => $this->integer(11)->notNull()->defaultValue(0),
            'data' => "LONGBLOB NULL DEFAULT NULL",
        ]);

        $this->addPrimaryKey('id', '{{%cache}}', 'id');
        $this->createIndex('expire', '{{%cache}}', 'expire');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%cache}}');
    }
}
