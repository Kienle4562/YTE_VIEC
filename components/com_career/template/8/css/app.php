<style>
@charset "utf-8";
/* # reset 
---------------------------------------------------------------------------- */
* {
    box-sizing: inherit !important;
}
html {
}

body, h1, h2, h3, h4, h5, h6, p, ul, ol, dl, dt, dd, li, table, th, td, form, address, pre, caption, cite, code, dfn, var {
    font-size: 100%;
    font-style: normal;
    margin: 0;
    padding: 0;
    text-decoration: none;
}

img {
    border: 0;
    vertical-align: bottom;
}

table {
    border-collapse: collapse;
    border-spacing: 0;
}

caption, th {
    text-align: left;
}

ol, ul {
    list-style: none;
}

body {
    background: #fff;
    color: #626161;
    font-size: 14px;
    font-family: Arial, Helvetica, sans-serif;
    line-height: normal;
    font-weight: 400;
}
.clearfix {
    zoom: 1;
}

    .clearfix:after {
        clear: both;
        content: ".";
        display: block;
        height: 0;
        line-height: 0;
        visibility: hidden;
    }

    .page{

        position: relative;
    }
    .page:after {
        clear: both;
        content: ".";
        display: block;
        height: 0;
        line-height: 0;
        visibility: hidden;
    }

/* # style
---------------------------------------------------------------------------- */
.content_left_right
{
	display:block !important;
	width:790px;
}
.cv_wrap {
    margin: 0 auto;
    width: 100%;
    background: #fff;
}
.cv_wrap .cv_info .avatar {
        padding-top: 20px;
    }
.col_right {
    float: right;
    width: 510px;
    background: #fff;
    color: #626161;
}

.col_left {
    float: left;
	 width: 250px;
    padding: 0 12px 7px 13px;
    color: #626161;
}
.avatarL {
    float: left;
    width: 250px;
}

.avatarImg {
    width: 123px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto;
}

    .avatarImg img {
        width: 100%;
    }
	

.name {
    float: left;
    width: 450px;
    color: #c3c9cf;
    padding: 0 0 0 60px;
    font-weight: 700;
    font-size: 20px;
}

    .name h2 {
        font-size: 30px;
        font-weight: 700;
        padding-top: 20px;
        padding-bottom: 2px;
        color: #1fbc89;
    }

.info {
    border-bottom: 1px solid #1fbc89;
    padding-bottom: 0px;
}

 .info li {
        color: #626161;
        padding: 0;
    }

        .info li p {
            padding-top: 3px;
            overflow: hidden;
        }

            .info li p img {
                float: left;
                width: 17px;
                margin-right: 4px;
            }

            .info li p span {
                float: left;
                width: 165px;
                font-size: 12px;
                line-height: 17px;
            }

.line {
    clear: both;
    border-bottom: 1px solid #1fbc89;
}

.ml_ttl {
    color: #1fbc89;
    font-size: 15px;
    font-weight: 700;
    margin-top: 15px;
}

.right_block {
    border-bottom: 1px solid #1fbc89;
    padding-bottom: 11px;
}

.cc_lst li {
    padding-top: 5px;
}

    .cc_lst li p {
        margin-top: 8px;
    }

.block {
    border-left: 2px solid #1fbc89;
    padding-bottom: 15px;
    padding-left: 39px;
}

.blockR {
    padding: 0;
}

.ico1, .ico2, .ico3, .ico4, .ico5, .ico6 {
    border: none;
    width: 17px;
    height: 17px;
    display: inline-block
}

.ico7, .ico8, .ico9, .ico10, .ico11, .ico12, .ico13, .ico14, .ico15 {
    border: none;
    width: 43px;
    height: 43px;
    display: inline-block
}


   .blockR h2 {
        color: #fff;
        font-size: 14px;
        padding: 0;
        text-transform: uppercase;
        margin-bottom: 5px;
        position: relative;
        border-bottom: 1px solid #1fbc89;
    }

        .blockR h2 img.imgDot {
            position: absolute;
            left: -60px;
            top: -8px;
        }

        .blockR h2 span {
            background: #1fbc89;
            font-weight: 700;
            display: inline-block;
            padding: 5px 10px;
        }
		
.ico1 {
    content: url(../images/ico1.png);
    background: url(../images/ico1.png) no-repeat;
}

.ico2 {
    content: url(../images/ico2.png);
    background: url(../images/ico2.png) no-repeat;
}

.ico3 {
    content: url(../images/ico3.png);
    background: url(../images/ico3.png) no-repeat;
}

.ico4 {
    content: url(../images/ico4.png);
    background: url(../images/ico4.png) no-repeat;
}

.ico5 {
    content: url(../images/ico5.png);
    background: url(../images/ico5.png) no-repeat;
}

.ico6 {
    content: url(../images/ico6.png);
    background: url(../images/ico6.png) no-repeat;
}

.ico7 {
    content: url(../images/ico7.png);
    background: url(../images/ico7.png) no-repeat;
}

.ico8 {
    content: url(../images/ico8.png);
    background: url(../images/ico8.png) no-repeat;
}

.ico9 {
    content: url(../images/ico9.png);
    background: url(../images/ico9.png) no-repeat;
}

.ico10 {
    content: url(../images/ico10.png);
    background: url(../images/ico10.png) no-repeat;
}

.ico11 {
    content: url(../images/ico11.png);
    background: url(../images/ico11.png) no-repeat;
}

.ico12 {
    content: url(../images/ico12.png);
    background: url(../images/ico12.png) no-repeat;
}

.ico13 {
    content: url(../images/ico13.png);
    background: url(../images/ico13.png) no-repeat;
}

.ico14 {
    content: url(../images/ico14.png);
    background: url(../images/ico14.png) no-repeat;
}

.ico15 {
    content: url(../images/ico15.png);
    background: url(../images/ico15.png) no-repeat;
}

    .cvo-skillrate-value[value="1"] {
        content: url(../images/1.png);
        background: url(../images/1.png) no-repeat;
    }

    .cvo-skillrate-value[value="2"] {
        content: url(../images/2.png);
        background: url(../images/2.png) no-repeat;
    }

    .cvo-skillrate-value[value="3"] {
        content: url(../images/3.png);
        background: url(../images/3.png) no-repeat;
    }

    .cvo-skillrate-value[value="4"] {
        content: url(../images/4.png);
        background: url(../images/4.png) no-repeat;
    }

    .cvo-skillrate-value[value="5"] {
        content: url(../images/5.png);
        background: url(../images/5.png) no-repeat;
    }



</style>