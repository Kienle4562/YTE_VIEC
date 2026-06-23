<tr>

											<td class="v_align_m">

												Màu sắc: 

											</td>

											<td class="color_dark">

												<div class="custom_select type_2 fe_width_3">

                                                <?php $color_product = explode(',', $row['color_product']); ?>

													<div class="select_title r_corners fs_medium fw_normal color_grey"><?php echo $color_product[0] ?></div>

													<ul class="select_list r_corners wrapper shadow_1 bg_light tr_all"></ul>

													<select class="d_none" name="product_color">

                                                    <?php 

													

														

													foreach ($color_product as $src) { 

													 ?>

                                                    

														<option value="<?php echo $src ?>"><?php echo $src ?></option>

                                                        <?php } ?>

														

													</select>

												</div>

											</td>

										</tr>
                                        
										<tr>

											<td class="v_align_m">

												Size: 

											</td>

											<td class="color_dark">

												<div class="custom_select type_2 fe_width_3">

                                                <?php $size_array = explode(',', $row['size_product']); ?>

													<div class="select_title r_corners fs_medium fw_normal color_black fw_ex_bold"><?php echo $size_array[0] ?></div>

													<ul class="select_list r_corners wrapper shadow_1 bg_light tr_all color_black fw_ex_bold"></ul>

													<select class="d_none" name="product_size">

                                                    <?php 

													

														

													foreach ($size_array as $src) { 

													 ?>

                                                    

														<option value="<?php echo $src ?>"><?php echo $src ?></option>

                                                        <?php } ?>

														

													</select>

												</div>

											</td>

										</tr>

                                        