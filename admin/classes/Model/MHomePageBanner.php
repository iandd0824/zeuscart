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
 * This class contains functions to mopdify the Home Page banner 
 *
 * @package  		Model_MHomePageBanner
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Model_MHomePageBanner
{
	
	/**
	 * Stores the output
	 *
	 * @var array 
	 */		
	var $output = array();	
	
	/**
	 * Function displays a template for modifiying the Home Page Banner
	 *   
	 * 
	 * @return array
	 */
	function homePageBanner()
	{

		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;

		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CHomePageBanner.php');
			include('classes/Display/DHomePageBanner.php');				
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
			$output['banner'] = Core_Settings_CHomePageBanner::homePageBanner($Err);
			$output['slide_parameter']=Core_Settings_CHomePageBanner::getSlideParameter();		
		/*
			$output['bannerurl'] = Core_Settings_CHomePageBanner::homePageBannerUrl();*/
			Bin_Template::createTemplate('homepagebanner.html',$output);
			UNSET($_SESSION['bannermsg']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}	
	
	/**
	 * Function to get the  the  home page slide show
	 *   
	 * 
	 * @return array
	 */
		
	function updateHomePageBanner()
	{

	
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CHomePageBanner.php');
			include('classes/Display/DHomePageBanner.php');
// 			$obj = new Lib_CheckInputs('updateslideshow');
			$_SESSION['bannermsg'] = Core_Settings_CHomePageBanner::updateHomePageBanner();
		
			header('Location:?do=banner');	
			
			//Bin_Template::createTemplate('updatehomepagebanner.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}

	
	/**
	 * Function to delete the  Home Page Banner
	 *   
	 * 
	 * @return array
	 */
		
	function deleteHomePageBanner()
	{
		include('classes/Core/Settings/CHomePageBanner.php');

		Core_Settings_CHomePageBanner::deleteHomePageBanner();
	}
}
?>