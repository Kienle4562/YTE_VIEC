<?php defined( '_VALID_MOS' ) or die( include("404.php") ); 

class Pager 
{
	function getPagerData($numHits, $limit, $page)
	{ 

		//kiem tra du lieu nhap

		$numHits = (int) $numHits; //tong so mau tin

		$limit = max((int) $limit, 1); //so mau tin moi trang

		$page = (int) $page; //so trang dang duyet

		$numPages = ceil($numHits / $limit); // tinh tong so trang

		

		$page = max($page, 1); //neu page < 1 thì page = 1

		$page = min($page, $numPages); //neu page>$numPages thì page=$numPages

		$offset = ($page - 1) * $limit; 	

		$maxP = 2;

		$revpage = $page - 1;

		$nexpage = $page + 1;

		//$paging = "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=1; document.phpForm.submit();return false;\"> <<-- Trang đầu </a>";

		if($page == 1 || $page == 0) $paging = $paging . "<<-- Trang đầu <- Trang trước ";

		else $paging = $paging . "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=1; document.phpForm.submit();return false;\"> <<-- Trang đầu </a> <a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=$revpage; document.phpForm.submit();return false;\"> <- Trang trước </a>";

		$page = $page;

		$pages = $numPages;

		

		$hien_tai = $page;

		$bien_trai = $hien_tai - $maxP;

		$bien_phai = $hien_tai + $maxP;

		if ($bien_trai<1) $bien_trai = 1;

		if ($bien_phai>$pages) $bien_phai = $pages;

		if ($bien_trai>1) $paging = $paging . "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=1; document.phpForm.submit();return false;\"> 1 </a>";

		if ($bien_trai>2) $paging = $paging . " ... ";

	

		for($i=$bien_trai; $i<=$bien_phai; $i++)

		{

			if ($i==$hien_tai)

				$paging = $paging . "<span>[" . $i . "]</span>";

			else

				$paging = $paging . "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=$i; document.phpForm.submit();return false;\"> " . $i . " </a>";

		}

		

		if($bien_phai<$pages) $paging = $paging .  " ... ";

		if($bien_phai<$pages - 1) $paging = $paging . "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=$pages; document.phpForm.submit();return false;\"> " . $pages . " </a>";

		if($page == $pages) $paging = $paging . " Trang sau -> Trang cuối -->";

		else $paging = $paging . "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=$nexpage; document.phpForm.submit();return false;\"> Trang sau -> </a> <a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=$pages; document.phpForm.submit();return false;\"> Trang cuối  -->> </a>";

		//$paging = $paging . "<a style=\"cursor: pointer\" href=\"javascript:void(0);\" onClick=\"javascript:document.phpForm.page.value=$pages; document.phpForm.submit();return false;\"> Trang cuối  -->> </a>";

		

		//echo $paging;

		

		$ret = new stdClass; 

		$ret->offset = $offset; 
		
		$ret->limit = $limit + $offset; 

		$ret->numPages = $numPages; 

		$ret->page = $page; 

		$ret->paging = $paging; 

		return $ret;

	} 

} 

?> 