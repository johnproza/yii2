<?php

use yii\db\Migration;

/**
 * Class m190326_102722_menu_assign
 */
class m190326_102722_menu_assign extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `menu_assign` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `menu_id` INT NULL,
                  `menu_item_id` INT NULL,
                  PRIMARY KEY (`id`),
                  INDEX `MENU_CAT` (`menu_id` ASC),
                  INDEX `MENU_ITEM` (`menu_item_id` ASC),
                  CONSTRAINT `FK_menu_cat`
                    FOREIGN KEY (`menu_id`)
                    REFERENCES `menu` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `FK_menu_item`
                    FOREIGN KEY (`menu_item_id`)
                    REFERENCES `menu_items` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190326_102722_menu_assign cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190326_102722_menu_assign cannot be reverted.\n";

        return false;
    }
    */
}
