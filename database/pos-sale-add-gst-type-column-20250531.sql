ALTER TABLE `pos_sale`
ADD COLUMN `gst_type_id` INT NOT NULL DEFAULT '1' AFTER `total`;