<script>
    if (window.opener)
    {
        window.opener.location.href = window.opener.SYS.URL.user.order_index.replace('json', 'e');
    }
    else
    {
        alert("<?php echo $this->msg; ?>!");
        history.go(-1);
    }
</script>