<?php
class tapatalk_conversation extends public_members_messaging_send
{
    public function doExecute( ipsRegistry $registry )
    {
        if (defined('IN_MOBIQUO'))
        {            
            $this->request['auth_key'] = $this->member->form_hash;
            $this->request['authKey']  = $this->member->form_hash;
            
            $_POST['Post']       = cleanPost($_POST['Post']);
            $_POST['msgContent'] = cleanPost($_POST['msgContent']);
            
            //force MobileSkin false
            $this->registry->output->setAsMobileSkin(false);
            
            // Convert POST content from BBCODE to HTML
            $classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/text/parser.php', 'classes_text_parser' );
            $parser = new $classToLoad();
            
            /* Set up some settings */
            $parser->set( array( 'parseArea'      => 'topics',
                                 'memberData'     => $this->memberData,
                                 'parseBBCode'    => true,
                                 'parseHtml'      => false,
                                 'parseEmoticons' => true ) );
            $parser->setForceBbcode(true);
            
            $_POST['Post']       = $parser->BBCodeToHtml( $_POST['Post'] );
            $_POST['msgContent'] = $parser->BBCodeToHtml( $_POST['msgContent'] );
            
            // Convert POST content from UTF8 to local forum Document character set
            $_POST['Post']       = to_local($_POST['Post']);
            $_POST['msgContent'] = to_local($_POST['msgContent']);
            if (isset($_POST['msg_title']))
                $_POST['msg_title'] = to_local($_POST['msg_title']);
        }
            
        parent::doExecute($registry);
        
        if (defined('IN_MOBIQUO'))
        {
            global $result, $request_name;
            switch ($request_name)
            {
                case 'new_conversation':
                    $result = isset($GLOBALS['new_conv_id']) ? $GLOBALS['new_conv_id'] : true;
                    break;
                case 'reply_conversation':
                    $result = isset($GLOBALS['new_msg_id']) ? $GLOBALS['new_msg_id'] : true;
                    break;
            }
        }
    }
    protected function _showNewTopicForm( $errors='' )
    {
        if (defined('IN_MOBIQUO'))
        {
            $this->registry->getClass('output')->showError($errors);
        }
        else 
        {
            return parent::_showNewTopicForm( $errors );
        }
    }
}