<script>
    if (window.parent!=window)
    {
        window.parent.location.reload();
    }
    else
    {
        window.location.href = "<?=urlh(Zero_Registry::get('index_page'), 'User_Account', 'index')?>";
    }
</script>