<style>
@font-face {
	font-family: robotocondensed;
	src: url(assets/fonts/RobotoCondensed-Light.ttf);
	font-weight: 400
}

@font-face {
	font-family: robotocondensed;
	src: url(assets/fonts/RobotoCondensed-Bold.ttf);
	font-weight: 700
}

.cvo-document .cvo-page {
	padding: 0;
	background-image: url(https://www.topcv.vn/packages/cvo/templates/onepage_impressive_2/assets/images/bg_default.png);
	background-size: 100% 100%;
	background-repeat: no-repeat;
	position: relative
}

.cvo-document .cvo-subpage {
	padding: 0;
	padding-bottom: 1cm
}

#cvo-body {
	margin: 0 auto;
	width: 100%;
	position: relative;
	font-family: robotocondensed, Arial, sans-serif;
	font-size: 14px;
	line-height: 18px
}

#cvo-main {}

#col-right {
	width: 70%;
	float: right;
	color: #444;
	min-height: 560px;
	padding-top: 1px
}

#col-left {
	width: 30%;
	color: #fff;
	min-height: 560px;
	float: left
}

#col-left .cvo-block {
	width: 100%;
	padding: 5px 12px
}

#cvo-profile-avatar-wraper {
	padding: 10px 0;
	text-align: center
}

#col-left .cvo-block-title {
	margin: 0 0 10px;
	font-size: 16px;
	line-height: 32px;
	text-transform: uppercase;
	font-weight: 700
}

#col-left .cvo-block-title span {
	display: inline-block;
	padding-right: 5px;
	width: 100%;
	vertical-align: middle
}

@supports(overflow:-webkit-marquee) and (justify-content:inherit) {
	#col-left .cvo-block-title span {
		font-weight: 400
	}
}

#col-left #cvo-profile {
	width: 100%;
	padding: 0;
	margin-top: 0
}

#profile-title-wrapper {
	text-align: center;
	padding: 10px 3px;
	background-color: #263238
}

#cvbuilder-container #cvo-profile:hover #profile-title-wrapper {
	box-shadow: 0 2px 0 2px #ccc inset
}

#profile-title-wrapper [contenteditable=true]:empty:before {
	content: attr(cvo-placeholder);
	color: #bbb;
	font-weight: 100
}

#profile-title-wrapper .cvoInvalidate {
	color: orange
}

#cvo-profile-fullname {
	margin-top: 5px;
	font-size: 22px;
	font-weight: 700;
	width: 100%;
	line-height: 34px;
	display: inline-block;
	text-transform: uppercase
}

#cvo-profile-title {
	width: 100%;
	font-size: 14px;
	font-style: italic
}

#cvo-profile-avatar {
	width: 170px;
	height: 170px;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%
}

#cvo-profile-website {
	width: 170px;
	word-break: break-all
}

#profile-contact-wraper {
	width: 90%;
	margin: 10px auto;
	padding-top: 10px
}

#profile-contact-wraper div {
	padding: 5px 0
}

#profile-contact-wraper i.fa {
	width: 19px;
	height: 19px;
	background-color: #7c7a79;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	display: inline-block;
	text-align: center;
	font-size: 12px;
	line-height: 20px
}

#profile-contact-wraper span {
	padding-left: 3px;
	width: 188px;
	color: #fff;
	vertical-align: top;
	display: inline-block
}

#profile-contact-wraper span#cvo-profile-email {
	word-break: break-all
}

#cvo-objective-objective {
	width: 100%
}

#cvo-skillrate {
	padding-left: 0;
	padding-right: 0
}

#cvo-skillrate {
	padding-left: 0
}

#skillrate-table .row {
	margin-bottom: 10px;
	color: #fff
}

.cvo-skillrate-title {
	width: 100%;
	display: inline-block
}

.cvo-skillrate-bar {
	margin-top: 3px;
	background-color: #fff;
	display: block;
	width: 100%;
	height: 8px;
	text-align: left;
	padding: 0
}

.cvo-skillrate-value {
	display: block;
	height: 8px;
	background-color: #263238
}

.cvo-skillrate-bar[bval="1"] .cvo-skillrate-value {
	width: 20%
}

.cvo-skillrate-bar[bval="2"] .cvo-skillrate-value {
	width: 40%
}

.cvo-skillrate-bar[bval="3"] .cvo-skillrate-value {
	width: 60%
}

.cvo-skillrate-bar[bval="4"] .cvo-skillrate-value {
	width: 80%
}

.cvo-skillrate-bar[bval="5"] .cvo-skillrate-value {
	width: 100%
}

#cvo-interest {
	padding-left: 0;
	padding-right: 0
}

#interest-table {
	padding-left: 20px
}

#interest-table .row {
	margin-bottom: 15px;
	color: #fff
}

#interest-table li {
	width: 100%;
	list-style-type: circle
}

.cvo-interest-details {
	width: 100%;
	vertical-align: top
}

#col-right {
	padding: 20px 5px 0
}

#col-right .cvo-block {
	width: 100%;
	padding: 3px 15px
}

