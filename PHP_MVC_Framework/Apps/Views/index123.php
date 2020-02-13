<!DOCTYPE html>
<html >
    <head></head>
    <body>
        <!-- <em>Use</em> of View file
        1 &lt 2 -->
        <?php echo htmlspecialchars($name); ?>
        <?php foreach($colors as $color):?>
        <li><?php echo htmlspecialchars($color); ?> </li>
        <?php endforeach; ?>
    </body>
</html>