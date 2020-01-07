<?php
/**
 * ChinaTown - LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 7.2
 *
 * @version    GIT: <14.2.4>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/LICENSE
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Lib; // !!! !!!

class Rbac
{
	const RES = 'rbac';

		public function canIcreate($cid)
		{
		}

		public function canIread($cid)
		{
		}

		public function canIupdate($cid)
		{
		}

		public function canIdelete($cid)
		{
		}

    public function getMyRoleIn($cid)
    {
      global $session, $auth;
			$tmp = $session->get('state');
			$res = false;
			if ( $tmp ) {
				// $res $this->kkk($res,$cid);
			} else {
				//
			}
			$res = $session->get('state');
			return $res;
    }

		public function getOrgNameByCid($cid)
    {
		}

};
