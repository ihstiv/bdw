<?php

class tapatalk_output extends restOutput
{
    public function __construct( ipsRegistry $registry, $initialize=FALSE )
    {
        parent::__construct( $registry, $initialize );
        
        if (defined('IN_MOBIQUO') && !defined('MOBIQUO_HEAD_READY'))
        {
            @header('Mobiquo_is_login:'.($this->memberData['member_id'] ? 'true' : 'false'));
            @header('Mobiquo-Hook:1');
            define('MOBIQUO_HEAD_READY', true);
        }
    }
    
    public function showError( $message, $code=0, $logError=FALSE, $logExtra='', $header=401 )
    {
        if (defined('IN_MOBIQUO'))
        {
            $header = 200;
            $msg    = "";
            $extra  = "";
            $this->registry->getClass('class_localization')->loadLanguageFile( array( "public_error" ), 'core' );
    
            if ( is_array( $message ) )
            {
                $msg    = $message[0];
                $extra  = $message[1];
            }
            else
            {
                $msg    = $message;
            }
            
            $msg = ( isset($this->lang->words[ $msg ]) ) ? $this->lang->words[ $msg ] : $msg;
                
            if ( $extra )
            {
                $msg = sprintf( $msg, $extra );
            }
            
            @header('Content-Type: text/xml');
            
            if (!defined('MOBIQUO_HEAD_READY'))
                @header('Mobiquo_is_login:'.($this->memberData['member_id'] ? 'true' : 'false'));
            
            $response_php = array(
                'result'        => new xmlrpcval(false, 'boolean'),
                'result_text'   => new xmlrpcval(subject_clean($msg), 'base64'),
            );
            
            if ($code < 0) $response_php['status'] = new xmlrpcval(abs($code), 'string');
            
            $response = new xmlrpcresp(new xmlrpcval($response_php, 'struct'));
        
            echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".$response->serialize('UTF-8');
            exit;
        }
        else
            parent::showError( $message, $code, $logError, $logExtra, $header );
    }
    
    public function replaceMacros( $text )
    {
        if (!defined('IN_MOBIQUO') && class_exists('public_forums_ajax_topics') && $this->request['do'] == 'editBoxSave')
        {
            // display emoji from app
            $protocol = $this->registry->output->isHTTPS ? 'https' : 'http';
            $text = preg_replace('/\[emoji(\d+)\]/i', '<img src="'.$protocol.'://s3.amazonaws.com/tapatalk-emoji/emoji\1.png" />', $text);
        }
        
        return parent::replaceMacros( $text );
    }
    
    public function redirectScreen( $text="", $url="", $seoTitle="", $seoTemplate='' )
    {
        
        if (defined('IN_MOBIQUO'))
        {
            global $result_text, $request_name;
            switch($request_name)
            {
                case 'm_close_report': return;
                case 'new_topic': 
                case 'reply_post': $result_text = $text;
                case 'save_raw_post': return;
                case 'new_conversation':define('FUNC_SUCCESS', true);return;
            }
        }
        
        parent::redirectScreen( $text, $url, $seoTitle, $seoTemplate );
    }
    
    public function silentRedirect( $url, $seoTitle='', $send301=FALSE, $seoTemplate='' )
    {               
        if (defined('IN_MOBIQUO'))
        {
            global $request_name;
            
            if ($url == $this->settings['base_url']."app=core&amp;module=usercp&amp;tab=core&amp;area=ignoredusers&amp;do=show")
                return;
            else if (in_array($request_name, array('new_topic', 'reply_post', 'm_close_report')))
                return;
            else if (in_array($request_name, array('update_signature')))
            {
                define('FUNC_SUCCESS', true);
                return;
            }
            else if (in_array($request_name, array('reply_conversation')))
            {
                preg_match( "/(?<=msgID=)\d+/", $url, $matches );
                $GLOBALS['new_msg_id'] = $matches[0];
                define('FUNC_SUCCESS', true);
                return;
            }
            else if ($url == $this->settings['base_url'].'app=core&amp;module=global&amp;section=register&amp;do=07')
            {
                global $result_text;
                $this->registry->class_localization->loadLanguageFile( array( 'public_register' ), 'core' );
                $result_text = $this->lang->words['validate_instructions_1'];
                return;
            }
        }
        else
            parent::silentRedirect( $url, $seoTitle, $send301, $seoTemplate );
    }
    
    public function addContent( $content, $prepend=false )
    {
        if (!defined('IN_MOBIQUO') && (class_exists('public_forums_forums_topics') || class_exists('public_members_messaging_view')))
        {
            // display emoji from app
            $content = preg_replace('/\[emoji(\d+)\]/', '<img src="https://s3.amazonaws.com/tapatalk-emoji/emoji\1.png" />', $content);
        }
        
        parent::addContent( $content, $prepend );
    }
    
    public function sendOutput( $return=false )
    {
        if (defined('IN_MOBIQUO'))
        {
            if (defined('FUNC_SUCCESS'))return;
            $this->showError($this->_html);
        }
        else
            return parent::sendOutput($return);
    }
    
    public function showBoardOffline()
    {
        if (defined('IN_MOBIQUO'))
        {
            if( !$this->offlineMessage )
            {
                $row = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'core_sys_conf_settings', 'where' => "conf_key='offline_msg'" ) );
                
                $this->registry->getClass( 'class_localization')->loadLanguageFile( array( "public_error" ), 'core' );
                
                $this->offlineMessage = $row['conf_value'];
            }
            
            IPSText::getTextClass('bbcode')->parse_bbcode       = 1;
            IPSText::getTextClass('bbcode')->parse_html         = 1;
            IPSText::getTextClass('bbcode')->parse_emoticons    = 1;
            IPSText::getTextClass('bbcode')->parse_nl2br        = 1;
            IPSText::getTextClass('bbcode')->parsing_section    = 'global';
            
            $this->offlineMessage = IPSText::getTextClass('bbcode')->preDisplayParse( IPSText::getTextClass('bbcode')->preDbParse( $this->offlineMessage ) );
            $this->offlineMessage = sprintf( $this->lang->words['board_offline_desc'], $this->settings['board_name']) . "\n" . $this->offlineMessage;
            
            $this->showError($this->offlineMessage);
        }
        else
            parent::showBoardOffline($return);
    }
}