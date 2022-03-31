async function get(url){
    let response = await fetch(url);
    let data = await response.json();
    return  data;
}

function init(){
    var url ="http://localhost:8000/BackEnd/Schemes/Schemes_api.php";
    get(url).then(data=> createCheckBox(data['data']));
}


var createCheckBox = (list)=>{
    var form = document.createElement("form")
    form.setAttribute("class","main-lower-form")
    var ul = document.createElement("ul")
    ul.setAttribute("class","p-0")
    var value = 1
    
    list.forEach(scheme=>{
        createLi(ul,"chbox"+value,scheme)
        value += 1
    })
    form.appendChild(ul)
    var a = document.querySelector(".main-lower-checkboxes")
    a.appendChild(form)
}

function createLi(ul,id,txt){
    var li = document.createElement("li")
    li.setAttribute("class","main-lower-checkbox")
    createLiInnerContainer(li,id,txt)
    ul.appendChild(li)
}

function createLiInnerContainer(li,id,txt){
    var div=document.createElement('div')
    createInput(div,id)
    createLabel(div,id,txt)
    li.appendChild(div)
}

function createInput(parentDiv,id){
    var input = document.createElement("input")
    input.setAttribute("type","checkbox")
    input.setAttribute("id",id)
    parentDiv.appendChild(input)
}

function createLabel(parentDiv,id,txt){
    var label = document.createElement("label")
    label.setAttribute("for",id)
    var txt = document.createTextNode(txt)
    label.appendChild(txt)
    parentDiv.appendChild(label)
}

init();