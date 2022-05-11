<script>
    const getCategories = () => {
        fetch("../back-end/category/getCategories.php")
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }
</script>