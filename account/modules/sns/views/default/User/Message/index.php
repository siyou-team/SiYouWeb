

<div class="row form-inline">
    <div class="col-sm-3">
        <div class="vertical-top">
            <button class="btn btn-primary btn-icon btn-icon-standalone" data-fancybox data-src="#compose-mail" id="compose-msg-btn">
                <i class="fa-pencil"></i>
                <span><?=__('写短信')?></span>
            </button>

        </div>
    </div>
    <div class="col-sm-9">
        <div class="vertical-top  pull-right">
            <button class="btn btn-gray btn-icon btn-icon-standalone hide" id='msg_remove_btn' >
                <i class="fa-trash"></i>
                <span><?=__('删除')?></span>
            </button>
        </div>
    </div>
</div>

<section class="mailbox-env">

    <!--
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

            <div class="vspacer"></div>

            <ul class="list-unstyled mailbox-list">
                <li class="list-header">Filter by tags</li>
                <li>
                    <a href="#">
                        ThemeForest
                        <span class="badge badge-success badge-roundless pull-right upper">Envato</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Society
                        <span class="badge badge-red badge-roundless pull-right upper">Friends</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Work
                        <span class="badge badge-warning badge-roundless pull-right upper">Google</span>
                    </a>
                </li>
            </ul>

        </div>

    </div>
    -->
    <div class="col-sm-12 mail-env " id="mail_table_box">
    </div>

    <!-- mail table -->
    <script type="text/x-template" id="mail_table_tpl">
        <table class="table mail-table" id="mail_table">
            <!-- mail table header -->
            <thead>
            <tr>
                <th class="col-cb">
                    <input type="checkbox" class="cbr" />
                </th>
                <th colspan="4" class="col-header-options">

                    <div class="mail-select-options"><?=__('全选')?></div>

                    <div class="mail-pagination">
                        <strong>{{page}}</strong> / <strong>{{total}}</strong> <?=__('页')?>

                        <div class="next-prev">
                            <a :href="'javascript:load_msg(' + page + '-1)'" v-if="1!=page"><i class="fa-angle-left"></i></a>
                            <a :href="'javascript:load_msg(' + page + '+1)'" v-if="total!=page"><i class="fa-angle-right"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
            </thead>

            <!-- mail table footer -->
            <tfoot>
            <tr>
                <th class="col-cb">
                    <input type="checkbox" class="cbr" />
                </th>
                <th colspan="4" class="col-header-options">

                    <div class="mail-select-options"><?=__('全选')?></div>


                    <div class="mail-pagination">
                        <strong>{{page}}</strong> / <strong>{{total}}</strong> <?=__('页')?>

                        <div class="next-prev">
                            <a :href="'javascript:load_msg(' + page + '-1)'" v-if="1!=page"><i class="fa-angle-left"></i></a>
                            <a :href="'javascript:load_msg(' + page + '+1)'" v-if="total!=page"><i class="fa-angle-right"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
            </tfoot>

            <!-- email list -->
            <tbody>
            <tr :class="{ unread: 0==item.message_is_read }"  v-for="item in items">
                <td class="col-cb">
                    <div class="checkbox checkbox-replace">
                        <input type="checkbox" name="message_id" class="cbr" :value="item.message_id"  />
                    </div>
                </td>
                <td class="col-name">
                    <a href="#" class="star">
                        <i class="fa-star-empty"></i>
                    </a>
                    <span class="label label-danger" v-if="1==item.message_type"><?=__('系统')?></span>
                    <span class="label label-success" v-if="!item.message_is_read"><?=__('未读')?></span>
                    <a href="javascript:" class="fancybox" data-type="ajax" :data-data="'message_id=' + item.message_id" :data-src="itemUtil.getUrl(SYS.CONFIG.index_url, {ctl:'User_Message', met:'get',mdu:'sns',message_id:item.message_id})"  class="col-name">{{item.user_other_nickname}}</a>
                </td>
                <td class="col-subject">
                    <a href="javascript:" class="fancybox" data-type="ajax" :data-src="itemUtil.getUrl(SYS.CONFIG.index_url, {ctl:'User_Message', met:'get',mdu:'sns',message_id:item.message_id})" >
                        {{item.message_content}}
                    </a>
                </td>
                <td class="col-options hidden-sm hidden-xs"></td>
                <td class="col-time">{{new Date(parseInt(item.message_time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")}}</td>
            </tr>
            </tbody>

        </table>
    </script>


    <div class="manage-edit-box mail-compose"  id="compose-mail" style="display:none; width: 600px;">
        <!-- Header Title and Button Options -->
        <div class="mail-header" style="padding-left: 20px;">
            <h3>
                <i class="fa fa-pencil"></i>
                <?=__('写短信')?>
            </h3>
        </div>
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=urlh('account.php', 'User_Message', 'add', 'sns')?>"  data-validator-option="{stopOnError:false, timely:false}">
                <div class="form-section">
                    <label class="input-label" for="user_id"><?=__('短消息接收人')?></label>
                    <input type="text" class="input-text form-control" name="user_nickname" id="user_nickname"  placeholder="<?=__('短消息接收人')?>" data-rule="required;remote(<?=urlh('account.php', 'User_Message', 'getUserByNickname', 'sns', 'typ=json')?>)" />
                </div>
                
                <div class="form-section">
                    <label class="input-label" for="message_content"><?=__('短消息内容')?></label>
                    <textarea type="text" class="input-text form-control autosize" name="message_content" id="message_content"  placeholder="<?=__('短消息内容')?>" data-rule="required;" required></textarea>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <a type="submit"
                           class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                           id="submit-btn">
                            <i class="fa-pencil"></i>
                            <span><?=__('修改')?></span>
                        </a>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</section>


<?php $this->lazyJs('modules/sns/user-msg') ?>

