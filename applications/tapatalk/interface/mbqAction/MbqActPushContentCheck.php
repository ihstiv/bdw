<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseActPushContentCheck');

Class MbqActPushContentCheck extends MbqBaseActPushContentCheck {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * action implement
     */
    public function actionImplement($in) {
        $result = false;
        switch($in->data['type'])
        {
            case 'newtopic':
            case 'sub':
            case 'quote':
            case 'tag':
            {
                $topic = \IPS\forums\Topic::load($in->data['id']);
                if(isset($topic) && $topic->__get('tid') == $in->data['id'] && ($topic->__get('starter_id') == $in->data['authorid'] || $topic->__get('starter_name') == $in->data['author']))
                {
                        $result = true;
                }
                break;
            } 
            case 'conv':
            case 'pm':
            {
                $message = IPS\core\Messenger\Message::load($in->data['mid']);
                if(isset($message) && $message->__get('author_id') == $in->data['authorid'] || $message->author()->__get('name') == $in->data['author'])
                {
                        $result = true;
                }
                break;
            }
        
        }
        $this->data =  array(
            'result' => $result,
            'result_text' => $result ? '' : 'fail',
        );
    }
  
}
