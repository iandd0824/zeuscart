<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/


/**
 * This class contains functions to display the product details 
 * at the admin side.
 *
 * @package  		Model_MProductDetail
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MProductDetail
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();	
	
	
	/**
	 * Function displays the list of products available  
	 * 
	 * 
	 * @return array
	 */
	function showProducts()
	{
		include_once('classes/Core/CProductDetail.php');
		include_once('classes/Display/DProductDetail.php');
		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];				
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=Core_CAdminHome::lowStock();
		$output['totalproducts']=Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
		
		$default=new Core_CProductDetail();
		$output['products']=$default->showProducts();
		
		Bin_Template::createTemplate('products.html',$output);
	}
	
	
	/**
	 * Function displays the details of the products available 
	 * 
	 * 
	 * @return array
	 */
	
	function productDetail()
	{
		include_once('classes/Core/CProductDetail.php');
		include_once('classes/Display/DProductDetail.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');
		$output['username']=Core_CAdminHome::userName();
		$default=new Core_CProductDetail();
		$output['product']=$default->productDetail();
		$output['attributes']=$default->attributeList();
		$output['rating']=$default->reviewRating();
		$output['review']=$default->reviewCount();
		
		$output['relprod']=$default->relatedProducts();
		Bin_Template::createTemplate('productdetail.html',$output);
	}
	
	/**
	 * Function displays the list of last viewed products   
	 * 
	 * @return array
	 */
	function lastViewedProducts()
	{
		include_once('classes/Core/CProductDetail.php');
		include_once('classes/Display/DProductDetail.php');
		$default=new Core_CProductDetail();
		$output['product']=$default->productDetail();
		$output['attributes']=$default->attributeList();
		$output['relprod']=$default->relatedProducts();
		$output['lastviewprod']=$default->lastViewedProducts();
		Bin_Template::createTemplate('productdetail.html',$output);
	}
	
	
}	
