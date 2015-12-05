<?php 
namespace Hugorut\Filter\Filters;

use Hugorut\Filter\Exceptions\TableNameException;

class SiteFilter extends Filterable
{
	/**
	 * set the clauses of the sql from the ids array
	 * 
	 * @param  array  $ids
	 * @return null
	 */
	public function setClauses(array $ids)
	{
		$this->join = ['sites', $this->table.'.site_id', '=', 'sites.id'];
		$this->whereNotIn = ['sites.id', $ids];
	}
}
 ?>