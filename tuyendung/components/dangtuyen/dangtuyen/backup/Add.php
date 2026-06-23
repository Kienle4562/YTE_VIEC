<?php defined( '_VALID_MOS' ) or die( include("404.php") );?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<!--Begin::Main Portlet-->
		<div class="m-portlet m-portlet--full-height">
			<!--begin: Portlet Head-->
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Đăng Tuyển Dụng
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Đăng tin tuyển dụng của bạn">
								<i class="flaticon-info m--icon-font-size-lg3"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--end: Portlet Head-->
			<!--begin: Form Wizard-->
			<div class="m-wizard m-wizard--2 m-wizard--success" id="m_wizard">
				<!--begin: Message container -->
				<div class="m-portlet__padding-x">
					<!-- Here you can put a message or alert -->
				</div>
				<!--end: Message container -->
				<!--begin: Form Wizard Head -->
				<div class="m-wizard__head m-portlet__padding-x">
					<!--begin: Form Wizard Progress -->
					<div class="m-wizard__progress">
						<div class="progress">
							<div class="progress-bar" role="progressbar"  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<!--end: Form Wizard Progress -->  
					<!--begin: Form Wizard Nav -->
					<div class="m-wizard__nav">
						<div class="m-wizard__steps">
							<div class="m-wizard__step m-wizard__step--current"  data-wizard-target="#m_wizard_form_step_1">
								<a href="#"  class="m-wizard__step-number">
									<span>
										<i class="fa flaticon-imac"></i>
									</span>
								</a>
								<div class="m-wizard__step-info">
									<div class="m-wizard__step-title">
										Thông tin tuyển dụng
									</div>
								</div>
							</div>
							<div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_2">
								<a href="#" class="m-wizard__step-number">
									<span>
										<i class="fa flaticon-chat-1"></i>
									</span>
								</a>
								<div class="m-wizard__step-info">
									<div class="m-wizard__step-title">
										Thông tin liên hệ
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end: Form Wizard Nav -->
				</div>
				<!--end: Form Wizard Head -->  
				<!--begin: Form Wizard Form-->
				<div class="m-wizard__form">
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form">
						<!--begin: Form Body -->
						<div class="m-portlet__body">
							<!--begin: Form Wizard Step 1-->
							<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
								<div class="row">
									<div class="col-xl-8 offset-xl-2">
										<div class="m-form__section m-form__section--first">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Thông tin tuyển dụng
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Chức danh tuyển dụng:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input required type="text" name="tencongviec" class="form-control m-input" placeholder="VD: Bác Sỹ Nội Trú">
													<span class="m-form__help">
														<b>Lưu ý :</b>
														<div>- Bạn nên đặt tên vị trí/chức danh phổ biến, đơn giản như “Trưởng phòng”, “Nhân viên”.</div>
														<div>- Đây là yếu tố quan trọng thu hút các ứng viên ứng tuyển và chúng tôi gợi ý các hồ sơ phù hợp.</div>
													</span>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Mô tả công việc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea required data-provide="markdown" class="form-control m-input" name="motacongviec"></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Yêu cầu công việc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea required data-provide="markdown" class="form-control m-input" name="chuyenmonyeucau"></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Yêu cầu hồ sơ:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="yeucauhoso"></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Nơi làm việc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("tinhthanh_id", "required");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Mức lương:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input required type="text" name="mucluong" class="form-control m-input" placeholder="VD: Từ 8 triệu đến 20 triệu">
												</div>
											</div>
											<div class="form-group m-form__group">
												<div class="alert m-alert m-alert--default" role="alert">
													<code>Lưu ý:</code>
													<div>- 72% ứng viên chia sẻ rằng thông tin lương ảnh hưởng đến quyết định ứng tuyển của họ. </div>
													<div>- Bạn có thể quyết định “hiển thị thông tin lương” để thu hút thêm nhiều hồ sơ ứng tuyển vào vị trí tuyển dụng.</div>
													<div class="red">- Bạn nên nhập cả hai mức lương tối thiểu và tối đa cho vị trí cần đăng tuyển.</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Hình thức:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createCheckBox("loaihinhcongviec_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Hạn nhận hồ sơ:
												</label>
												<div class="col-xl-5 col-lg-5">
													<div class="input-group date">
														<input type="text" readonly id="ngayhethan" name="ngayhethan" class="form-control m-input datepicker">
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-calendar-check-o"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
										<div class="m-form__section">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Phúc lợi
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-xl-12 col-lg-12">
													<?php
														echo $core_class->createCheckBox("phucloi_id", "content");
													?>
												</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
										<div class="m-form__section">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Yêu cầu chung
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Giới tính:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createRadioBox("gioitinh_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Tuổi:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input type="text" name="dotuoi" placeholder="VD: tuổi từ 19 đến 35" class="form-control m-input">
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span> Kinh nghiệm:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("kinhnghiem_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span> Cấp bậc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("capbac_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Bằng cấp:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("bangcap_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Yêu cầu hồ sơ:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createCheckBox("yeucauhoso_id");
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--end: Form Wizard Step 1-->
							<!--begin: Form Wizard Step 2-->
							<div class="m-wizard__form-step" id="m_wizard_form_step_2">
								<div class="row">
									<div class="col-xl-8 offset-xl-2">
										<div class="m-form__section m-form__section--first">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Thông tin liên hệ
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-lg-6">
													<label class="form-control-label">
														Tên công ty:
													</label>
													<?php echo $_SESSION["session"]["tencongty"] ?>
												</div>
												<div class="col-lg-6 m-form__group-sub">
													<label class="form-control-label">
														Email:
													</label>
													<?php echo $_SESSION["session"]["Tendangnhap"] ?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-lg-6 m-form__group-sub">
													<label class="form-control-label">
														Địa chỉ:
													</label>
													<?php echo $_SESSION["session"]["diachicongty"] ?>
												</div>
												<div class="col-lg-6 m-form__group-sub">
													<label class="form-control-label">
														Người liên hệ:
													</label>
													<?php echo $_SESSION["session"]["nguoilienhe"] ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--end: Form Wizard Step 2--> 
						</div>
						<!--end: Form Body -->
	<!--begin: Form Actions -->
						<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-4 m--align-left">
										<a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
											<span>
												<i class="la la-arrow-left"></i>
												&nbsp;&nbsp;
												<span>
													Back
												</span>
											</span>
										</a>
									</div>
									<div class="col-lg-4 m--align-right">
										<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="submit">
											<span>
												<i class="la la-check"></i>
												&nbsp;&nbsp;
												<span>
													Submit
												</span>
											</span>
										</a>
										<a href="#" class="btn btn-warning m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
											<span>
												<span>
													Tiếp tục
												</span>
												&nbsp;&nbsp;
												<i class="la la-arrow-right"></i>
											</span>
										</a>
									</div>
									<div class="col-lg-2"></div>
								</div>
							</div>
						</div>
						<!--end: Form Actions -->
					</form>
				</div>
				<!--end: Form Wizard Form-->
			</div>
			<!--end: Form Wizard-->
		</div>
		<!--End::Main Portlet-->
	</div>
</div>
<script src="dist/assets/web/custom/components/forms/wizard/wizard.js" type="text/javascript"></script>
<script>
	//== Class definition
var Typeahead = function() {

    var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
            'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
            'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
            'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
            'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
            'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
            'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
            'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
        ];

    //== Private functions
    var demo1 = function() {
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

        $('#m_typeahead_1, #m_typeahead_1_modal, #m_typeahead_1_validate, #m_typeahead_2_validate, #m_typeahead_3_validate').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'states',
            source: substringMatcher(states)
        });
    }

    var demo2 = function() {
        // constructs the suggestion engine
        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // `states` is an array of state names defined in "The Basics"
            local: states
        });

        $('#m_typeahead_2, #m_typeahead_2_modal').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: bloodhound
        }); 
    }

    var demo3 = function() {
        var countries = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // url points to a json file that contains an array of country names, see
            // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
            prefetch: 'https://keenthemes.com/metronic/preview/inc/api/typeahead/countries.json'
        });

        // passing in `null` for the `options` arguments will result in the default
        // options being used
        $('#m_typeahead_3, #m_typeahead_3_modal').typeahead(null, {
            name: 'countries',
            source: countries
        });
    }

    var demo4 = function() {
        var bestPictures = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: 'inc/api/typeahead/movies.json'
        });

        $('#m_typeahead_4').typeahead(null, {
            name: 'best-pictures',
            display: 'value',
            source: bestPictures,
            templates: {
                empty: [
                    '<div class="empty-message" style="padding: 10px 15px; text-align: center;">',
                        'unable to find any Best Picture winners that match the current query',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<div><strong>{{value}}</strong> – {{year}}</div>')
            }
        });
    }

    var demo5 = function() {
        var nbaTeams = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: 'inc/api/typeahead/nba.json'
        });

        var nhlTeams = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: 'inc/api/typeahead/nhl.json'
        });

        $('#m_typeahead_5').typeahead({
                highlight: true
            },{
                name: 'nba-teams',
                display: 'team',
                source: nbaTeams,
                templates: {
                    header: '<h3 class="league-name" style="padding: 5px 15px; font-size: 1.2rem; margin:0;">NBA Teams</h3>'
                }
            },{
                name: 'nhl-teams',
                display: 'team',
                source: nhlTeams,
                templates: {
                    header: '<h3 class="league-name" style="padding: 5px 15px; font-size: 1.2rem; margin:0;">NHL Teams</h3>'
                }
            }
        );
    }

    return {
        // public functions
        init: function() {
            demo1();
            demo2();
            demo3();
            demo4();
            demo5();
        }
    };
}();

jQuery(document).ready(function() {
    Typeahead.init();
});
</script>