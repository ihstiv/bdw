<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.4.5
 * Defines metaweblog API parameters
 * Last Updated: $Date: 2012-05-10 16:10:13 -0400 (Thu, 10 May 2012) $
 * </pre>
 *
 * @author 		$Author: bfarber $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/company/standards.php#license
 * @package		IP.Blog
 * @link		http://www.invisionpower.com
 * @version		$Rev: 10721 $
 *
 */

$_METAWEBLOG_ALLOWED_METHODS = array();

/**
* getCategories
* return the categories used in the Blog
*/
$_METAWEBLOG_ALLOWED_METHODS['getCategories'] = array(
													   'in'  => array(
													   					'param0'	=> 'integer',
																		'param1'	=> 'string',
																		'param2'	=> 'string'
																     ),
													   'out' => array(
																		'response' => 'xmlrpc'
																	 )
													 );

/**
* getRecentPosts
* return the most recent entries of the Blog
*/
$_METAWEBLOG_ALLOWED_METHODS['getRecentPosts'] = array(
													   'in'  => array(
													   					'param0'	=> 'integer',
																		'param1'	=> 'string',
																		'param2'	=> 'string',
																		'param3'	=> 'integer'
																     ),
													   'out' => array(
																		'response' => 'xmlrpc'
																	 )
													 );

/**
* newPost
* Post a new entry to the Blog
*/
$_METAWEBLOG_ALLOWED_METHODS['newPost'] = array(
													   'in'  => array(
													   					'param0'	=> 'integer',
																		'param1'	=> 'string',
																		'param2'	=> 'string',
																		'param3'	=> 'struct',
																		'param4'	=> 'bool'
																     ),
													   'out' => array(
																		'response' => 'xmlrpc'
																	 )
													 );

/**
* editPost
* Edit an entry in the Blog
*/
$_METAWEBLOG_ALLOWED_METHODS['editPost'] = array(
													   'in'  => array(
													   					'param0'	=> 'integer',
																		'param1'	=> 'string',
																		'param2'	=> 'string',
																		'param3'	=> 'struct',
																		'param4'	=> 'bool'
																     ),
													   'out' => array(
																		'response' => 'xmlrpc'
																	 )
													 );

/**
* getPost
* Get an entry from the Blog
*/
$_METAWEBLOG_ALLOWED_METHODS['getPost'] = array(
													   'in'  => array(
													   					'param0'	=> 'integer',
																		'param1'	=> 'string',
																		'param2'	=> 'string',
																     ),
													   'out' => array(
																		'response' => 'xmlrpc'
																	 )
													 );

/**
* newMediaObject
* Post a media object to the Blog
*/
$_METAWEBLOG_ALLOWED_METHODS['newMediaObject'] = array(
													   'in'  => array(
													   					'param0'	=> 'integer',
																		'param1'	=> 'string',
																		'param2'	=> 'string',
																		'param3'	=> 'struct',
																     ),
													   'out' => array(
																		'response' => 'xmlrpc'
																	 )
													 );