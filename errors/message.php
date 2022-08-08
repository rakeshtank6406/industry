
<?php
session_start();
if(isset($_SESSION['message']))
{
  ?>
  <h4 class="text-center"><?php echo "<script>alert('".$_SESSION['message']."')</script>"; ?></h4>

  <?php
  unset($_SESSION['message']);
}

?>
