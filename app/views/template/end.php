</div>
<?php require APP_ROOT . '/views/template/components/footer.php'; ?>
<!-- jQuery -->
<script src="/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.min.js"></script>
<!-- Bootstrap File input -->
<script src="/js/fileinput.min.js"></script>
<!-- Bootstrap File input -->
<script src="/js/theme.min.js"></script>

<script>
  $("#arquivo").fileinput({'theme':'fa'});
</script>

</body>
</html>
