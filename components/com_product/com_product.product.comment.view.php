<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include_once('com_product.product.comment.models.php'); ?>
    
    <?php
        if (!empty($_SESSION['comment_success_message'])) {
            ?><div class="success_message"><?php echo $_SESSION['comment_success_message']; ?></div><?php
            unset($_SESSION['comment_success_message']);
        }
        
        if (!empty($_POST['error_message'])) {
            ?><div class="error_message"><?php echo $_POST['error_message']; ?></div><?php
        }
    ?>
    
    <div class="comment_form comment_form_main">
        <form name="product_comment_0" method="post">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>Họ tên:</td>
                    <td>
                        <input type="text" name="name" maxlength="50" />
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" maxlength="50" />
                    </td>
                </tr>
                <tr>
                    <td>Nội dung:</td>
                    <td>
                        <textarea name="content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Mã xác nhận:</td>
                    <td>
                        <img id="form_register_captcha_0" style="border: solid 1px #ddd;" src="captcha?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" height="75px" />
                        <br />
                        <a tabindex="-1" style="border-style: none;" href="#" title="[Tôi không đọc được, hãy đổi hình khác]" onclick="cpcChangeCaptcha(0); this.blur(); return false" class="change_captcha">
                            [Tôi không đọc được, hãy đổi hình khác]
                        </a>
                        <div class="input_container">
                            <input type="text" name="captcha" onfocus="cpcChangeCaptcha(0)" onblur="" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input name="submit" type="submit" value="Gửi bình luận" />
                        <input type="hidden" name="hidden" value="post_comment" />
                        <input type="hidden" name="comment_id" value="0" />
                    </td>
                </tr>
            </table>
        </form>
        
        <script type="text/javascript">
            jQuery('form[name=product_comment_0]').validate({
                rules: {
                    name: "required",
                    email: "required",
                    content: "required",
                    captcha: "required"
                },
                messages: {
                    name: "Xin vui lòng nhập vào họ tên của bạn",
                    email: "Xin vui lòng nhập vào email",
                    content: "Xin vui lòng nhập vào nội dung bình luận",
                    captcha: "Xin vui lòng nhập vào mã xác nhận"
                }
            });
        </script>
    </div>
    
    <?php

    $myprocess = new com_product_comment();
    $comments = $myprocess->get_comments($_GET['id'], 0);
    
    if ($comments->rowCount() > 0)
    {
        ?>
        <div class="comment_list">
            <ul>
                <?php
                    while ($row = $comments->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <li>
                            <div class="comment_item">
                                <div class="image">
                                    <img src="images/noavatar.gif" />
                                </div>
                                <div class="title">
                                    <span class="name"><?php echo $row['name']; ?></span>
                                    <span class="time">gửi vào lúc <?php echo date('H:i:s d-m-Y', $row['time']); ?></span>
                                </div>
                                <div class="content"><?php echo $row['content']; ?></div>
                                <div class="clear"></div>
                            </div>

                            <div class="clear"></div>
                            
                            <ul>
                                <?php
                                    $sub_comments = $myprocess->get_comments($_GET['id'], $row['id']);
                                    
                                    while ($sub_comment = $sub_comments->fetch(PDO::FETCH_ASSOC))
                                    {
                                        ?>
                                        <li>
                                            <div class="comment_item">
                                                <div class="image">
                                                    <img src="images/noavatar.gif" />
                                                </div>
                                                <div class="title">
                                                    <span class="name"><?php echo $sub_comment['name']; ?></span>
                                                    <span class="time">gửi vào lúc <?php echo date('H:i:s d-m-Y', $sub_comment['time']); ?></span>
                                                </div>
                                                <div class="content"><?php echo $sub_comment['content']; ?></div>
                                                <div class="clear"></div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                ?>
                                <li id="comment_<?php echo $row['id']; ?>">
                                    <div class="placeholder">
                                        <a class="show_comment" href="javascript:void(0)" onclick="cpcShowComment(<?php echo $row['id']; ?>)">
                                            Bình luận
                                        </a>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
    
    <script type="text/javascript">
        
        var lastCaptchaObj = 0;
        
        function cpcChangeCaptcha(obj)
        {
            if (obj != lastCaptchaObj) {
                jQuery('input[name=captcha]').val("");
                document.getElementById('form_register_captcha_' + obj).src = 'captcha?sid=' + Math.random();
                lastCaptchaObj = obj;
            }
        }
    
        function cpcShowComment(obj)
        {
            jQuery('#comment_' + obj + ' .placeholder').html('\
                <div class="comment_form">\
                    <form name="product_comment_' + obj + '" method="post">\
                        <table border="0" cellpadding="0" cellspacing="0">\
                            <tr>\
                                <td>Họ tên:</td>\
                                <td>\
                                    <input type="text" name="name" maxlength="50" />\
                                </td>\
                            </tr>\
                            <tr>\
                                <td>Email:</td>\
                                <td>\
                                    <input type="text" name="email" maxlength="50" />\
                                </td>\
                            </tr>\
                            <tr>\
                                <td>Nội dung:</td>\
                                <td>\
                                    <textarea name="content"></textarea>\
                                </td>\
                            </tr>\
                            <tr>\
                                <td>Mã xác nhận:</td>\
                                <td>\
                                    <img id="form_register_captcha_' + obj + '" style="border: solid 1px #ddd;" src="captcha?sid=' + Math.random() + '" alt="CAPTCHA Image" height="75px" />\
                                    <br />\
                                    <a tabindex="-1" style="border-style: none;" href="#" title="[Tôi không đọc được, hãy đổi hình khác]" onclick="cpcChangeCaptcha(' + obj + '); this.blur(); return false" class="change_captcha">\
                                        [Tôi không đọc được, hãy đổi hình khác]\
                                    </a>\
                                    <div class="input_container">\
                                        <input type="text" name="captcha" onfocus="cpcChangeCaptcha(' + obj + ')" onblur="" />\
                                    </div>\
                                </td>\
                            </tr>\
                            <tr>\
                                <td></td>\
                                <td>\
                                    <input name="submit" type="submit" value="Gửi bình luận" />\
                                    <input type="hidden" name="hidden" value="post_comment" />\
                                    <input type="hidden" name="comment_id" value="' + obj + '" />\
                                </td>\
                            </tr>\
                        </table>\
                    </form>\
                </div>\
            ');
            
            jQuery('form[name=product_comment_' + obj + ']').validate({
                rules: {
                    name: "required",
                    email: "required",
                    content: "required",
                    captcha: "required"
                },
                messages: {
                    name: "Xin vui lòng nhập vào họ tên của bạn",
                    email: "Xin vui lòng nhập vào email",
                    content: "Xin vui lòng nhập vào nội dung bình luận",
                    captcha: "Xin vui lòng nhập vào mã xác nhận"
                }
            });
        }
    </script>