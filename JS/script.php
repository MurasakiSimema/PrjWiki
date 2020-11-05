<script>
function lista(idlist, idbar) {
    var list = document.getElementById(idlist);
    var barval = document.getElementById(idbar).value;
    inner = <?php
    require 'PHP/MySQL.php';
    echo FindPage($_POST["search"]); ?>;

    list.innerHTML = inner;
}
</script>