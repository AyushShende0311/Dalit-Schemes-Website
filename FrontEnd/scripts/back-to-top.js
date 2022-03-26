(()=>{
    var topBtn = document.createElement("a")
    topBtn.setAttribute("class","to-top")
    topBtn.innerHTML = "^"
    topBtn.addEventListener("click",()=>{
        document.documentElement.scrollTop = 0
        document.body.scrollTop = 0
    })
    var target = document.querySelector("body")
    target.appendChild(topBtn)
})()


const toTop = document.querySelector(".to-top");
window.addEventListener("scroll", ()=>{
    if(window.pageYOffset >150){
        toTop.classList.add('arrow-active');
    }
    else{
        toTop.classList.remove('arrow-active');
    }
})


