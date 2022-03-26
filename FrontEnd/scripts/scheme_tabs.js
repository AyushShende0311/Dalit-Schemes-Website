var list = ["पाणी पुरवठा","शौचालय","पाण्‍याची टाकी","स्‍वच्‍छता योजना","वीज"]
var images = {
    "पाणी पुरवठा": ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
    "शौचालय": ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"],
    "पाण्‍याची टाकी": ["./Assets/images/scheme.png","./Assets/images/scheme.png"],
    "स्‍वच्‍छता योजना": ["./Assets/images/scheme.png"],
    "वीज": ["./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png","./Assets/images/scheme.png"]
}

function createFloater(list, images){
    var div = document.createElement("div")
    div.setAttribute("class","floater")
    var parent2 = createFloatingButtonsInfo(div)
    createFloatingButtons(div,list,images,parent2)
    div.appendChild(parent2)
    var floatingCard = document.querySelector(".floating-card")
    floatingCard.insertBefore(div,floatingCard.children[1])
}

function createFloatingButtons(parentDiv,list,images,parent2){
    var div = document.createElement("div")
    div.setAttribute("class","floating-buttons")
    createUl(div,list,images,parent2)
    parentDiv.appendChild(div)
}

function createFloatingButtonsInfo(){
    var div = document.createElement("div")
    div.setAttribute("class","floating-buttons-info")
    return div
}

function createUl(parentDiv, list,images,parent2){
    var ul = document.createElement("ul")
    ul.setAttribute("class", "nav nav-pills nav-stacked")
    var toggle_id = 0
    list.forEach(item=>{
        createLi(ul,toggle_id,item,parent2,images)
        toggle_id += 1
    })
    parentDiv.appendChild(ul)
}

function createLi(ul,toggle_id,item,parent2,images){
    var li = document.createElement("li")
    var a = document.createElement("a")
    var txt = document.createTextNode(item)
    a.appendChild(txt)
    a.setAttribute("data-toggle-id",toggle_id)
    a.setAttribute("data-toggle","tab")
    a.setAttribute("href","#"+item)
    li.appendChild(a)
    ul.appendChild(li)
    createFloatingTabsInfo(parent2,images[item])
}

function createFloatingTabsInfo(parentDiv,imagesList){
    var div = document.createElement("div")
    var div1 = document.createElement("div")
    div1.setAttribute("class","floating-buttons-info-images row")
    div.appendChild(div1)
    imagesList.forEach(image=>{
        createImage(div1,image)
    })
    parentDiv.appendChild(div)
    
}

function createImage(parentDiv,image){
    var div = document.createElement("div")
    var img = document.createElement("img")
    div.setAttribute("class","col-md-6")
    img.setAttribute("class","img-fluid")
    img.setAttribute("src",image)
    div.appendChild(img)
    parentDiv.appendChild(div)
}

createFloater(list,images)



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