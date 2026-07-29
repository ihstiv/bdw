<?php

class contentPromoteToArticle
{
	/**
	 * Registry object
	 *
	 * @var		object
	 */	
	protected $registry;
	
	/**
	 * Constructor
	 *
	 * @return	@e void
	 */
	public function __construct()
	{
		$this->registry	= ipsRegistry::instance();
	}
	
	/**
	 * Get the output
	 *
	 * @return	string
	 */
	public function getOutput()
	{
	}
	
	/**
	 * Replace output
	 *
	 * @param	string		Output
	 * @param	string		Hook key
	 * @return	string		Output parsed
	 */
	public function replaceOutput( $output, $key )
	{
		if( is_array($this->registry->output->getTemplate('topic')->functionData['post']) AND count($this->registry->output->getTemplate('topic')->functionData['post']) )
		{
			if( !$this->registry->isClassLoaded('articles') )
			{
				$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'ccs' ) . '/sources/promote.php', 'promoteArticle', 'ccs' );
				$this->registry->setClass( 'articles', new $classToLoad( ipsRegistry::instance() ) );
			}
			
			$tag	= '<!--hook.' . $key . '-->';
			$last	= 0;
		
			foreach( $this->registry->output->getTemplate('topic')->functionData['post'] as $_post )
			{
				$pos	= strpos( $output, $tag, $last );

				if( $pos AND !$_post['post']['post']['_isDeleted'] AND !$_post['topic']['_isArchived'] )
				{
					$pid	= $_post['post']['post']['pid'];
					$string	= $this->registry->articles->getPostHook( $pid );
					$output	= substr_replace( $output, $string . $tag, $pos, strlen( $tag ) ); 
					$last	= $pos + strlen( $tag . $string );
				}
			}
		}
		
		return $output;
	}
}