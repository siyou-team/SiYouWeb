<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<div class="login-container">
    <div class="row">
        <div class="col-sm-12">
            <!-- Add class "fade-in-effect" for login form effect -->
            <form method="post" role="form" id="register" class="login-form fade-in-effect in" novalidate="novalidate">
    
                <?=Base_ConfigModel::getConfig('reg_protocols_description');?>
            </form>
        </div>
    </div>
</div>
