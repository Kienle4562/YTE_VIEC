<?php

    class com_content_category
    {
        public $dbObj;
    
        function __construct()
        {
             $this->dbObj = new classDb();
        }
        
        /* 
         * Hàm cập nhật lại toàn bộ giá trị catid_array của các chuyên mục
         * 
         * - Author: Sang Lu
         * - Time: 2012-06-22 11:21
         * 
         */
        /*
        function UpdateChildrenIdList($parent = 0)
        {
            $sql = '';
            
            $this->UpdateChildrenIdListProcess($parent, $sql);
            
            $this->dbObj->SqlQueryInputResult($sql, array());
        }
        */
        
        /* 
         * Hàm tạo các câu lệnh SQL dùng để cập nhật lại toàn bộ giá trị 
         * catid_array của các chuyên mục (xem hàm UpdateChildrenIdList)
         * 
         * - Author: Sang Lu
         * - Time: 2012-06-22 11:21
         * 
         */
        /*
        function UpdateChildrenIdListProcess($parent = 0, &$sql)
        {
            $result = $this->dbObj->SqlQueryOutputResult("
                SELECT
                        `cat_id`
                FROM
                        `category`
                WHERE
                        `parent_id` = {$parent}
            ", array());
            
            $IdList = '';
            
            while ($record = $result->fetch(PDO::FETCH_ASSOC)) {
                $IdList = $IdList . ',' . $this->UpdateChildrenIdListProcess($record['cat_id'], $sql);
            }
            
            $IdList = $parent . $IdList;
            
            $sql .= "
                UPDATE
                        `category`
                SET
                        `catid_array` = \"{$IdList}\"
                WHERE
                        `cat_id` = {$parent} ;
            ";
            
            return $IdList;
        }
        */
        
        
        public function category_multi_level($parentid, $lang_code)
        {
            $sql = "SELECT
                      `category`.`cat_id`, `category`.`title`, `category`.`date_add`, `category`.`enabled`, `category`.`ordering`, `category`.`num_view`
                    FROM `category`
                    WHERE parent_id = ? AND `lang_code` = ?
                    ORDER BY `ordering`";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
            return $result;
        }
        
        /**
         * Cập nhật lại các giá trị left, right cho các chuyên mục. Nếu giá trị $parent = 0 thì
         * có nghĩa là cập nhật lại giá trị left, right cho tất cả các chuyên mục.
         * 
         * @param int $parent
         * Số ID của chuyên mục chứa các chuyên mục cần cập nhật
         * 
         * @param int $type
         * Loại của chuyên mục, mặc định là -1 (loại chuyên mục tin tức)
         * 
         * @return bool
         */
        public function reset_left_right_value()
        {
            $left = 0;
            $sql = '';
            
            $result = $this->dbObj->SqlQueryOutputResult("
                SELECT
                        `cat_id`,
                        `parent_id`
                FROM
                        `category`
            ", array());
            
            $array = array();
            
            while ($row = $result->fetch())
            {
                $array[] = array(
                            'id'         =>     $row['cat_id'],
                            'parent'     =>     $row['parent_id']
                        );
            }
            
            if (!empty($array))
            {
                $this->reset_left_right_value_sql_generator($sql, 0, $left, $array);

                if (trim($sql) != "") {
                    return $this->dbObj->SqlQueryInputResult($sql, array());
                }
                else {
                    return true;
                }
            }
            else
            {
                return true;
            }
        }
        
        
        /**
         * Tạo chuỗi truy vấn để cập nhật giá trị left, right cho danh sách các chuyên mục
         * 
         * @param string $sql
         * Chuỗi chứa các câu lệnh SQL để cập nhật giá trị left, right
         * 
         * @param int $parent
         * Số ID của chuyên mục cha chứa các chuyên mục cần cập nhật giá trị left, right
         * 
         * @param int $left
         * Giá trị left hiện tại của các vòng lặp
         * 
         * @param array $array
         * Mảng chứa danh sách tất cả các chuyên mục. Mảng này cần có dạng như sau:
         *         array(
         *                 'id'        =>    <ID chuyên mục>,
         *                 'parent'    =>    <ID của chuyên mục cha chứa nó>
         *         )
         * 
         * @param int $type
         * Loại của chuyên mục, mặc định là -1 (loại chuyên mục tin tức)
         * 
         * @return null
         * Hàm không trả về giá trị mà sẽ gán trực tiếp qua biến $sql
         */
        private function reset_left_right_value_sql_generator(&$sql, $parent, &$left, &$array)
        {
            $count = count($array);
            
            for ($i = 0; $i < $count; $i++)
            {
                if ($array[$i]['parent'] == $parent)
                {
                    $left++;
                    
                    $sql .= "   UPDATE
                                        `category`
                                SET
                                        `category`.`left` = {$left}
                                WHERE
                                        `category`.`cat_id` = {$array[$i]['id']} ;
                            ";
    
                    $this->reset_left_right_value_sql_generator($sql, $array[$i]['id'], $left, $array);
                    
                    $left++;
                    
                    $sql .= "   UPDATE
                                        `category`
                                SET
                                        `category`.`right` = {$left}
                                WHERE
                                        `category`.`cat_id` = {$array[$i]['id']} ;
                            ";
                }
            }
        }
    }