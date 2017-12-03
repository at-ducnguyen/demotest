<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'role' => $this->integer()->defaultValue(3),
            'address'=> $this->string(),
            'hobby'=> $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%restaurant}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'no_address' => $this->double(8,2),
            'avg_rate' => $this->double(8,2),
            'no_rate' => $this->double(8,2),
            'no_suggestion' => $this->double(8,2),
            'status' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'district_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);




        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'body' => $this->text(100000)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'subject' => $this->string()->notNull(),
            'body' => $this->text(100000)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%district}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'city_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);



        $this->createTable('{{%food}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal()->notNull(),
            'image' => $this->string()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%rating}}', [
            'id' => $this->primaryKey(),
            'value' => $this->double(8,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->createTable('{{%restaurant_user}}', [
            'id' => $this->primaryKey(),
            'cookie_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'district_id' => $this->integer()->notNull(),
            'distance'=>$this->double(8,3),
            'no_suggestion' => $this->double(8,4),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%restaurant_image}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'restaurant_id'=> $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->addForeignKey(
            'fk-0013',
            'restaurant_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-0014',
            'restaurant_user',
            'restaurant_id',
            'restaurant',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-0015',
            'restaurant_user',
            'district_id',
            'district',
            'id',
            'CASCADE'
        );

        // add foreign key for table `user`
        

        $this->addForeignKey(
            'fk-002',
            'restaurant',
            'district_id',
            'district',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-003',
            'restaurant',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-004',
            'rating',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-005',
            'rating',
            'restaurant_id',
            'restaurant',
            'id',
            'CASCADE'
        );


        $this->addForeignKey(
            'fk-006',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-007',
            'comment',
            'restaurant_id',
            'restaurant',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-008',
            'food',
            'restaurant_id',
            'restaurant',
            'id',
            'CASCADE'
        );


        $this->addForeignKey(
            'fk-009',
            'restaurant_image',
            'restaurant_id',
            'restaurant',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-010',
            'district',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('{{%restaurant}}');
      
        $this->dropTable('{{%district}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%contact}}');
        $this->dropTable('{{%slider}}');
        $this->dropTable('{{%food}}');
        $this->dropTable('{{%restaurant_image}}');
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%rating}}');
        
    }
}
