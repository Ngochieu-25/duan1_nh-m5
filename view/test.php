<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<body>
  <div id="click_me" style="cursor: pointer;">
    Click Me !
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $("#click_me").on("click", function() {
    $(".loader").show();
    console.log("Đang test Jquery");
  });
</script>

</html>