<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class mod_category_process extends modules_models
    {
	     function get_category_list()
        {
            return $this->dbObj->SqlQueryOutputResult("
            
                SELECT
						product_category.cat_id,
						product_category.catid_array,
						product_category.title,
						product_category.alias,
						product_category.image,
						product_category.description
					FROM
					product_category 
					WHERE product_category.checked = 1 and product_category.enabled = 1", array());
        }
    }