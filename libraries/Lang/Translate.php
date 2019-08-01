<?php

require 'vendor/autoload.php';

use Google\Cloud\Translate\TranslateClient;



class Lang_Translate extends TranslateClient
{
    private static $appkey = 'AIzaSyByJmxYEcAPAiWfP-CDK8O5Rh2P1-otSiQ';


    public function __construct()
    {

        parent::__construct(['key' => self::$appkey]);

    }


    /**
     * Retrieves the translation of a text
     *
     * @param string $source
     *            Original language of the text on notation xx. For example: es, en, it, fr...
     * @param string $target
     *            Language to which you want to translate the text in format xx. For example: es, en, it, fr...
     * @param string $text
     *            Text that you want to translate
     *
     * @return string a simple string with the translation of the text in the target language
     */
    public function translate($source = 'en', $target, $text)
    {
        $result = parent::translate($text, [
            'source' => $source,
            'target' => $target,
        ]);

        return $result['text'];
    }



    /**
     *
     * You can use this API to detect the language of given text.
     * @param string $text
     * @return string a simple string with the detect the language of given text
     */
    public function detect( $text )
    {
        $result = parent::detectLanguage($text);


        return $result;
    }



    /**
     *
     * You can use this API to detect the language of given text.
     * @param string $text
     * @return string a simple string with the detect the language of given text
     */
    public function language()
    {
        $result = parent::localizedLanguages([
            'target' => 'en'
        ]);

        return $result;
    }
}
