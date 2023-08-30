<?php
/*
 * Project-name: devqualimp
 * File-name: footer.php
 * Author: WU
 * Start-Date: 2023/7/18 10:18
 */
?>




<!-- SCRIPTS -->
<!-- Popper.js first, then Bootstrap JS -->

<script src="/asset/js/popper.min.js"></script>
<script src="/asset/js/bootstrap.min.js"></script>
<script src="/asset/js/bootstrap.bundle.min.js"></script>
<script src="/asset/editormd/editormd.min.js"></script>
<script src="/asset/js/moment.min.js"></script>
<script src="/asset/js/datetimepicker.min.js"></script>


<script src='/asset/js/index.js'></script>
<script src='/asset/js/detail.js'></script>
<script src='/asset/js/comment.js'></script>
<script>
    function toggleMenu() {
        var menuItems = document.getElementsByClassName('menu-item');
        for (var i = 0; i < menuItems.length; i++) {
            var menuItem = menuItems[i];
            menuItem.classList.toggle("hidden");
        }
    }
    const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
    const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))

</script>

<!-- -->
</body>
</html>
