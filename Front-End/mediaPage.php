<script>
    const getMediaById = (id) => {
         fetch(`../back-end/media/getMediaById.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }

    const updateMedia = () => {
        fetch("../back-end/media/updateMedia.php", {
            body: new URLSearchParams(new FormData(document.getElementById("updateMediaForm"))).toString(),
            headers: {
                 "Content-Type": "application/x-www-form-urlencoded",
            },
            method: "post"
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }
</script>