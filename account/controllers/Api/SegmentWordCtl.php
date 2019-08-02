<?php
class Api_SegmentWordCtl extends Api_AccountController
{
    public function index()
    {
        $text = s('text');
        $words_row = Zero_Utils_WordSegmentation::segmentWord($text);

        $this->render('user', $words_row);
    }
}
?>


