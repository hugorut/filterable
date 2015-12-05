<?php 
namespace Hugorut\Filter\Builders;

use Hugorut\Filter\Models\Article;

class ArticleFilterBuilder extends Builder
{
	/**
	 * table name to filter
	 * 
	 * @var string
	 */
	protected $tableName = 'articles';

	/**
	 * create a base eloquent search
	 * 
	 * @return null
	 */
	public function buildBaseQuery()
	{
		$this->query = Article::select();
	}

	/**
	 * get the query
	 * 
	 * @return collection
	 */
	public function execute()
	{
		return $this->query->groupBy('articles.id')
						   ->select('articles.*');
	}
}

?>