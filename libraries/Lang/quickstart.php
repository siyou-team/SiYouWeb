<?php

//echo 'hello world';


# Includes the autoloader for libraries installed with composer
require  'vendor/autoload.php';

# Imports the Google Cloud client library
use Google\Cloud\Translate\TranslateClient;



$translate = new TranslateClient([
    'key' => 'AIzaSyByJmxYEcAPAiWfP-CDK8O5Rh2P1-otSiQ'
]);
var_dump($translate);die;
# The text to translate
$text = 'Hello, world!';
# The target language
$target = 'ru';

# Translates some text into Russian
$translation = $translate->translate($text, [
    'target' => $target
]);

// echo 'Text: ' . $text . '
// Translation: ' . $translation['text'];

 ?>
