function init(){
    var url = "http://localhost:8000/BackEnd/DistrictWiseSchemes/main_api.php";
    get(url).then(data=>{
        var url = new URL(window.location.href);
        var dname = url.searchParams.get("dn");
        var sname = url.searchParams.get("sn");
        var tname = url.searchParams.get("tn");
        setDistrictName(dname);
        createCarousel(data['data'][dname][sname][tname]);
    });
}

function setDistrictName(dname){
    var h2 = document.querySelector(".dname h5");
    h2.innerHTML = dname;
}

async function get(url){
    var response = await fetch(url);
    var data = await response.json();
    return data;
}

function createCarousel(images){
    images.forEach(image => {
        createCarouselItem(image);
    });

    setCarouselItemActive();
}


function createCarouselItem(image){
    var target = document.querySelector(".carousel-inner");
    var div = document.createElement("div");
    div.setAttribute("class", "carousel-item");
    var img = document.createElement("img");
    img.setAttribute("class","d-block w-100");
    img.setAttribute("alt", "img");
    img.setAttribute("src",image);
    div.appendChild(img);
    target.appendChild(div);
}

function setCarouselItemActive(){
    var target = document.querySelector(".carousel-inner > div:first-child");
    target.classList.add("active");
    
}

init();