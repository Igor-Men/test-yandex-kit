<?php 
// Include dependencies installed with composer
require 'vendor/autoload.php';

use SpeechKit\Uploader\Curl as CurlUploader,
    SpeechKit\ResponseParser\SimpleXML as SimpleXMLParser,
    SpeechKit\SpeechKit,
    SpeechKit\SpeechContent\SpeechFactory,
    SpeechKit\SpeechContent\SpeechContentInterface,
    SpeechKit\Uploader\UploaderInterface
    ;

$uploader = new CurlUploader;

//General topic and russian language are by default so you can omit next 4 lines
$uploader->options()
    ->setTopic(UploaderInterface::TOPIC_GENERAL)
    ->setLang(UploaderInterface::LANG_RU)
;

$parser = new SimpleXMLParser;

$speechKit = new SpeechKit('3d79c3f5-dec0-43b2-8eaf-2790696c5722');
$speechKit
    ->setUploader($uploader)
    ->setResponseParser($parser)
;

$speech = SpeechFactory::fromData(__DIR__ . '/../Fixtures/Italian.mp3');

//Can omit this in case of mp3 which is default
$speech->setContentType(SpeechContentInterface::CONTENT_MP3);

$result = $speechKit->recognize($speech);