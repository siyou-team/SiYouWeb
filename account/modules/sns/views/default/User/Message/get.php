
<section class="mailbox-env" style="width: 600px;">
    <div class="mail-single">

        <!-- Email Title and Button Options -->
        <div class="mail-single-header">
            <div>
                <img src="assets/images/user-4.png" class="img-circle" width="38" />
                <span id="mail-other"><?=$data['user_other_nickname']?></span><span><?=$data['user_other_id']?></span>
                    <input type="hidden" value="<?=$data['message_id']?>" id="mail_message_id">
                <em class="time"><?=$data['message_time']?></em>

                <div class="mail-single-header-options">


                    <a href="javascript:;" class="btn btn-gray btn-icon btn-reply" id="btn-reply-btn">
                        <span><?=__('回复')?></span>
                        <i class="fa-reply-all"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-gray btn-icon btn-delete" id="msg-delete-btn">
                        <i class="fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>


        <!-- Email Body -->
        <div class="mail-single-body">
            <?=$data['message_content']?>
        </div>

        <!-- Email Attachments -->
        <!--<div class="mail-single-attachments">
            <h3>
                <i class="linecons-attach"></i>
                Attachments
            </h3>

            <ul class="list-unstyled list-inline">
                <li>
                    <a href="#" class="thumb">
                        <img src="assets/images/attach-1.png" class="img-thumbnail" />
                    </a>

                    <a href="#" class="name">
                        IMG_007.jpg
                        <span>14KB</span>
                    </a>

                    <div class="links">
                        <a href="#">View</a> -
                        <a href="#">Download</a>
                    </div>
                </li>

                <li>
                    <a href="#" class="thumb download">
                        <img src="assets/images/attach-2.png" class="img-thumbnail" />
                    </a>

                    <a href="#" class="name">
                        IMG_008.jpg
                        <span>12KB</span>
                    </a>

                    <div class="links">
                        <a href="#">View</a> -
                        <a href="#">Download</a>
                    </div>
                </li>
            </ul>
        </div>-->
<!--
        <div class="mail-single-reply">

            <div class="fake-form">
                <div>
                    <a href="extra-portlets.html">Reply</a> or <a href="extra-portlets.html">Forward</a> this message...
                </div>
            </div>

        </div>-->

    </div>
</section>
