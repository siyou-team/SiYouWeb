<h3><?=__('环境检查')?></h3>
<ol>
	<?php
    include INI_INSTALL_PATH . '/check_dir.ini.php';
    include INI_INSTALL_PATH . '/check_env.ini.php';
    include INI_INSTALL_PATH . '/check_ext.ini.php';

    $check_rs = true;
	foreach ($check_env_row as $ext_name=>$ext_row)
	{
        if (!$ext_row['state'])
        {
           $check_rs = false; 
        }
	?>
		<li class="line"><?php echo $ext_name?><span class="<?php echo $ext_row['state'] ? 'yes' : 'no' ?>"><i class="iconfont"></i><?php echo $ext_row['state'] ? __('支持') : __('不支持'); ?></span></li>
		<?php
	}
	?>
</ol>
<h3><?=__('扩展检查')?></h3>
<ol>
	<?php
	foreach ($check_ext_row as $ext_name=>$ext_row)
	{
        if (!$ext_row['state'])
        {
           $check_rs = false; 
        }
		?>
		<li class="line"><?php echo $ext_name?><span class="<?php echo $ext_row['state'] ? 'yes' : 'no' ?>"><i class="iconfont"></i><?php echo $ext_row['state'] ? __('支持') : __('不支持'); ?></span></li>
		<?php
	}
	?>
</ol>
<h3><?=__('文件权限检查')?></h3>
<ol>
	<?php
	foreach ($check_dir_row as $dir_row)
	{
        if (!$ext_row['state'])
        {
           $check_rs = false; 
        }
		?>
		<li class="line"><?php echo $dir_row['dir']?><span class="<?php echo $dir_row['state'] ? 'yes' : 'no' ?>"><i class="iconfont"></i><?php echo $dir_row['state'] ? __('可写') : __('不可写') ?></span></li>
		<?php
	}
	?>
</ol>

<script>

	<?php
    if ($check_rs)
	{
	?>
	$('#next_step').removeClass('button-disabled');
	$('#next_step').addClass('button-primary');
	<?php
	}
	else
    {
    ?>
    $('#next_step').addClass('button-disabled');
    $('#next_step').removeClass('button-primary');
    <?php
    }
	?>
</script>