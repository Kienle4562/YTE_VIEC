<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );



    class process_congviec extends modules_models

    {

	   public function getData($where = "")

        {

            $sql = "SELECT

			trn_congty.hinhanh,

			trn_congty.tencongty,

			LOWER(trn_congviec.tencongviec) AS tencongviec,

			trn_congviec.congviec_id,

			trn_congviec.ngaydang,

			trn_congviec.ngayhethan,

			trn_congviec.hot_job,

			trn_congviec.motacongviec,

			trn_congviec.soluongcantuyen,

			mst_tinhthanh.ten_tinhthanh as diadiemlamviec

			FROM

			trn_congviec

			LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

			LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

			{$where} ORDER BY trn_congviec.hot_job DESC, trn_congviec.pin DESC , trn_congviec.DISORDER DESC limit 0,56";
			

            $result = $this->dbObj->SqlQueryOutputResult($sql, array());

            return $result;

        } 

		   public function getData_2($where = "")

        {

            $sql = "SELECT

			trn_congty.hinhanh,

			trn_congty.tencongty,

			trn_congviec.tencongviec,

			trn_congviec.congviec_id,

			trn_congviec.ngaydang,

			trn_congviec.motacongviec,

			trn_congviec.soluongcantuyen,

			trn_congviec.ngayhethan,

			mst_tinhthanh.ten_tinhthanh as diadiemlamviec

			FROM

			trn_congviec

			LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

			LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

			 {$where} ORDER BY trn_congviec.DISORDER DESC limit 0,3";

			

            $result = $this->dbObj->SqlQueryOutputResult($sql, array());

            return $result;

        } 

		   public function get_cty($where = "")

			{

				$sql = "SELECT * FROM (

							SELECT

								trn_congty.tencongty,

								trn_congty.congty_id,

								trn_congviec.DISORDER

							FROM

								trn_congviec

							LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

							ORDER BY trn_congviec.DISORDER DESC 

						) a GROUP BY a.congty_id

						ORDER BY a.DISORDER DESC LIMIT 11";

				$result = $this->dbObj->SqlQueryOutputResult($sql, array());

				return $result;

			} 

	/* 	 public function getData($where = "")

        {

            $sql = "(SELECT

	trn_congty.hinhanh,

	trn_congty.tencongty,

	trn_congviec.tencongviec,

	trn_congviec.congviec_id,

	trn_congviec.ngaydang,

	trn_congviec.motacongviec,

	trn_congviec.soluongcantuyen,

	mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,

	trn_congty.congty_id

FROM

	trn_congviec

LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

LEFT JOIN mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

WHERE trn_congty.congty_id = 821 ORDER BY trn_congty.congty_id DESC LIMIT 3)

UNION 

(SELECT

	trn_congty.hinhanh,

	trn_congty.tencongty,

	trn_congviec.tencongviec,

	trn_congviec.congviec_id,

	trn_congviec.ngaydang,

	trn_congviec.motacongviec,

	trn_congviec.soluongcantuyen,

	mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,

	trn_congty.congty_id

FROM

	trn_congviec

LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

LEFT JOIN mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

WHERE trn_congty.congty_id = 820 ORDER BY trn_congty.congty_id DESC LIMIT 3)

UNION 

(SELECT

	trn_congty.hinhanh,

	trn_congty.tencongty,

	trn_congviec.tencongviec,

	trn_congviec.congviec_id,

	trn_congviec.ngaydang,

	trn_congviec.motacongviec,

	trn_congviec.soluongcantuyen,

	mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,

	trn_congty.congty_id

FROM

	trn_congviec

LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

LEFT JOIN mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

WHERE trn_congty.congty_id = 819 ORDER BY trn_congty.congty_id DESC LIMIT 3)

UNION 

(SELECT

	trn_congty.hinhanh,

	trn_congty.tencongty,

	trn_congviec.tencongviec,

	trn_congviec.congviec_id,

	trn_congviec.ngaydang,

	trn_congviec.motacongviec,

	trn_congviec.soluongcantuyen,

	mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,

	trn_congty.congty_id

FROM

	trn_congviec

LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

LEFT JOIN mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

WHERE trn_congty.congty_id = 185 ORDER BY trn_congty.congty_id DESC LIMIT 3)

UNION 

(SELECT

	trn_congty.hinhanh,

	trn_congty.tencongty,

	trn_congviec.tencongviec,

	trn_congviec.congviec_id,

	trn_congviec.ngaydang,

	trn_congviec.motacongviec,

	trn_congviec.soluongcantuyen,

	mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,

	trn_congty.congty_id

FROM

	trn_congviec

LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

LEFT JOIN mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

WHERE trn_congty.congty_id = 817 ORDER BY trn_congty.congty_id DESC LIMIT 3)

UNION 

(SELECT

	trn_congty.hinhanh,

	trn_congty.tencongty,

	trn_congviec.tencongviec,

	trn_congviec.congviec_id,

	trn_congviec.ngaydang,

	trn_congviec.motacongviec,

	trn_congviec.soluongcantuyen,

	mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,

	trn_congty.congty_id

FROM

	trn_congviec

LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

LEFT JOIN mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

WHERE trn_congty.congty_id = 816 ORDER BY trn_congty.congty_id DESC LIMIT 3)";

            $result = $this->dbObj->SqlQueryOutputResult($sql, array());

            return $result;

        }

 */

		public function get_category_list($id, $limit, $lang_code)

        {

        	$limit_query = "";

            

            if (is_numeric($limit) && $limit > 0) {

                $limit_query = "LIMIT " . $limit;

            }

            

            if ($id == 0) {

				$cond = '';

				$sql_params = array($lang_code);

            }

            else {

				$cond = 'AND `category_id` IN

						(

							SELECT

								`category`.`cat_id`

							FROM

								`category`,

								(

									SELECT

											`left`,

											`right`

									FROM

											`category`

									WHERE

											`category`.`cat_id` = ?

									LIMIT 0,1

								) as a

							WHERE

									`category`.`left` >= a.`left`

									AND `category`.`right` <= a.`right` 

									AND `category`.`lang_code` = ?

						)';

				

				$sql_params = array($lang_code, $id, $lang_code);

            }

		 	

			 $sql = "SELECT * FROM `news` WHERE `lang_code` = ? AND `enabled` = 1

			 		 {$cond}

					 order by ordering desc

					 {$limit_query} ";

			$result = $this->dbObj->SqlQueryOutputResult($sql, $sql_params);

			

			return $result;

        }

		

		public function get_category_list_by_newsid($id, $limit, $lang_code)

        {

        	$limit_query = "";

            

            if (is_numeric($limit) && $limit > 0) {

                $limit_query = "LIMIT " . $limit;

            }

            

            if ($id == 0) {

				$cond = '';

				$sql_params = array($lang_code);

            }

            else {

				$cond = 'AND `news`.`news_id` = ?';

				

				$sql_params = array($lang_code, $id);

            }

		 	

			 $sql = "SELECT * FROM `news` WHERE `lang_code` = ? AND `enabled` = 1

			 		 {$cond}

					 order by ordering desc

					 {$limit_query} ";

			$result = $this->dbObj->SqlQueryOutputResult($sql, $sql_params);

			

			return $result;

        }

		

		public function category_list($id, $delim = ' » ', $col = 'title')

        {

            $cond = '';



            if (is_numeric($id)) {

                $cond = '`cat_id` = ?';

            }

            else {

                $cond = '`alias` = ?';

            }

            

            $result = $this->dbObj->SqlQueryOutputResult("



                SELECT REPLACE(GROUP_CONCAT(c.`{$col}` ORDER BY c.`left` ASC), ',', '{$delim}') as `result`

                FROM (

                                SELECT

                                        `category`.`{$col}`,

                                        '1' as `tmp_col`,

                                        `category`.`left`

                                FROM

                                        `category`,

                                        (

                                            SELECT

                                                    `left`,

                                                    `right`

                                            FROM

                                                    `category`

                                            WHERE

                                                    {$cond}

                                                    AND `lang_code` = ?

                                            LIMIT 0,1

                                        ) as a

                                WHERE

                                		`category`.`left` <= a.`left`

                                		AND `category`.`right` >= a.`right`

                                		AND `category`.`lang_code` = ?

                ) as c

                GROUP BY c.`tmp_col`

            

            ", array($id, $GLOBALS['LANG'], $GLOBALS['LANG']));

            

            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                return $row['result'];

            }

            else {

                return '';

            }

        }

    }