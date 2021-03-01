<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery_value}}`.
 */
class m201223_172452_create_gallery_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gallery_value}}', [
	        'id' => $this->primaryKey()->notNull()->defaultValue("nextval('gallery_value_id_seq'::regclass)")->comment('ID'),
	        'galleries_id' => $this->integer()->comment('id галлереи'),
	        'name' => $this->string()->notNull()->comment('Название'),
	        'url' => $this->string()->comment('url'),
	        'text' => $this->text()->comment('Описание'),
	        'property' => $this->text()->comment('Свойства'),
	        'sort_order' => $this->integer()->comment('Порядок'),
	        'file_id' => $this->integer()->comment('id файла'),
        ]);

	    $this->addCommentOnTable('{{%gallery_value}}', 'Элемент галлереи');

	    $this->addForeignKey(
		    'idx_galleries_galleries_id_fk_1',
		    'gallery_value',
		    'galleries_id',
		    'galleries',
		    'id',
		    null,
		    null
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropForeignKey('idx_galleries_galleries_id_fk_1', '{{%gallery_value}}');

        $this->dropTable('{{%gallery_value}}');
    }
}
