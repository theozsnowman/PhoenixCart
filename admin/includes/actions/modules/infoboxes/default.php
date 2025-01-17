<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  if (isset($mInfo)) {
    $heading = $mInfo->title;

    $link = $Admin->link('modules.php')->retain_query_except()->set_parameter('module', $mInfo->code);
    if (in_array("{$mInfo->code}.php", $modules_installed) && ($mInfo->status > 0)) {
      $keys = '';
      foreach ($mInfo->keys as $value) {
        $keys .= '<strong>' . $value['title'] . '</strong><br>';

        if ($value['use_function']) {
          if (strpos($value['use_function'], '->')) {
            $class_method = explode('->', $value['use_function']);
            $use_function = [Guarantor::ensure_global($class_method[0]), $class_method[1]];
          } else {
            $use_function = $value['use_function'];
          }

          if (is_callable($use_function)) {
            $keys .= call_user_func($use_function, $value['value']);
          } else {
            $keys .= '0';
            $messageStack->add(sprintf(
              WARNING_INVALID_USE_FUNCTION,
              $configuration['use_function'],
              $configuration['configuration_title']
             ), 'warning');
          }
        } else {
          $keys .= Text::break($value['value'], 40, '<br>');
        }

        $keys .= '<br><br>';
      }
      $keys = Text::rtrim_once($keys, '<br><br>');

      $contents = ['form' => new Form('remove_module', (clone $link)->set_parameter('action', 'remove'))];
      $contents[] = [
        'class' => 'text-center',
        'text' => $Admin->button(IMAGE_EDIT, 'fas fa-plus', 'btn-warning mr-2', $link->set_parameter('action', 'edit'))
                . new Button(IMAGE_MODULE_REMOVE, 'fas fa-minus', 'btn-warning'),
      ];

      if (isset($mInfo->api_version)) {
        $contents[] = ['text' => '<i class="fas fa-info-circle text-dark mr-2"></i><strong>' . TEXT_INFO_API_VERSION . '</strong> ' . $mInfo->api_version];
      }

      $contents[] = ['text' => $mInfo->description];
      $contents[] = ['text' => $keys];
    } elseif (isset($_GET['list']) && ($_GET['list'] == 'new')) {
      $contents = ['form' => new Form('install_module', $link->delete_parameter('list')->set_parameter('action', 'install'))];
      $contents[] = [
        'class' => 'text-center',
        'text' => new Button(IMAGE_MODULE_INSTALL, 'fas fa-plus', 'btn-warning'),
      ];

      if (isset($mInfo->api_version)) {
        $contents[] = ['text' => '<i class="fas fa-info-circle text-dark mr-2"></i><strong>' . TEXT_INFO_API_VERSION . '</strong> ' . $mInfo->api_version];
      }

      $contents[] = ['text' => $mInfo->description];
    }
  }
