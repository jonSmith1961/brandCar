<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specials}}`.
 */
class m201225_071158_create_specials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specials}}', [
	        'id' => $this->primaryKey()->notNull()->defaultValue("nextval('news_id_seq'::regclass)")->comment('ID'),
	        'alias' => $this->string()->notNull()->unique()->comment('Символьный код'),
	        'title' => $this->string()->notNull()->comment('Заголовок'),
	        'brief' => $this->text()->notNull()->comment('Анонс'),
	        'text' => $this->text()->null()->comment('Текст'),
	        'sub_title' => $this->text()->null()->comment('Подзаголовок'),
	        'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
	        'url' => $this->string()->comment('url'),
	        'sort' => $this->integer()->null()->comment('Сортировка'),
	        'preview_picture' => $this->integer()->null()->comment('Картинка анонса'),
	        'detail_picture' => $this->integer()->null()->comment('Детальная картинка'),
	        'created_at' => $this->integer()->notNull()->comment('Дата создания'),
	        'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
        ]);

	    $this->addCommentOnTable('{{%specials}}', 'Акции');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specials}}');
    }
}
