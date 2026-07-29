<?php
/**
 * @brief		settings
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	Chat
 * @since		15 Mar 2015
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\tapatalk\modules\admin\tapatalk;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
	/**
     * Execute
     *
     * @return	void
     */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'settings_manage' );
		parent::execute();
	}

	/**
     * Show the settings form
     *
     * @return	void
     */
	protected function manage()
	{
        $form = new \IPS\Helpers\Form;
        $form->addHeader('tapatalk_general');
        $form->add( new \IPS\Helpers\Form\Text( 'tapatalk_apikey', \IPS\Settings::i()->tapatalk_apikey ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'tapatalk_inappreg', \IPS\Settings::i()->tapatalk_inappreg ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'tapatalk_inappregapprove', \IPS\Settings::i()->tapatalk_inappregapprove ) );
        $groups = array();
        foreach(\IPS\Member\Group::groups() as $group)
        {
            $groups[$group->g_id] = $group->get_formattedName();
        }
        $form->add( new \IPS\Helpers\Form\Select( 'tapatalk_usergroup', explode(',', \IPS\Settings::i()->tapatalk_usergroup), FALSE, array('options'=>$groups, 'multiple'=>TRUE)));
        $form->add( new \IPS\Helpers\Form\Select( 'tapatalk_disableadsforgroup', explode(',', \IPS\Settings::i()->tapatalk_disableadsforgroup) , FALSE, array('options'=>$groups, 'multiple'=>TRUE)));
        $forums = $this->settingsGetForumsArray();
        $form->add( new \IPS\Helpers\Form\Select( 'tapatalk_hideforums', explode(',', \IPS\Settings::i()->tapatalk_hideforums), FALSE, array('options'=>$forums, 'multiple'=>TRUE)));
        $form->add( new \IPS\Helpers\Form\Select( 'tapatalk_disablenewtopic', explode(',', \IPS\Settings::i()->tapatalk_disablenewtopic), FALSE, array('options'=>$forums, 'multiple'=>TRUE)));
        $form->add( new \IPS\Helpers\Form\Text( 'tapatalk_threadcontentreplacement', \IPS\Settings::i()->tapatalk_threadcontentreplacement ) );
        
        if ( $values = $form->values() )
        {
            $values['tapatalk_disableadsforgroup'] = implode( ',', $values['tapatalk_disableadsforgroup'] );
            $values['tapatalk_hideforums'] = implode( ',', $values['tapatalk_hideforums'] );
            $values['tapatalk_disablenewtopic'] = implode( ',', $values['tapatalk_disablenewtopic'] );
            $values['tapatalk_usergroup'] = implode( ',', $values['tapatalk_usergroup'] );
            $form->saveAsSettings($values);
            /* Clear guest page caches */
			\IPS\Data\Cache::i()->clearAll();
        }
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('menu__tapatalk_tapatalk');
		\IPS\Output::i()->output	.= \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( 'menu__tapatalk_tapatalk_settings', $form );
	}
    function settingsGetForumsArray($forums = array(), $parentForum = null, $level=0)
    {
        if($parentForum != null)
        {
            if($parentForum->hasChildren())
            {
                $level++;
                foreach($parentForum->children() as $forum)
                {
                    $levelstr = '';
                    for($ix=0;$ix<$level;$ix++)
                    {
                        $levelstr .= '-';
                    }
                    $forumTitle = '';
                    try
                    {
                        $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
                    }
                    catch(Exception $ex)
                    {
                        $forumTitle = $forum->_id;
                    }
                    $forums[$forum->_id] = $levelstr . $forumTitle;
                    $forums = $this->settingsGetForumsArray($forums, $forum, $level);
                }
            }
        }
        else
        {
            foreach(\IPS\forums\Forum::roots() as $forum)
            {
                $forumTitle = '';
                try
                {
                    $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
                }
                catch(Exception $ex)
                {
                    $forumTitle = $forum->_id;
                }
                $forums[$forum->_id] = $forumTitle;
                $forums = $this->settingsGetForumsArray($forums, $forum);
            }
        }
        return $forums;
    }
}