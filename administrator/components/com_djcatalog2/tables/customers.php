<?php
/**
 * @version $Id: customers.php 272 2014-05-21 10:25:49Z michal $
 * @package DJ-Catalog2
 * @copyright Copyright (C) 2012 DJ-Extensions.com LTD, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Michal Olczyk - michal.olczyk@design-joomla.eu
 *
 * DJ-Catalog2 is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-Catalog2 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-Catalog2. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// No direct access
defined('_JEXEC') or die;

class Djcatalog2TableCustomers extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct('#__djc2_users', 'id', $db);
	}
	function bind($array, $ignore = '')
	{
		return parent::bind($array, $ignore);
	}
	public function store($updateNulls = false)
	{
		$app = JFactory::getApplication();
		
		if (!$this->user_id) {
			$this->setError(JText::_('COM_DJCATALOG2_ERROR_USER_ID_MISSING'));
			return false;
		}	
		$table = JTable::getInstance('Customers', 'Djcatalog2Table');
		
		if ($table->load(array('user_id'=>$this->user_id)) && ($table->id != $this->id || $this->id==0)) {
			$this->setError(JText::_('COM_DJCATALOG2_ERROR_UNIQUE_USER_ID'));
			return false;
		}
		
		return parent::store($updateNulls);
	}
	
}
