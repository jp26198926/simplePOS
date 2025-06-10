ALTER TABLE `pos_product`
ADD COLUMN `gst_type_id` INT(11) NOT NULL DEFAULT '1' AFTER `category_id`;