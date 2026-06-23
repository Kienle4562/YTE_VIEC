<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	class process_article
    {
		private $dbObj;        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		public function get_article($id)
		{
			$sql = "SELECT
			trn_congty.congty_id,
			trn_congty.hinhanh,
			trn_congty.tencongty,
			trn_congty.web,
			trn_congty.banner,
			trn_congty.urlfacebook,
			trn_congty.diachicongty,
			trn_congty.gioithieungan,
			pl1.content as icon_pl1,
			pl2.content as icon_pl2,
			pl3.content as icon_pl3,
			pl4.content as icon_pl4,
			pl5.content as icon_pl5,
			pl6.content as icon_pl6,
			mst_quymo.tenquymo as quymo
			FROM
			trn_congty
			left Join mst_quymo ON trn_congty.quymo_id = mst_quymo.quymo_id
			left Join mst_loaiphucloi pl1 ON trn_congty.loaiphucloi_id1 = mst_loaiphucloi.loaiphucloi_id
			left Join mst_loaiphucloi pl2 ON trn_congty.loaiphucloi_id2 = mst_loaiphucloi.loaiphucloi_id
			left Join mst_loaiphucloi pl3 ON trn_congty.loaiphucloi_id3 = mst_loaiphucloi.loaiphucloi_id
			left Join mst_loaiphucloi pl4 ON trn_congty.loaiphucloi_id4 = mst_loaiphucloi.loaiphucloi_id
			left Join mst_loaiphucloi pl5 ON trn_congty.loaiphucloi_id5 = mst_loaiphucloi.loaiphucloi_id
			left Join mst_loaiphucloi pl6 ON trn_congty.loaiphucloi_id6 = mst_loaiphucloi.loaiphucloi_id
			WHERE trn_congty.congty_id = ?
			";
			return $this->dbObj->SqlQueryOutputResult($sql, array($id));
		}
		public function get_quimo($IDQM)
		{
			$sql = "SELECT
							mst_quymo.quymo_id,
							mst_quymo.tenquymo,
							mst_quymo.DISORDER
						FROM
							mst_quymo
						WHERE  mst_quymo.quymo_id = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($IDQM));
		}
		public function check_danhgia($Idcty,$UseID)
		{
			$sql = "SELECT
							trn_raiting.Id_congTy,
							trn_raiting.idStart,
							trn_raiting.Case_1,
							trn_raiting.Case_2,
							trn_raiting.Case_3,
							trn_raiting.Case_4,
							trn_raiting.Tongquan,
							trn_raiting.UseID
						FROM
							trn_raiting
						WHERE trn_raiting.Id_congTy = ? AND  trn_raiting.UseID = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($Idcty,$UseID));
		}
		public function check_vote($Idcty,$UseID)
		{
			$sql = "SELECT
							trn_like_unlike.id,
							trn_like_unlike.userid,
							trn_like_unlike.IdCongty,
							trn_like_unlike.type,
							trn_like_unlike.`timestamp`
						FROM
							trn_like_unlike
						WHERE trn_like_unlike.IdCongty = ? AND  trn_like_unlike.userid = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($Idcty,$UseID));
		}
		public function rowTotal($id,$id_company)
			{
				$result = $this->dbObj->SqlQueryOutputResult("
					SELECT
							COUNT(*) as `count`
					FROM
							`trn_congviec`
					LEFT Join `trn_congty` ON `trn_congty`.`congty_id` = `trn_congviec`.`congty_id`
					WHERE
							`congviec_id` < ?  AND trn_congty.congty_id = ? ORDER BY congviec_id DESC
				", array($id,$id_company));
				if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					return intval($row['count']);
				}
				else {
					return 0;
				}
			}
				public function load_more($id,$id_company,$limit)
					{
						$sql = "SELECT
								trn_congviec.tencongviec,
								trn_congviec.congviec_id,
								trn_congviec.disorder as ngaydang,
								mst_tinhthanh.ten_tinhthanh as diadiemlamviec,
								trn_congviec.follow
							FROM
								trn_congviec
							LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
							LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
							WHERE `congviec_id` < ?  AND trn_congty.congty_id = ? AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 ORDER BY congviec_id DESC limit $limit";
							return $this->dbObj->SqlQueryOutputResult($sql, array($id,$id_company));
					}
		public function get_start($Idcty)
		{
			$sql = "SELECT
							trn_raiting.idStart,
							trn_raiting.Id_congTy,
							trn_raiting.Case_1,
							trn_raiting.Case_2,
							trn_raiting.Case_3,
							trn_raiting.Case_4,
							trn_raiting.Tongquan,
							trn_raiting.UseID,
							trn_raiting.DateAdd
						FROM
							trn_raiting
						WHERE trn_raiting.Id_congTy = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($Idcty));
		}
		public	function calcAverageRating($ratings)
								{
									$totalWeight = 0;
									$totalReviews = 0;
									foreach ($ratings as $weight => $numberofReviews) {
										if ($ratings[$weight] === 0) {
											unset($ratings[$weight]);
										}else{
										
										$WeightMultipliedByNumber = $weight * $numberofReviews;
										$totalWeight += $WeightMultipliedByNumber;
										$totalReviews += $numberofReviews;
											
										}
									}
									//divide the total weight by total number of reviews
									$averageRating = @($totalWeight / $totalReviews);
									return $averageRating;
								}
							public function get_job($company_id)
							{
								$sql = "SELECT
								trn_congviec.tencongviec,
								trn_congviec.congviec_id,
								trn_congviec.disorder as ngaydang,
								mst_tinhthanh.ten_tinhthanh as diadiemlamviec,
								trn_congviec.follow
								FROM
								trn_congviec
								LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
								LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
								
								WHERE trn_congty.congty_id = ? AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 ORDER BY congviec_id DESC limit 0,5";
								return $this->dbObj->SqlQueryOutputResult($sql, array($company_id));
							}
		
		public function get_loaihinh($idloaihinh)
		{
			$sql = "SELECT
							mst_loaihinhhoatdong.loaihinhhoatdong_id,
							mst_loaihinhhoatdong.tenloaihinhhoatdong,
							mst_loaihinhhoatdong.DISORDER
						FROM
							mst_loaihinhhoatdong
						WHERE mst_loaihinhhoatdong.loaihinhhoatdong_id = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($idloaihinh));
		}
	}
	if (!empty($_POST['act']))
    {
        switch ($_POST['act'])
        {
			case "followInsert":
				
				if($_POST['id_company'] > 0)
				{
					$FollowID = $core_class->findValues("trn_congty", "follow", array("congty_id" => $_POST['id_company']));
					$checkFL = explode(",",$FollowID);
					$checktotal = in_array(intval($_SESSION["career"]['career_id']), $checkFL);
					if(!empty($FollowID))
					{
						$ReturnFL = $FollowID.",".$_SESSION["career"]['career_id'];
						
					}else{
						
						$ReturnFL = $_SESSION["career"]['career_id'];
					}
					
					$totalFL = explode(",",$ReturnFL);
					$arrayInput = array(
							'follow' => $ReturnFL,
						);
				
					if($checktotal == 1 )
					{
						echo '{"IsError":1,"lbname":"UnFollow","msg":"Bạn đã theo dõi"}';
						
					}else
					{
						$flagUpdate = $core_class->update("trn_congty", $arrayInput, array(
						'congty_id' => $_POST['id_company']
						));
						if($flagUpdate)
						{
							echo '{"IsError":1,"lbname":"UnFollow","msg":"Bạn đã theo dõi","totalFL":"'.count(array_filter($totalFL)).'"}';
						}
						else
						{
							echo '{"IsError":0,"msg":"Xử lý bị lỗi"}';
						}
					}
					
					
				}
			break;
			case "raitingStar":
				if($_SESSION["career"]['career_id'] > 0 ) 
				{
					 $myprocess = new process_article();
					 $result = $myprocess ->check_danhgia($_POST['id_company'],$_SESSION["career"]['career_id']);
					 $case_id = $_POST['case_mode'];
					 if ($result == null || $result->rowCount() == 0)
					  {
						   $raitingStarr = array(
								'Id_congTy'		    => $_POST['id_company'],
								 $case_id 			=> intval($_POST['value_rating']),
								'UseID'			    => $_SESSION["career"]['career_id'],
								'DateAdd'			=> date("Y-m-d H:i:s"),
							);
						$insertStarr = $core_class->insert("trn_raiting", $raitingStarr);
						if($insertStarr)
						{
							   $count5 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									$case_id => 5,
								));
								$count4 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									$case_id => 4,
								));
								$count3= $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									$case_id => 3,
								));
								$count2 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									$case_id => 2,
								));
								$count1 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									$case_id => 1,
								));
								$ratings = array(
									5 => intval($count5['COUNT(1)']),
									4 => intval($count4['COUNT(1)']),
									3 => intval($count3['COUNT(1)']),
									2 => intval($count2['COUNT(1)']),
									1 => intval($count1['COUNT(1)'])
								);
								$totalRaiting = $myprocess->calcAverageRating($ratings);
								    $labelCASE = "";
										if(intval($totalRaiting) == 5)
												{
													$labelCASE = ' Tuyệt vời';
													
												}else if(intval($totalRaiting) == 4)
												{
													$labelCASE = ' Rất tốt';
													
												}else if(intval($totalRaiting) == 3)
												{
													$labelCASE = 'Tốt';
													
												}else if(intval($totalRaiting) == 2)
												{
													$labelCASE = ' Cần cải thiện nhiều';
													
												}else if(intval($totalRaiting) == 1)
												{
													$labelCASE = ' Rất tệ';
												}
												
								echo '{"IsError":1,"msg":"Bạn vừa đánh giá","labelName":"'.$labelCASE.'","Tongquan":"'.intval($_POST['value_rating']).'","tongtrungbinh":"'.intval($totalRaiting).'"}';
								
						}else{
								echo '{"IsError":0,"msg":"Đánh giá lỗi"}';
							}
					  }else
					  {
						  if($row = $result->fetch())
							 {
								if($row[$case_id]== 0)
								{
									$raiting_Starr = array(
										 $case_id			=> intval($_POST['value_rating']),
										'DateAdd'			=> date("Y-m-d H:i:s"),
										);
										
										$OverViewUpdate = $core_class->update("trn_raiting", $raiting_Starr, array(
										'Id_congTy' => $_POST['id_company'],
										'UseID'	    => $_SESSION["career"]['career_id']
									));
									if($OverViewUpdate)
									{
											$count5 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												$case_id => 5,
											));
											$count4 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												$case_id => 4,
											));
											$count3= $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												$case_id => 3,
											));
											$count2 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												$case_id => 2,
											));
											$count1 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												$case_id => 1,
											));
											$ratings = array(
												5 => intval($count5['COUNT(1)']),
												4 => intval($count4['COUNT(1)']),
												3 => intval($count3['COUNT(1)']),
												2 => intval($count2['COUNT(1)']),
												1 => intval($count1['COUNT(1)'])
											);
											$totalRaiting = $myprocess->calcAverageRating($ratings);
											$labelCASE = "";
											if(intval($totalRaiting) == 5)
												{
													$labelCASE = ' Tuyệt vời';
													
												}else if(intval($totalRaiting) == 4)
												{
													$labelCASE = ' Rất tốt';
													
												}else if(intval($totalRaiting) == 3)
												{
													$labelCASE = 'Tốt';
													
												}else if(intval($totalRaiting) == 2)
												{
													$labelCASE = ' Cần cải thiện nhiều';
													
												}else if(intval($totalRaiting) == 1)
												{
													$labelCASE = ' Rất tệ';
												}
											echo '{"IsError":1,"msg":"Bạn vừa đánh giá","labelName":"'.$labelCASE.'","Tongquan":"'.intval($_POST['value_rating']).'","tongtrungbinh":"'.round($totalRaiting, 2).'"}';
									}else{
											echo '{"IsError":0,"msg":"Đánh giá lỗi"}';
										}
									 
								}else
								{
									echo '{"IsError":0,"msg":"Bạn đã đánh giá rồi"}';
								}
							 }
					  }
				}else
				  {
					  echo '{"IsError":2,"msg":"Bạn đăng nhập để đánh giá"}';
				  }
			break;
			case "load_more":
				$myprocess = new process_article();
				$totalRowCount = $myprocess->rowTotal($_POST['id'],$_POST['id_company']);
				$showLimit = 5;
				$resultJob = $myprocess->load_more($_POST['id'],$_POST['id_company'],$showLimit);
				$html ="";
				while($rowJob = $resultJob->fetch(PDO::FETCH_ASSOC))
				{
					$link = $core_class->_removesigns($rowJob["tencongviec"])."-".$rowJob["congviec_id"]."-cv.html";
 				    $postID = $rowJob["congviec_id"];
					$html .='<div class="cp_our_job_item show">
								<div class="row">
									<div class="col-xs-12 col-sm-10 cp_Job_summary_info">
										<h4>
											<a href="'.$link.'" target="_blank">'.$rowJob["tencongviec"].'</a>
										</h4>
										<ul>
										<li>
											<i class="fa fa-map-marker"></i>	
												'.$rowJob["diadiemlamviec"].'
											</li>	
										<li>
											<i class="fa fa-calendar-o"></i>
											'.$core_class->time_ago(strtotime($rowJob["ngaydang"])).'
										</li>
										</ul>
									</div>
									<div class="col-xs-12 col-sm-2 cp_job_view_detail">
										<a href="'.$link.'" target="_blank">
											Xem chi tiết
										</a>
									</div>
								</div>
							</div>';
				}
				 if($totalRowCount > $showLimit)
				 {
					 $html .='<div class="show_more_main" id="show_more_main'.$postID.'">
								<span id="'.$postID.'" class="show_more" title="Load more posts">Xem thêm</span>
								<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
							</div>';
				 }
				 echo $html;
			break;
			case "like_vote":
				//var_dump($_POST);
				if($_SESSION["career"]['career_id'] > 0 ) 
				{
						$myprocess = new process_article();
						 $result = $myprocess ->check_vote($_POST['id_company'],$_SESSION["career"]['career_id']);
						  if ($result == null || $result->rowCount() == 0)
							{
								$vote = array(
									'userid'		    => $_SESSION["career"]['career_id'],
									'IdCongty'			=> $_POST['id_company'],
									'type'			    => $_POST['value_vote'],
									'timestamp'			=> date("Y-m-d H:i:s"),
								);
								$insertVote = $core_class->insert("trn_like_unlike", $vote);
								if($insertVote)
								{
									$like = $core_class->find("trn_like_unlike", "count", array(
												'IdCongty' => $_POST['id_company'],
												'type'  => 1,
											));
									$unlike = $core_class->find("trn_like_unlike", "count", array(
												'IdCongty' => $_POST['id_company'],
												'type'  => 0,
											));
									if($_POST['value_vote'] == 1)
										{
											echo '{"IsError":1,"msg":"Bạn gửi đề xuất","like":"'.$like['COUNT(1)'].'","unlike":"'.$unlike['COUNT(1)'].'"}'; 
										}else
										{
											echo '{"IsError":1,"msg":"Bạn không đề xuất","unlike":"'.$unlike['COUNT(1)'].'","like":"'.$like['COUNT(1)'].'"}'; 
										}
										// echo '{"IsError":1,"msg":"Bạn gửi đề xuất"}'; 
								}else{
									echo '{"IsError":0,"msg":"Đề xuất lỗi"}';
								}
							}else
							{
									$voteUpdate = array(
											'type'			    => $_POST['value_vote'],
											'timestamp'			=> date("Y-m-d H:i:s"),
										);
										
										$Update_vte = $core_class->update("trn_like_unlike", $voteUpdate, array(
											'userid'	    => $_SESSION["career"]['career_id'],
											'IdCongty' => $_POST['id_company']
										));
										if($Update_vte)
											{
												$like = $core_class->find("trn_like_unlike", "count", array(
																	'IdCongty' => $_POST['id_company'],
																	'type'  => 1,
																));
												$unlike = $core_class->find("trn_like_unlike", "count", array(
																	'IdCongty' => $_POST['id_company'],
																	'type'  => 0,
																));
												if($_POST['value_vote'] == 1)
													{
														echo '{"IsError":1,"msg":"Bạn gửi đề xuất","like":"'.$like['COUNT(1)'].'","unlike":"'.$unlike['COUNT(1)'].'"}';
													}else
													{
														echo '{"IsError":1,"msg":"Bạn không đề xuất","like":"'.$like['COUNT(1)'].'","unlike":"'.$unlike['COUNT(1)'].'"}'; 
													}
											}else{
													echo '{"IsError":0,"msg":"Đề xuất lỗi"}';
												}
							}
						
				}else
				{
					echo '{"IsError":2,"msg":"Bạn đăng nhập để thao tác"}';
				}
			break;
			
			case "raitingOverView":
			  //var_dump($_POST);
			  if($_SESSION["career"]['career_id'] > 0 ) 
			  {
					 $myprocess = new process_article();
					 $result = $myprocess ->check_danhgia($_POST['id_company'],$_SESSION["career"]['career_id']);
					  if ($result == null || $result->rowCount() == 0)
					  {
						  $raitingOverView = array(
								'Id_congTy'		    => $_POST['id_company'],
								'Tongquan'			=> intval($_POST['value_rating']),
								'UseID'			    => $_SESSION["career"]['career_id'],
								'DateAdd'			=> date("Y-m-d H:i:s"),
							);
						$insertOverView = $core_class->insert("trn_raiting", $raitingOverView);
						if($insertOverView)
						{
								$count5 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									'Tongquan' => 5,
								));
								$count4 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									'Tongquan' => 4,
								));
								$count3= $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									'Tongquan' => 3,
								));
								$count2 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									'Tongquan' => 2,
								));
								$count1 = $core_class->find("trn_raiting", "count", array(
									'Id_congTy' => $_POST['id_company'],
									'Tongquan' => 1,
								));
								$ratings = array(
									5 => intval($count5['COUNT(1)']),
									4 => intval($count4['COUNT(1)']),
									3 => intval($count3['COUNT(1)']),
									2 => intval($count2['COUNT(1)']),
									1 => intval($count1['COUNT(1)'])
								);
								
								$totalRaiting = $myprocess->calcAverageRating($ratings);
								
								echo '{"IsError":1,"msg":"Bạn vừa đánh giá","Tongquan":"'.intval($_POST['value_rating']).'","tongtrungbinh":"'.round($totalRaiting, 2).'"}';
							}else{
								echo '{"IsError":0,"msg":"Đánh giá lỗi"}';
							}
					  }else
					  {
						  if($row = $result->fetch())
							 {
								if($row['Tongquan']== 0)
								{
									
									 $raitingOverView = array(
										'Tongquan'			=> intval($_POST['value_rating']),
										'DateAdd'			=> date("Y-m-d H:i:s"),
										);
									$OverViewUpdate = $core_class->update("trn_raiting", $raitingOverView, array(
										'Id_congTy' => $_POST['id_company'],
										'UseID'	    => $_SESSION["career"]['career_id']
									));
									if($OverViewUpdate)
									{
											$count5 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												'Tongquan' => 5,
											));
											$count4 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												'Tongquan' => 4,
											));
											$count3= $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												'Tongquan' => 3,
											));
											$count2 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												'Tongquan' => 2,
											));
											$count1 = $core_class->find("trn_raiting", "count", array(
												'Id_congTy' => $_POST['id_company'],
												'Tongquan' => 1,
											));
											$ratings = array(
												5 => intval($count5['COUNT(1)']),
												4 => intval($count4['COUNT(1)']),
												3 => intval($count3['COUNT(1)']),
												2 => intval($count2['COUNT(1)']),
												1 => intval($count1['COUNT(1)'])
											);
											$totalRaiting = $myprocess->calcAverageRating($ratings);
											echo '{"IsError":1,"msg":"Bạn vừa đánh giá","Tongquan":"'.intval($_POST['value_rating']).'","tongtrungbinh":"'.round($totalRaiting, 2).'"}';
									}else{
											echo '{"IsError":0,"msg":"Đánh giá lỗi"}';
										}
								}else
								{
									echo '{"IsError":0,"msg":"Bạn đã đánh giá rồi"}';
								}
							 }
					  }
					
					//print_r($tongquan['COUNT(1)']);
					
			  }else
			  {
				  echo '{"IsError":2,"msg":"Bạn đăng nhập để đánh giá"}';
			  }
			break;
			case "followRemove":
				if($_POST['id_company'] > 0)
				{
						$FollowID = $core_class->findValues("trn_congty", "follow", array("congty_id" => $_POST['id_company']));
						$checkFL = explode(",",$FollowID);
						$to_remove = array($_SESSION["career"]['career_id']);
						$ReturnArray = array_diff($checkFL, $to_remove);
						//print_r($ReturnFL);
						$totalFL = explode(",",$ReturnArray);
						for($j=0; $j < count($ReturnArray ); $j++)
						{
							$ReturnFL .= $ReturnArray[$j].",";
						}
						$arrayInput = array(
							'follow' => substr($ReturnFL,0,-1),
						);
						
						$flagUpdate = $core_class->update("trn_congty", $arrayInput, array(
						'congty_id' => $_POST['id_company']
						));
						if($flagUpdate)
						{
							echo '{"IsError":1,"lbname":"Follow","msg":"Bạn vừa bỏ theo dõi","totalFL":"'.count(array_filter($totalFL)).'"}';
						}else
						{
							echo '{"IsError":0,"msg":"Xử lý bị lỗi"}';
						}
				}
			break;
		}
    }
?>
