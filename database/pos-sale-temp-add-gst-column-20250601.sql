ALTER TABLE `pos_sale_temp`
	ADD COLUMN `gst_type_id` INT NOT NULL DEFAULT '1' AFTER `station_id`,
	ADD COLUMN `gst_code` VARCHAR(5) NOT NULL DEFAULT 'I' AFTER `gst_type_id`,
	ADD COLUMN `gst_type` VARCHAR(50) NOT NULL DEFAULT 'GST Inclusive' AFTER `gst_code`,
	ADD COLUMN `gst_percent` INT NOT NULL DEFAULT '10' AFTER `gst_type`,
	ADD COLUMN `tax_base` DECIMAL(20,2) NOT NULL DEFAULT '0.00' AFTER `gst_percent`,
	ADD COLUMN `gst_value` DECIMAL(20,2) NOT NULL DEFAULT '0.00' AFTER `tax_base`;