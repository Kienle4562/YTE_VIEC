<?php defined( '_VALID_MOS' ) or die( include("404.php") );

class Pager
{ 
	function getPagerData($numHits, $limit, $page, $selfUrl)
	{
		$numHits = (int) $numHits; //tong so mau tin
		$limit = max((int) $limit, 1); //so mau tin moi trang
		$page = (int) $page; //so trang dang duyet
		$numPages = ceil($numHits / $limit); // tinh tong so trang
		$page = max($page, 1); //neu page < 1 thì page = 1
		$page = min($page, $numPages); //neu page>$numPages thì page=$numPages
		$offset = abs($page - 1) * $limit;
		
		$maxP = 4;
		$revpage = $page - 1;
		$nexpage = $page + 1;
		
		if ($page <= 1) { $class1 = "disabled"; $link_trangdau = "javascript:void(0)"; $link_trangke = "javascript:void(0)"; }
		else { $link_trangdau = $selfUrl . "page=1"; $link_trangke = $selfUrl . "page=$revpage"; }
		
		//$paging = $paging . "<li><a href=\"$link_trangdau\" class=\"rc_first_hr color_dark\"><</a></li>";
		//$paging = $paging . "<li><a href=\"$link_trangke\">Trang kế</a></li>";
		
		$page = $page;
		$pages = $numPages;
		$hien_tai = $page;
		$bien_trai = $hien_tai - $maxP;
		$bien_phai = $hien_tai + $maxP;

		if ($bien_trai<1) $bien_trai = 1;
		
		if ($bien_phai>$pages){
			$bien_phai = $pages;
		}
		if ($bien_trai>1){
			$paging = $paging."<li><a href=" . $selfUrl . "page=1\" class=\"color_dark\">1</a></li>";
			if ($bien_trai - 1 != 1){
				$paging .= "<li><a class='pagec'>...</a></li>";
			}
		}
		//if ($bien_trai>2) $paging = $paging . "<li><a href=\"javascript:void(0)\">...</a></li>";

		for ($i=$bien_trai; $i<=$bien_phai; $i++)
		{
			if ($i==$hien_tai)
				$paging = $paging . "<li class=\"active\"><a href=\"javascript:void(0)\" class=\"color_dark\">$i</a></li>";
			else
				$paging = $paging."<li><a href=" . $selfUrl ."page=$i" . " class=\"color_dark\">$i</a></li>";
		}

		//if($bien_phai<$pages) $paging = $paging . "<li><a href=\"javascript:void(0)\">...</a></li>";

		if($bien_phai<$pages - 1){
			$paging .= "<li><a class='pagec'>...</a></li>";
			$paging = $paging . "<li><a href=" . $selfUrl . "page=$pages" . " class=\"color_dark\">$pages</a></li>";
		}
				
		if ($page >= $pages) { 
			$class2 = "disabled"; $link_trangcuoi = "javascript:void(0)"; $link_trangsau = "javascript:void(0)"; 
		}
		else { 
			//$link_trangcuoi = $selfUrl ."page=$pages"; $link_trangsau = $selfUrl . "page=$nexpage"; 
		}
		
		//$paging = $paging . "<li class=\"$class2\"><a href=\"$link_trangsau\">Trang sau</a></li>";
		//$paging = $paging . "<li><a href=\"$link_trangcuoi\" class=\"rc_last_hr color_dark\">></a></li>";
		
		$ret = new stdClass; 
		$ret->offset = $offset;
		$ret->limit = $limit; 
		$ret->numPages = $numPages; 
		$ret->page = $page; 
		$ret->paging = $paging;
		$ret->tongsodong = $numHits;
		$ret->somautin = $limit;
		return $ret;
	} 

} 

?> 