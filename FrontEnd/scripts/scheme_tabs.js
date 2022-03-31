
var district_name = "";
var scheme_name = "";
var taluka_name = "";



function init(){
    var url = "http://localhost:8000/BackEnd/Districts/Districts_api.php"
    get(url).then(data=>{
        createDropDown(data['data']);
    });

    url = "http://localhost:8000/BackEnd/DistrictWiseSchemes/main_api.php";
    get(url).then(data=>{
        handler(data['data']);
    });
}


async function get(url){
    var response = await fetch(url);
    var data = await response.json();
    return data;
}

// var districts = ["pune" , "nashik", "mumbai"];
// var mainData = {
//     "pune" : {
//         "पाणी पुरवठा": {
//             "t1" : ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//             "shirur" : ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//             "haveli" :["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//         },
//         "शौचालय": {
//             "shirur1" : ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//             "haveli1" :["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//         }
//     },

//     "nashik" : {
//         "पाण्‍याची टाकी": {
//             "shirur" : ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//             "haveli" :["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//         },
//         "वीज": {
//             "shirur" : ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//             "haveli" :["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
//         }
//     }
// }

function createFloater(DistrictSchemes){
    var div = document.createElement("div")
    div.setAttribute("class","floater")
    var parent2 = createFloatingButtonsInfo(div)
    createFloatingButtons(div,DistrictSchemes,parent2)
    div.appendChild(parent2)
    var floatingCard = document.querySelector(".floating-card")
    floatingCard.insertBefore(div,floatingCard.children[1])
}

function createFloatingButtons(parentDiv,DistrictSchemes,parent2){
    var div = document.createElement("div")
    div.setAttribute("class","floating-buttons")
    createUl(div,DistrictSchemes,parent2)
    parentDiv.appendChild(div)
}

function createFloatingButtonsInfo(){
    var div = document.createElement("div")
    div.setAttribute("class","floating-buttons-info")
    return div
}

function createUl(parentDiv,DistrictSchemes,parent2){
    var ul = document.createElement("ul")
    ul.setAttribute("class", "nav nav-pills nav-stacked")
    var toggle_id = 0
    Object.keys(DistrictSchemes).forEach(scheme=>{
        createLi(ul,toggle_id,scheme,parent2,DistrictSchemes[scheme])
        toggle_id += 1
    })
    parentDiv.appendChild(ul)
}

function createLi(ul,toggle_id,scheme,parent2,talukas){
    var li = document.createElement("li")
    var a = document.createElement("a")
    var txt = document.createTextNode(scheme)
    a.appendChild(txt)
    a.setAttribute("data-toggle-id",toggle_id)
    a.setAttribute("data-toggle","tab")
    a.setAttribute("href","#"+scheme)
    li.appendChild(a)
    ul.appendChild(li)
    createFloatingTabsInfo(parent2,talukas,scheme)
}

function createFloatingTabsInfo(parentDiv,talukas,scheme){
    var div = document.createElement("div")
    var div1 = document.createElement("div")
    div1.setAttribute("class","floating-buttons-info-images row")
    div.appendChild(div1)
    Object.keys(talukas).forEach(taluka=>{
        createImage(div1,talukas[taluka][0],scheme ,taluka)
    })
    parentDiv.appendChild(div) 
}

function createImage(parentDiv,image,scheme, taluka){
    var div = document.createElement("div")
    var a = document.createElement("a");
    var url = "./detail.html" + "?" + "dn=" + district_name + "&" + "sn=" + scheme +"&"+ "tn="+taluka;
    a.setAttribute("href", url)
    var img = document.createElement("img")
    div.setAttribute("class","col-md-6")
    img.setAttribute("class","img-fluid")
    img.setAttribute("src",image)
    var div2 = document.createElement("div")
    var div3 = document.createElement("div")
    div3.setAttribute("class","overlaysymbol")
    var img2 = document.createElement("img")
    img2.setAttribute("src", "./Assets/logo/search.png")
    img2.setAttribute("class", "img-fluid")
    img2.setAttribute("style", "width:10%;height:10%")
    // var p = document.createElement("p")
    // p.innerHTML = "+";
    div3.appendChild(img2)
    div2.appendChild(div3)
    div2.appendChild(img)
    a.appendChild(div2)
    div.appendChild(a)
    parentDiv.appendChild(div)
}

