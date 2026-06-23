<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	$lang_text = $core_class->load_module_language('com_content_article_view', $GLOBALS['LANG']);

	include_once('com_content.article.models.php');
	
	if (count($GLOBALS['LANG_LIST']) > 1)
	{
		$__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];
		$__append = $GLOBALS['LANG'] . '/';
	}
	else
	{
		$__home = $GLOBALS['INDEX'];
		$__append = '';
	}

	$myprocess =  new process_article();
	$result = $myprocess->get_article( intval($_GET["id"]) );

	if ($row = $result->fetch())
	{
        $pathways = $myprocess->get_pathway( $row['category_id'] );		
		
		for($i = 0; $i < count($pathways); $i++){
			$link .= "/" . $pathways[$i]["alias"]. "/cn". $pathways[$i]["cat_id"] . $GLOBALS['EXT'];
			$pathway_text .= "<li class=\"m_right_8 f_xs_none\"><i class=\"icon-angle-right d_inline_m color_default fs_small\"></i><a href=\"$link\" class=\"color_dark d_inline_m m_left_10\">" . $pathways[$i]["title"] . "</a></li>";
		}
		
		$image_bg = "image_bg_website";
		$meta_title = $row['title'];
		$meta_keyword = $row['keyword'];
		$meta_description = $row['keyword_desc'];
?>
<div class="sitemap-container container">
	<h1 class="sitemap-header text-primary"><?php echo $row['title'];?></h1>
	<ul class="dotted_list m_bottom_5 color_grey_light_2 m_bottom_10">
		<li class="m_right_15 relative d_inline_m">
			<a class="color_grey fs_small">
				<i>Đăng bởi:  <?= $row['fullName']; ?></i>
			</a>
		</li>                   
	</ul>
	<div class="m_bottom_20">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class="clear">
			<div class="fb-send" data-href="<?= "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"></div>
			<div class="fb-like" data-href="<?= "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<g:plusone size='medium' ></g:plusone>
		</div>
	</div>              
	<?php echo $row['content'];?>
</div>
        
<?php
	}
?>