ALTER TABLE `pos_transaction` 
ADD `gst_percent` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `total`, 
ADD `gst_value` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `gst_percent`, 
ADD `tax_base` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `gst_value`;

ALTER TABLE `pos_sale` 
ADD `gst_percent` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `total`, 
ADD `gst_value` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `gst_percent`, 
ADD `tax_base` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `gst_value`;