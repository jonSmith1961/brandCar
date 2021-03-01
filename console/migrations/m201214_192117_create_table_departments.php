<?php

use yii\db\Migration;

/**
 * Class m201214_192117_create_table_departments
 */
class m201214_192117_create_table_departments extends Migration
{
    /**
     * {@inheritdoc}
     */
	public function safeUp()
	{

		$this->createTable('{{%departments}}', [
			'id' => $this->primaryKey()->notNull()->defaultValue("nextval('departments_id_seq'::regclass)")->comment('ID'),
			'name' => $this->string()->notNull()->comment('Название'),
			'center_id' => $this->integer()->comment('Диллерский центр'),
			'phone' => $this->string()->notNull()->comment('Телефон'),
			'email' => $this->string()->null()->comment('E-mail'),
			'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
			'start_time' => $this->string()->null()->comment('Начало работы будни'),
			'end_time' => $this->string()->null()->comment('Окончание работы будни'),
			'start_time_saturday' => $this->string()->null()->comment('Начало работы в субботу'),
			'end_time_saturday' => $this->string()->null()->comment('Окончание работы в субботу'),
			'start_time_sunday' => $this->string()->null()->comment('Начало работы в восскресенье'),
			'end_time_sunday' => $this->string()->null()->comment('Окончание работы в восскресенье'),
			'start_time_holidays' => $this->string()->null()->comment('Начало работы в праздники'),
			'end_time_holidays' => $this->string()->null()->comment('Окончание работы в праздники'),
			'created_at' => $this->integer()->notNull()->comment('Дата создания'),
			'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
		]);
		$this->addCommentOnTable('departments', 'Отделы');

		$this->addForeignKey(
			'idx_departments_center_id_fk_1',
			'{{%departments}}',
			'center_id',
			'dealer_center',
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
		$this->dropForeignKey('idx_departments_center_id_fk_1', '{{%departments}}');
		$this->dropTable('{{%departments}}');
	}

}
