<script>
document.addEventListener('DOMContentLoaded',()=>{
    const items=document.querySelectorAll('.carousel-item');
    const dots=document.querySelectorAll('.carousel-dot');
    let current=0;

    function show(i){
        items.forEach((el,idx)=>el.classList.toggle('active',idx===i));
        dots.forEach((el,idx)=>el.classList.toggle('bg-white',idx===i));
    }

    dots.forEach((dot,i)=>dot.addEventListener('click',()=>{current=i;show(i)}));
    setInterval(()=>{current=(current+1)%items.length;show(current)},5000);
});
</script>
