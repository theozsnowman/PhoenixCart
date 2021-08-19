<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  $products_id = Text::input($_POST['products_id']);
  $specials_price = Text::input($_POST['specials_price']);

  if (substr($specials_price, -1) === '%') {
    $specials_price = substr($specials_price, 0, -1);

    $products_price = $db->query(sprintf(<<<'EOSQL'
SELECT products_price FROM products WHERE products_id = %d
EOSQL
      , (int)$products_id))->fetch_assoc()['products_price'];
    $specials_price = ($products_price - (($specials_price / 100) * $products_price));
  }

  $expires_date = Text::input($_POST['expdate']);
  if (Text::is_empty($expires_date)) {
    $expires_date = 'NULL';
  } else {
    $expires_date = substr($expires_date, 0, 4) . substr($expires_date, 5, 2) . substr($expires_date, 8, 2);
  }

  $db->perform('specials', [
    'products_id' => (int)$products_id,
    'specials_new_products_price' => $specials_price,
    'specials_date_added' => 'NOW()',
    'expires_date' => $expires_date,
    'status' => 1,
  ]);

  return $Admin->link('specials.php')->retain_parameters(['action'])->set_parameter('sID', mysqli_insert_id($db));
