
<section class="mailbox-env">
    <div class="col-sm-2 mailbox-left pd0">

        <div class="mailbox-sidebar">

            <a  data-fancybox data-src="#compose-mail" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                <i class="fa-pencil"></i>
                <span><?=__('写短信')?></span>
            </a>


            <ul class="list-unstyled mailbox-list">
                <li class="active">
                    <a href="#">
                        Inbox
                        <span class="badge badge-success pull-right">5</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Sent
                    </a>
                </li>
                <li>
                    <a href="#">
                        Drafts
                    </a>
                </li>
                <li>
                    <a href="#">
                        Spam
                        <span class="badge badge-purple pull-right">2</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Trash
                    </a>
                </li>
            </ul>
        </div>

    </div>
    
    <div class="col-sm-12 mail-env pt10 pl20 " id="mail_table_box">
    </div>
</section>

<?php $this->lazyJs('modules/sns/user-friend') ?>