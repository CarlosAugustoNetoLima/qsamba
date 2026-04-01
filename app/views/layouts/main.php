<!DOCTYPE html>
<html lang="<?= htmlspecialchars($locale) ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= __('meta.title') ?></title>
  <meta name="description" content="<?= __('meta.description') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>

  <!-- Custom Cursor -->
  <div class="cursor" id="cursor"></div>
  <div class="cursor-trail" id="cursorTrail"></div>

  <?php echo $content; ?>

  <script src="/public/js/app.js"></script>
</body>

</html>
