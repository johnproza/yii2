<?php

use yii\db\Migration;

/**
 * Class m181113_120305_menu_items
 */
class m181113_120305_menu_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `menu_items` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `label` VARCHAR(45) NOT NULL,
              `title` VARCHAR(180) NULL,
              `content` TEXT NULL,
              `status` SMALLINT(6) NOT NULL,
              `parent` INT NOT NULL DEFAULT 0,
              `seo_id` INT NULL,
              `menu_id` INT NULL,
              PRIMARY KEY (`id`),
              INDEX `SEO` (`seo_id` ASC),
              INDEX `MENU` (`menu_id` ASC),
              CONSTRAINT `FK_item_seo`
                FOREIGN KEY (`seo_id`)
                REFERENCES `seo` (`id`)
                ON DELETE RESTRICT
                ON UPDATE NO ACTION,
              CONSTRAINT `FK_item_menu`
                FOREIGN KEY (`menu_id`)
                REFERENCES `menu` (`id`)
                ON DELETE RESTRICT
                ON UPDATE NO ACTION)
            ENGINE = InnoDB
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181113_120305_menu_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181113_120305_menu_items cannot be reverted.\n";

        return false;
    }
    */
}
