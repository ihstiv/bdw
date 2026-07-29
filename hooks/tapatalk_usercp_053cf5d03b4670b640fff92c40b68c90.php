<?php

class tapatalk_usercp extends public_core_usercp_manualResolver
{
    public function doExecute( ipsRegistry $registry )
    {
        if (defined('IN_MOBIQUO'))
        {
            $this->request['secure_hash'] = $this->member->form_hash;
            $sig = $post = $_POST['Post'];
            
            //$post escapes HTML
            $post = cleanPost($post);
            
            // Convert $post from BBCODE to HTML
            $classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/text/parser.php', 'classes_text_parser' );
            $parser = new $classToLoad();
            
            /* Set up some settings */
            $parser->set( array( 'parseArea'      => 'topics',
                                 'memberData'     => $this->memberData,
                                 'parseBBCode'    => true,
                                 'parseHtml'      => false,
                                 'parseEmoticons' => true ) );
            $parser->setForceBbcode(true);
            $post = $parser->BBCodeToHtml( $post );
            
            // Convert POST content from UTF8 to local forum Document character set
            $post = to_local($post);
            
            //set current $_POST
            $_POST['Post'] = $post;
            
            //clean the post again
            $post = cleanPost($post);
            
            //set current $this->request['post']
            $this->request['Post'] = $post;
        }
        parent::doExecute($registry);
        if (defined('IN_MOBIQUO'))
        {
            global $signature,$request_name;
            
            switch ($request_name)
            {
                case 'update_signature':
                    if (defined('FUNC_SUCCESS'))
                    {
                        $signature = $sig;
                    }
                    break;
               
            }
        }
    }
}
