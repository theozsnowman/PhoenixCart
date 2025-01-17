<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  if (class_exists($_GET['module'])) {
    $module =& Guarantor::ensure_global($_GET['module']);

    if (cfg_modules::can($module, 'remove')) {
      $module->remove();

      $db->query(sprintf(
        "UPDATE configuration SET configuration_value = '%s' WHERE configuration_key = '%s'",
        $db->escape(implode(';', array_diff($modules_installed, ["{$_GET['module']}.php"]))),
        $db->escape($module_key)
        ));

      return $Admin->link('modules.php', ['set' => $set]);
    }

    $messageStack->add_session(ERROR_MODULE_HAS_DEPENDENTS, 'error');
    foreach ($customer_data->get_last_matched_requirers() as $requirement => $requirers) {
      $messageStack->add_session($requirement . htmlspecialchars(' => ') . implode(', ', $requirers));
    }
  }

  Href::redirect($Admin->link('modules.php', ['set' => $set, 'module' => $_GET['module']]));
