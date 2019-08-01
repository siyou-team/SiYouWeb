<?php
if (false && extension_loaded('scws') && function_exists('scws_new'))
{
  $so = scws_new();
}
else
{
  require 'PSCWS4.php';
  $so = new Text_PSCWS4('utf-8');
  $so->set_dict('etc/dict.utf8.xdb');
  $so->set_rule('etc/rules.ini');
  //$so->set_multi(3);
  //$so->set_ignore(true);
  //$so->set_debug(true);
  //$so->set_duality(true);
}

$so->set_charset('utf8');
// 这里没有调用 set_dict 和 set_rule 系统会自动试调用 ini 中指定路径下的词典和规则文件
$so->send_text("我是一个中国人,我会C++语言,我也有很多T恤衣服");

$data = $so->get_tops(5);
print_r($data);


while ($tmp = $so->get_result())
{
  print_r($tmp);
}
$so->close();
?>