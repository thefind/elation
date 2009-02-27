<?
/*
  Copyright (c) 2005 James Baicoianu

  This library is free software; you can redistribute it and/or
  modify it under the terms of the GNU Lesser General Public
  License as published by the Free Software Foundation; either
  version 2.1 of the License, or (at your option) any later version.

  This library is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
  Lesser General Public License for more details.

  You should have received a copy of the GNU Lesser General Public
  License along with this library; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include_once("autoload.php");
include_once("common_funcs.php");
include_once("config/outlet_conf.php");

class WebApp {
  function WebApp($rootdir, $args) {
    $this->rootdir = $rootdir;
    //$this->cfg = new ConfigManager($rootdir);
    //$this->data = new DataManager($this->cfg);
    $this->outlet = Outlet::getInstance();
    $this->outlet->createProxies(); // TODO - needs per-component proxy initialization support added to Outlet

    $this->smarty = SuperSmarty::singleton($this->rootdir);
    $this->smarty->assign_by_ref("webapp", $this);
    $this->components = new ComponentDispatcher($this);
    //$this->smarty->SetComponents($this->components);
  }

  function Display() {
    $output = $this->components->Dispatch();
    print $output;
  }
}