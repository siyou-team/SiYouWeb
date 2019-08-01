<?php
class Text_Preg
{
	public static function getPreg($body_string)
    {
        $bodys = '(.*)'; //(.*), .不能为换行符，如何解决？
        $bodys_lines = '([\s\S]*)'; // 也可以用 “([\d\D]*)”、“([\w\W]*)” 来表示。 

        $preg_bodys = '\[内容\]';
        $preg_bodys_lines = '\[内容多行\]';

        $body = preg_quote($body_string, "/"); //给 . \\ + * ? [ ^ ] $( ) { } = ! < > | : 添加 \
        $body = preg_replace("/\s+/" , '\s+', $body); //给空加上 \s


        //$body = addcslashes($body,"\'\"\/");

        $body = str_replace($preg_bodys, $bodys, $body);
        $body = str_replace($preg_bodys_lines, $bodys_lines, $body);
        $body = str_replace( '"', '\"', $body);

        return $body;
    }
}
?>