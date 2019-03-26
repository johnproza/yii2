<?php

use yii\db\Migration;

/**
 * Class m181113_120221_menu
 */
class m181113_120221_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `menu` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(45) NOT NULL,
              `position` VARCHAR(45) NULL,
              `status` SMALLINT(1) NULL,
              `static` SMALLINT(1) NULL,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181113_120221_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181113_120221_menu cannot be reverted.\n";

        return false;
    }
    */
}