#col-right .cvo-block-title {
	margin: 0 0 10px;
	font-size: 20px;
	line-height: 32px;
	text-transform: uppercase;
	font-weight: 700
}

#col-right .cvo-block-title span:nth-child(2) {
	width: 440px;
	vertical-align: middle
}

#col-right .cvo-block-title.no-horizontal-line {
	background-image: none
}

#col-right .cvo-block-title i.fa {
	background-color: #263238;
	color: #fff;
	border-radius: 50%;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	text-align: center;
	width: 40px;
	height: 40px;
	vertical-align: middle;
	padding-top: 10px;
	margin-right: 5px
}

#col-right .cvo-block-title span {
	color: #263238;
	display: inline-block;
	padding-right: 5px
}

#col-right .row {
	margin: 15px 0
}

.row-title {
	margin-bottom: 5px;
	width: 100%
}

.row-details {
	margin-top: 8px
}

.row-details [cvo-form-field] {
	width: 100%
}

.cvo-education-school-wraper {
	width: 90%;
	padding-right: 5px;
	text-transform: uppercase;
	text-align: left;
	font-weight: 700;
	color: #414142;
	float: left
}

.cvo-education-school {
	width: 100%
}

.cvo-education-time {
	width: 27%;
	font-size: .9em;
	font-weight: 700;
	text-align: right;
	float: right;
	text-transform: uppercase
}

.cvo-education-time .default_min_width {
	min-width: 15pt
}

.cvo-education-title {
	color: #414142;
	width: 100%
}

.cvo-experience-company-wraper {
	width: 73%;
	padding-right: 5px;
	text-transform: uppercase;
	text-align: left;
	font-weight: 700;
	color: #414142;
	float: left
}

.cvo-experience-company {
	width: 100%
}

.cvo-experience-time {
	width: 27%;
	font-size: .9em;
	font-weight: 700;
	text-align: right;
	float: right;
	text-transform: uppercase
}

.cvo-experience-time .default_min_width {
	min-width: 15pt
}

.cvo-experience-position {
	color: #414142;
	width: 100%
}

.cvo-activity-organization-wraper {
	width: 73%;
	padding-right: 5px;
	text-transform: uppercase;
	text-align: left;
	font-weight: 700;
	color: #414142;
	float: left
}

.cvo-activity-organization {
	width: 100%
}

.cvo-activity-time {
	width: 27%;
	font-size: .9em;
	font-weight: 700;
	text-align: right;
	float: right;
	text-transform: uppercase
}

.cvo-activity-time .default_min_width {
	min-width: 15pt
}

.cvo-activity-position {
	color: #414142;
	width: 100%
}

.cvo-award-title-wraper,
.cvo-certification-title-wraper {
	width: 75%;
	padding-right: 5px;
	text-align: left;
	color: #414142;
	float: left
}

.cvo-award-title,
.cvo-certification-title {
	width: 100%
}

.cvo-award-time-wraper,
.cvo-certification-time-wraper {
	width: 25%;
	font-size: .9em;
	font-weight: 700;
	text-align: right;
	float: right;
	text-transform: uppercase
}

.cvo-award-time-wraper .default_min_width,
.cvo-certification-time-wraper .default_min_width {
	min-width: 15pt
}
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.cvo-activity-position {
	color: #414142;
	width: 100%
}

.row-col-left {
	width: 30%;
	float: left
}

.row-col-left span {
	width: 100%;
	font-weight: 700
}

.row-col-right {
	padding-left: 10px;
	width: 70%;
	float: left
}

.row-col-right span {
	width: 100%
}

#reference-table .row {
	float: left;
	width: 50%
}

#reference-table .row:nth-child(odd) {
	padding-right: 10px
}

#reference-table .row:nth-child(even) {
	padding-left: 10px
}

#reference-table .row:only-child {
	width: 100%;
	padding-left: 0;
	padding-right: 0
}

#reference-table .cvo-reference-content {
	width: 100%
}

#cvo-additional-info #cvo-additional-information-details {
	width: 100%;
	display: inline-block
}

@media print {
	body {
		background-image: url(https://www.topcv.vn/packages/cvo/templates/onepage_impressive_2/assets/images/bg_default.png);
		background-size: 100% 100%;
		background-repeat: no-repeat
	}
	.cvo-document .cvo-page {
		background-image: none
	}
	#col-left .cvo-block:last-child {
		padding-bottom: 0
	}
	#col-right .cvo-block:last-child {
		padding-bottom: 0
	}
}

.hidden-time .cvo-education-school-wraper,
.hidden-time .cvo-activity-organization-wraper,
.hidden-time .cvo-experience-company-wraper,
.hidden-time .cvo-award-title-wraper,
.hidden-time .cvo-cerrtification-title-wraper {
	width: 100%
}

#cv-watermark {
	position: absolute;
	right: 20px;
	bottom: 10px;
	font-size: 12px;
	color: #555
}

@media print {
	.cvo-document .cvo-page {
		position: initial
	}
}
</style>