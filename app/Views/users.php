<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>List =User</title>
  </head>
  <body>
<h1>Daftar User</h1>
<?php foreach ($data['users'] as $user): ?>
  <p>
    <?php echo $user['username']; ?>
   </p>
<?php endforeach; ?>
</body>
</html>
