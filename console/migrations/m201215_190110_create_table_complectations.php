<?php

use yii\db\Migration;

/**
 * Class m201215_190110_create_table_complectations
 */
class m201215_190110_create_table_complectations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%complectations}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('complectations_id_seq'::regclass)")->comment('ID'),
		    'name' => $this->string()->notNull()->comment('Название'),
		    'price' => $this->integer()->notNull()->comment('Цена'),
		    'model_id' => $this->integer()->comment('Модель'),
		    'title' => $this->string()->notNull()->comment('Заголовок'),
		    'code' => $this->string()->notNull()->comment('Символьный код'),
		    'series' => $this->string()->notNull()->unique()->comment('Серия'),
		    'brief' => $this->text()->notNull()->comment('Описание'),
		    'qualities' => $this->text()->null()->comment('Особенности'),
		    'preview_picture' => $this->integer()->notNull()->comment('Картинка анонса'),
		    'detail_picture' => $this->integer()->null()->comment('Детальная картинка'),
		    'specifications_file' => $this->integer()->comment('Файл технические характеристики'),
		    'weight' => $this->integer()->notNull()->comment('Масса'),
		    'sort' => $this->integer()->comment('Порядок'),
		    'property_weight' => $this->text()->comment('Полная масса'),
		    'property_carrying' => $this->text()->comment('Грузоподъемность'),
		    'property_engine' => $this->text()->comment('Двигатель'),
		    'property_transmission' => $this->text()->comment('Трансмиссия'),
		    'property_drive_wheels' => $this->text()->comment('Привод ведущие колеса'),
		    'text_middle' => $this->text()->null()->comment('Описание в середине'),
		    'text_preview' => $this->text()->null()->comment('Описание внизу слева'),
		    'text_col' => $this->text()->null()->comment('Описание внизу справа'),
		    'gallery1_id' => $this->integer()->comment('Слайдер1'),
		    'gallery2_id' => $this->integer()->comment('Слайдер2'),
		    'gallery3_id' => $this->integer()->comment('Слайдер3'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);

	    $this->addCommentOnTable('{{%complectations}}', 'Комплектации');

	    $this->addForeignKey(
		    'idx_complectations_model_id_fk_1',
		    'complectations',
		    'model_id',
		    'models',
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
	    $this->dropTable('{{%complectations}}');
    }

}
