ALTER TABLE `pos_transaction` 
ADD `payment_type_id` INT(11) NOT NULL DEFAULT '1' AFTER `total`, 
ADD `reference` TEXT NULL DEFAULT '' AFTER `payment_type_id`;

ALTER TABLE `pos_product`
ADD `category_id` INT(11) NOT NULL DEFAULT '0' AFTER `product_uom`;

