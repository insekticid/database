<?php

/**
 * This file is part of the Nette Framework.
 *
 * Copyright (c) 2004, 2010 David Grudl (http://davidgrudl.com)
 *
 * This source file is subject to the "Nette license", and/or
 * GPL license. For more information please see http://nette.org
 */

namespace Nette\Database\Reflection;

use Nette;



/**
 * Reflection metadata class for a database. TEMPORARY SOLUTION
 *
 * @author     Jakub Vrana
 */
class DatabaseReflection extends Nette\Object
{
	/** @var string */
	private $primary;

	/** @var string */
	private $foreign;

	/** @var string */
	private $table;



	/**
	 * Create conventional structure.
	 * @param  string %s stands for table name
	 * @param  string %1$s stands for key used after ->, %2$s for table name
	 * @param  string %1$s stands for key used after ->, %2$s for table name
	 */
	public function __construct($primary = 'id', $foreign = '%s_id', $table = '%s')
	{
		$this->primary = $primary;
		$this->foreign = $foreign;
		$this->table = $table;
	}



	public function getPrimary($table)
	{
		return sprintf($this->primary, $table);
	}



	public function getReferencingColumn($name, $table)
	{
		return $this->getReferencedColumn($table, $name);
	}



	public function getReferencedColumn($name, $table)
	{
		if ($this->table !== '%s' && preg_match('(^' . str_replace('%s', '(.*)', preg_quote($this->table)) . '$)', $name, $match)) {
			$name = $match[1];
		}
		return sprintf($this->foreign, $name, $table);
	}



	public function getReferencedTable($name, $table)
	{
		return sprintf($this->table, $name, $table);
	}

}