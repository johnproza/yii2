<?php

use yii\db\Migration;

/**
 * Class m181023_094335_seo
 */
class m181023_094335_seo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `seo` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `title` VARCHAR(90) NULL,
              `description` VARCHAR(150) NULL,
              `keywords` VARCHAR(150) NULL,
              `url` VARCHAR(200) NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181023_094335_seo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181023_094335_seo cannot be reverted.\n";

        return false;
    }
    */
}
