<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
	$lang_text = $core_class->load_module_language('com_content_category_view', $GLOBALS['LANG']);
	
	include_once('com_content.category.models.php');
	include_once('protected/paging.php');
	
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
	$categoryProc =  new process_category();
    /* predefine something */
    $cat_id = intval($_GET['id']);
    $category_title = $categoryProc->get_category_title($cat_id);    
    $meta_title = $category_title;
    
?>
<div class="container bglight">
    <div class="row dwlb">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 typical-home">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="title">BÀI VIẾT NỔI BẬT</h1>
            </div>
            <?php
                $resultBVNB = $categoryProc->getBaiVietNoiBat();
                $rowBVNB = $resultBVNB->fetch();
                $LinkBVNB = $GLOBALS['INDEX'] . $__append . $rowBVNB["alias"] . "/n" . $rowBVNB["news_id"] . $GLOBALS['EXT'];
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 image">
                <a href="<?php echo $LinkBVNB ?>">
                    <img height="auto" class="img-responsive" src="<?php echo $rowBVNB['img_file'] ?>" alt="<?php echo $rowBVNB['title'] ?>">
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 description">
                <h2>
                    <a href="<?php echo $LinkBVNB ?>"><?php echo $rowBVNB['title'] ?></a>
                </h2>
                <p style="text-align: justify;"><?php echo $rowBVNB['description'] ?></p>
                <p><a href="<?php echo $LinkBVNB ?>" class="readmore">Đọc thêm</a></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 typical-right" id="pagingID">
			<ul id="listPage">
				<?php
						$result = $categoryProc->get_category($cat_id, 0,30, "AND news.focus = 0");
						while($row = $result->fetch()){
						$Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
				?>
					<li>
						<div class="thumb">
							<a href="<?php echo $Link ?>">
								<?php
									$srcHinhanh = "/images/logo.png";
									if(!empty($row["img_file"]) && strpos($row["img_file"], "noimage") == false){
										$srcHinhanh = $row["img_file"];
									}
								?>
								<img src="<?php echo $srcHinhanh ?>" width="110px">
							</a>
						</div>
						<div class="title">
							<span class="category">
								<a href="<?php echo $Link ?>"><?php echo $row["title"] ?></a>
							</span>
							<p class="article">
								<?php echo $core_class->SmartContent($row["description"], 120); ?>
							</p>
						</div>
					</li>
				<?php 
					}
				?>         
			</ul>
        </div>
    </div>

    <section id="most-articles" class="content">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h1><span>MỚI NHẤT</span></h1>
            <div class="articles">
                <?php
                    $result = $categoryProc->get_category($cat_id, 0, 20, "AND news.focus = 0", "ORDER BY DISPORDER DESC");
                    while($row = $result->fetch()){
                        $Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 thumb">
                        <?php
                            $srcHinhanh = "/images/logo.png";
                            if(!empty($row["img_file"]) && strpos($row["img_file"], "noimage") == false){
                                $srcHinhanh = $row["img_file"];
                            }
                        ?>
                        <a href="<?php echo $Link ?>">
                            <img alt="<?php echo $row["title"] ?>" src="<?php echo $srcHinhanh ?>"/>
                        </a>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        <div class="title">
                            <span class="article">
                                <a href="<?php echo $Link ?>"><?php echo $row["title"] ?></a>
                            </span>
                        </div>
                        <div class="description">
                            <p><?php echo $core_class->SmartContent($row["description"], 150); ?></p>
                            <p><a href="<?php echo $Link ?>" class="readmore">Đọc thêm</a></p>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h1><span>XEM NHIỀU NHẤT</span></h1>
            <div class="articles">
                <?php
                    $result = $categoryProc->get_category($cat_id, 0, 20, "AND news.focus = 0", "ORDER BY num_view DESC");
                    while($row = $result->fetch()){
                        $Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 thumb">
                        <?php
                            $srcHinhanh = "/images/logo.png";
                            if(!empty($row["img_file"]) && strpos($row["img_file"], "noimage") == false){
                                $srcHinhanh = $row["img_file"];
                            }
                        ?>
                        <a href="<?php echo $Link ?>">
                            <img alt="<?php echo $row["title"] ?>" src="<?php echo $srcHinhanh ?>"/>
                        </a>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        <div class="title">
                            <span class="article">
                                <a href="<?php echo $Link ?>"><?php echo $row["title"] ?></a>
                            </span>
                        </div>
                        <div class="description">
                            <p><?php echo $core_class->SmartContent($row["description"], 150); ?></p>
                            <p><a href="<?php echo $Link ?>" class="readmore">Đọc thêm</a></p>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
      $(function() {
        $("#listPage").JPaging({
          pageSize: 6
        });
      });
    </script>