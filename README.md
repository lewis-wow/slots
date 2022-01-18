# slots
Create slots for PHP layout

## create slot (layout)
```
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $slots->slot("head"); ?>
      <title>Default title</title>
    <?php $slots->endSlot(); ?>
</head>

<!-- body slot -->
<body>
  <?php $slots->slot("body"); ?>
</body>

</html>

```
## create slot (template)
```
<?php $slots->open("head"); ?>
      <title>My title</title>
<?php $slots->close(); ?>

<?php $slots->open("body"); ?>
    <h1>My heading</h1>
<?php $slots->close(); ?>

</html>
```

### include
For including slots from template to layout, you need to require/once or include/once the template page in layout page and use Slots class to create Slots instance.