var createDropDown = (districts)=>{
    var form = document.createElement("form")
    form.setAttribute("id","frmSelectDistrict")
    var select = document.createElement("select")
    select.setAttribute('id',"sel-district")
    select.setAttribute("class","form-control my-form-control")
    var value = 0
    
    var option = document.createElement("option")
    option.innerHTML = "-- Select District --";
    option.disabled = true;
    option.selected = true;
    select.appendChild(option);

    districts.forEach(district=>{
        var option = document.createElement("option")
        var txt = document.createTextNode(district)
        option.appendChild(txt)
        option.setAttribute("value",value)
        select.appendChild(option)
        value += 1
    })    
    form.appendChild(select)
    var dropdown_wrapper = document.querySelector(".dropdown-wrapper")
    dropdown_wrapper.insertBefore(form,dropdown_wrapper.children[2])

}

function handler(mainData) {
    var select = document.querySelector("#sel-district")
    select.addEventListener("change",()=>{
        // selected dropdown value
        var selectedDistrict = select.options[select.selectedIndex].text  
        district_name = selectedDistrict
        var floater;
        if(floater = document.querySelector(".floater")){
            floater.remove();
        }
        createFloater(mainData[selectedDistrict])
        tabHabdler();
        handleTabClick();
    })
}





function handleTabClick(){
    var tabs = document.querySelectorAll("[data-toggle]");

    tabs.forEach(tab => {
        tab.addEventListener("click", ()=>{
            var li = tab.parentNode
            resetTabs(tabs);
            li.classList.add("active")
            var index = tab.dataset.toggleId;
            var tabsInfo = document.querySelectorAll(".floating-buttons-info > div")
            hideAllTabsInfo(tabsInfo);        
            tabsInfo[index].classList.add("active")
        })
    });
}


var resetTabs = (tabs)=>{
    tabs.forEach(tab => {
        var li = tab.parentNode
        li.classList.remove("active")
    })
}

var hideAllTabsInfo = (tabs_info)=>{
    tabs_info.forEach(tab_info => {
        tab_info.classList.remove("active")
    })
}

function tabHabdler(){
    var li =document.querySelector(".nav > li:first-child")
    var div = document.querySelector(".floating-buttons-info > div:first-child")
    li.classList.remove("active")
    li.classList.add("active")
    div.classList.remove("active")
    div.classList.add("active")
}



init();


// <!-- <div class="floater">
// <div class="floating-buttons">
//     <ul class="nav nav-pills nav-stacked">
//         <li class="active"><a data-toggle-id="0" data-toggle="tab" href="#paani-puravatha">पाणी पुरवठा</a></li>
//         <li><a data-toggle-id="1" data-toggle="tab" href="#shouchalay">शौचालय</a></li>
//         <li><a data-toggle-id="2" data-toggle="tab" href="#nal-jodani">नळ जोडणी</a></li>
//         <li><a data-toggle-id="3" data-toggle="tab" href="#panyachi-taaki">पाण्‍याची टाकी</a></li>
//         <li><a data-toggle-id="4" data-toggle="tab" href="#swachhata-yojana">स्‍वच्‍छता योजना</a></li>
//         <li><a data-toggle-id="5" data-toggle="tab" href="#raste">रस्ते</a></li>
//         <li><a data-toggle-id="6" data-toggle="tab" href="#veej">वीज</a></li>
//         <li><a data-toggle-id="7" data-toggle="tab" href="#kaushlya-vikas">कौशल्यविकास</a></li>
//         <li><a data-toggle-id="8" data-toggle="tab" href="#samaaj-mandir">समाज मंदिर</a></li>
//     </ul>
// </div>
// <div class="floating-buttons-info">
//     <div class="active">
//         <div class="floating-buttons-info-images row">
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img  class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img  class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img  class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
//             <div class="col-md-6">
//                 <img class="img-fluid" src="./Assets/images/scheme.png">
//             </div>
            
//         </div>
//     </div>
// </div>
// </div>