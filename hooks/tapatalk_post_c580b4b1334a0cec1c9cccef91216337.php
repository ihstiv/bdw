<?php

class tapatalk_post extends public_forums_post_post
{
    public function doExecute( ipsRegistry $registry )
    {
        if (defined('IN_MOBIQUO'))
        {
            $this->settings['tags_min_req'] = 0;
            $this->settings['tags_min'] = 0;
            $this->request['auth_key'] = $this->member->form_hash;
            $this->request['enablesig'] = 'yes';
            $this->request['enableemo'] = 'yes';

            $original_Post = $_POST['Post'];
            $_POST['Post'] = cleanPost($_POST['Post']);
            
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
            $_POST['Post'] = $parser->BBCodeToHtml( $_POST['Post'] );
            
            // Convert POST content from UTF8 to local forum Document character set
            $_POST['Post'] = to_local($_POST['Post']);
            if (isset($_POST['TopicTitle']))
                $_POST['TopicTitle'] = to_local($_POST['TopicTitle']);
            if (isset($this->request['post_edit_reason']))
                $this->request['post_edit_reason'] = to_local($this->request['post_edit_reason']);
            
            $this->request['Post'] = cleanPost($_POST['Post']);
            
            // prepare prefix for tag
            if (isset($_POST['ipsTags']) && $_POST['ipsTags'])
            {
                $_POST['ipsTags'] = to_local($_POST['ipsTags']);
                
                if ($this->settings['tags_can_prefix'])
                {
                    if ($this->memberData['g_is_supmod'] || (
                            $this->settings['tags_enabled'] 
                        && !$this->memberData['bw_disable_tagging']
                        && !$this->memberData['gbw_disable_tagging']
                        && !$this->memberData['bw_disable_prefixes']
                        && !$this->memberData['gbw_disable_prefixes'])
                       )
                    {
                        $_POST['ipsTags_prefix'] = 1;
                        $_REQUEST['ipsTags_prefix'] = 1;
                        $this->request['ipsTags_prefix'] = 1;
                    }
                }
            }
            if (isset($this->request['ipsTags']))
                $this->request['ipsTags'] = to_local($this->request['ipsTags']);
            
            if ($this->request['p'] && empty($this->request['t']))
            {
                $post = $this->DB->buildAndFetch( array( 'select' => 'p.*', 'from' => array( 'posts' => 'p' ), 'where' => "p.pid={$this->request['p']}" ) );
                $this->request['t'] = $post['topic_id'];
            }
            
            if ($this->request['t'] && empty($this->request['f']))
            {
                $topic = $this->DB->buildAndFetch( array( 'select' => 't.*', 'from' => array( 'topics' => 't' ), 'where' => "t.tid={$this->request['t']}" ) );
                $this->request['f'] = $topic['forum_id'];
            }
            
            $_track = 0;
            if (isset($this->request['t']) && $this->memberData['member_id'])
            {
                require_once( IPS_ROOT_PATH . 'sources/classes/like/composite.php' );/*noLibHook*/
                $_like  = classes_like::bootstrap( 'forums', 'topics' );
                $_track = $_like->isLiked( $this->request['t'], $this->memberData['member_id'] );
            }
            
            if (isset($this->request['p']))
                $this->request['enabletrack'] = $_track;
            else if (isset($this->request['t']))
                $this->request['enabletrack'] = $this->memberData['auto_track'] ? 1 : $_track;
            else
                $this->request['enabletrack'] = $this->memberData['auto_track'] ? 1 : 0;
        }
        
        parent::doExecute($registry);
        
        if (defined('IN_MOBIQUO'))
        {
            global $result, $request_name;
            
            switch ($request_name)
            {
                case 'new_topic':
                    $result = $this->_postClass->getTopicData();
                    break;
                case 'reply_post':
                    $result = $this->_postClass->getPostData();
                    break;
                case 'save_raw_post':
                    $result = true;
                    break;
            }

            $_POST['Post'] = $original_Post;
        }
    }
}