<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class cm_pi_modular extends abstract_executable_module {

    const CONFIG_KEY_BASE = 'MODULE_CONTENT_PI_MODULAR_';

    public function __construct() {
      parent::__construct(__FILE__);
    }

    public function execute() {
      $slots = [
        'a' => (int)$this->base_constant('A_WIDTH'),
        'b' => (int)$this->base_constant('B_WIDTH'),
        'c' => (int)$this->base_constant('C_WIDTH'),
        'd' => (int)$this->base_constant('D_WIDTH'),
        'e' => (int)$this->base_constant('E_WIDTH'),
        'f' => (int)$this->base_constant('F_WIDTH'),
        'g' => (int)$this->base_constant('G_WIDTH'),
        'h' => (int)$this->base_constant('H_WIDTH'),
        'i' => (int)$this->base_constant('I_WIDTH'),
      ];

      if ( defined('MODULE_CONTENT_PI_INSTALLED') && !Text::is_empty(MODULE_CONTENT_PI_INSTALLED) ) {
        $pi_modules = array_filter(array_map(function ($pim) {
          $class = pathinfo($pim, PATHINFO_FILENAME);

          return new $class();
        }, explode(';', MODULE_CONTENT_PI_INSTALLED)), function ($p_i) {
          return $p_i->isEnabled();
        });

        if ( count($pi_modules) > 0 ) {
          array_walk($pi_modules, function ($v, $unused) { $v->getOutput(); });

          $tpl_data = [ 'group' => $this->group, 'file' => __FILE__ ];
          include 'includes/modules/content/cm_template.php';
        }
      }
    }

    protected function get_parameters() {
      return [
        'MODULE_CONTENT_PI_MODULAR_STATUS' => [
          'title' => 'Enable &pi; Modular product_info',
          'value' => 'True',
          'desc' => 'Should this module be shown on the product info page?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_CONTENT_WIDTH' => [
          'title' => 'Content Width',
          'value' => '12',
          'desc' => 'What width container should the content be shown in?',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_A_WIDTH' => [
          'title' => 'Slot Width: A',
          'value' => '12',
          'desc' => 'What width should Slot A be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_B_WIDTH' => [
          'title' => 'Slot Width: B',
          'value' => '6',
          'desc' => 'What width should Slot B be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_C_WIDTH' => [
          'title' => 'Slot Width: C',
          'value' => '6',
          'desc' => 'What width should Slot C be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_D_WIDTH' => [
          'title' => 'Slot Width: D',
          'value' => '4',
          'desc' => 'What width should Slot D be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_E_WIDTH' => [
          'title' => 'Slot Width: E',
          'value' => '4',
          'desc' => 'What width should Slot E be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_F_WIDTH' => [
          'title' => 'Slot Width: F',
          'value' => '4',
          'desc' => 'What width should Slot F be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_G_WIDTH' => [
          'title' => 'Slot Width: G',
          'value' => '6',
          'desc' => 'What width should Slot G be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_H_WIDTH' => [
          'title' => 'Slot Width: H',
          'value' => '6',
          'desc' => 'What width should Slot H be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_I_WIDTH' => [
          'title' => 'Slot Width: I',
          'value' => '12',
          'desc' => 'What width should Slot I be?  Note that Slots in a Row should totalise 12.',
          'set_func' => "Config::select_one(['12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'], ",
        ],
        'MODULE_CONTENT_PI_MODULAR_SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '59',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
      ];
    }

    public static function display_layout() {
      if ( !defined('MODULE_CONTENT_PI_MODULAR_STATUS') ) {
        return null;
      }

      $slots = [
        'A' => ['width' => MODULE_CONTENT_PI_MODULAR_A_WIDTH, 'color' => '96858f'],
        'B' => ['width' => MODULE_CONTENT_PI_MODULAR_B_WIDTH, 'color' => '6d7993'],
        'C' => ['width' => MODULE_CONTENT_PI_MODULAR_C_WIDTH, 'color' => '9099a2'],
        'D' => ['width' => MODULE_CONTENT_PI_MODULAR_D_WIDTH, 'color' => 'd5d5d5'],
        'E' => ['width' => MODULE_CONTENT_PI_MODULAR_E_WIDTH, 'color' => '96858f'],
        'F' => ['width' => MODULE_CONTENT_PI_MODULAR_F_WIDTH, 'color' => '6d7993'],
        'G' => ['width' => MODULE_CONTENT_PI_MODULAR_G_WIDTH, 'color' => '9099a2'],
        'H' => ['width' => MODULE_CONTENT_PI_MODULAR_H_WIDTH, 'color' => 'd5d5d5'],
        'I' => ['width' => MODULE_CONTENT_PI_MODULAR_I_WIDTH, 'color' => '96858f'],
      ];

      $row_width = 0;
      $layout = '';
      foreach ($slots as $k => $slot) {
        $layout .= '<span style="color: white; font-weight: bold; font-size: 20px; background: #' . $slot['color'] . '; font-family: courier;">' . $k . str_repeat('&nbsp;', $slot['width']-1) . '</span>';

        $row_width += $slot['width'];
        if ($row_width >= 12) {
          $layout .= '<br>';
          $row_width = 0;
        }
      }

      return $layout;
    }

  }
