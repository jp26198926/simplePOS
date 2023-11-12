ALTER TABLE `pos_sale_temp` ADD `station_id` INT NOT NULL DEFAULT '0' AFTER `total`;
ALTER TABLE `pos_sale` ADD `station_id` INT NOT NULL DEFAULT '0' AFTER `tax_base`;