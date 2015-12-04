<?php 
namespace Filter\Filters;

class SiteFilter extends Filterable
{
	/**
	 * model name associative array
	 * @var array
	 */
	protected $modelName = [
		'sites' => 'App\Site'
	];

	/**
	 * build the sql from the ids array
	 * @param  array  $ids
	 * @return null
	 */
	public function buildSql(array $ids)
	{
		if(is_null($this->table)) throw new Exception("valid tablename needs to be set");

		$this->join = ['sites', $this->table.'.site_id', '=', 'sites.id'];
		$this->whereNotIn = ['sites.id', $ids];
	}
}
 ?>