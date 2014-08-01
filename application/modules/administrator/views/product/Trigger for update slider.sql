DELIMITER ;;

CREATE TRIGGER UpdateSlider AFTER UPDATE ON tbl_product
FOR EACH ROW
	IF (NEW.isSlider != OLD.isSlider) THEN
	  	IF (NEW.isSlider = 2) THEN
	  		DELETE FROM slider where slider.pro_id = tbl_product.pro_id;
	  	END IF;
	  	ELSE IF (NEW.isSlider = 1) THEN
	  		INSERT INTO slider (pro_id,pro_images,pro_order) VALUES (tbl_product.pro_id,tbl_product.pro_images,tbl_product.MAX(pro_order) + 1)
	END IF;
;

DELIMITER ;