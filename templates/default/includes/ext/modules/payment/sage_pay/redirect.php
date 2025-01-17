<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?= HTML_PARAMS ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?= CHARSET ?>">
<title><?= TITLE ?></title>
<base href="<?= HTTP_SERVER . DIR_WS_CATALOG ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<?= $form ?>
<noscript>
  <p align="center" class="main">The transaction is being finalized. Please click continue to finalize your order.</p>
  <p align="center" class="main"><input type="submit" value="Continue" /></p>
</noscript>
</form>
<script>
document.redirect.submit();
</script>
</body>
</html>
