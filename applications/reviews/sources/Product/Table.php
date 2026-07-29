<?php

/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   6/27/2023 11:56 AM
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

namespace IPS\reviews\Product;

/* To prevent PHP errors (extending class does not exist) revealing path */
if (!defined('\IPS\SUITE_UNIQUE_KEY'))
{
	header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 403 Forbidden');
	exit;
}

class _Table extends \IPS\Helpers\Table\Content
{
	public function __construct( \IPS\Http\Url $baseUrl, $where = NULL, \IPS\Node\Model $container = NULL )
	{
		$this->sortBy = \IPS\Request::i()->sortBy ?? 'rating';
		parent::__construct( 'IPS\reviews\Product', $baseUrl, $where, $container );

		$this->limit = 20;
		$this->noModerate = true;
		
		switch( $this->sortBy )
		{
			case 'product_weighted':
			case 'product_total_reviews':
				$this->sortDirection = 'desc';
				break;

			default:
				$this->sortDirection = 'asc';
				break;
		}

		$this->sortOptions = array(
			'rating' => 'product_weighted',
			'title' => 'product_name',
			'num_reviews' => 'product_total_reviews'
		);

		$this->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'category', 'reviews' ), 'productRows' );
	}
}