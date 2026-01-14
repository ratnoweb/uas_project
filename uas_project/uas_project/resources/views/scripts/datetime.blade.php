<script>
document.addEventListener('DOMContentLoaded',function(){
    function updateDateTime(){
        const now=new Date();
        document.getElementById('current-date').textContent=
        now.toLocaleDateString('id-ID',{weekday:'long',year:'numeric',month:'long',day:'numeric',hour:'2-digit',minute:'2-digit'});
    }
    updateDateTime();
    setInterval(updateDateTime,60000);
});
</script>
