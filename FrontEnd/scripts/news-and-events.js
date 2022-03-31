function init(){
    var url = "http://localhost:8000/BackEnd/Districts/Districts_api.php"
    get(url).then(data=>{
        createDropDown(data['data']);
    });

    url = "http://localhost:8000/BackEnd/Events/Event_api.php";
    get(url).then(data=>{
        console.log(data['data']);
        handler(data['data']);
    });
}

async function get(url){
    var response = await fetch(url);
    var data = await response.json();
    return data;
}

var createDropDown = (districts) => {
    var form = document.createElement("form")
    form.setAttribute("id","frmSelectDistrict")
    var select = document.createElement("select")
    select.setAttribute("id","selDistrict")
    select.setAttribute("class","form-control my-form-control")
    var value = 0

    var option = document.createElement("option")
    option.innerHTML = "-- Select District --";
    option.disabled = true;
    option.selected = true;
    select.appendChild(option);

    districts.forEach(district=>{
        var option = document.createElement("option")
        option.setAttribute("value",value)
        var txt = document.createTextNode(district)
        option.appendChild(txt)
        select.appendChild(option)
        value += 1
    })
    
    form.appendChild(select)
    var dropdown_wrapper = document.querySelector(".dropdown-wrapper")
    dropdown_wrapper.insertBefore(form,dropdown_wrapper.children[2])    
}

function handler(updates){
    var select = document.querySelector("#selDistrict")
    select.addEventListener("change",()=>{
        var distAreas = document.querySelector("#distAreas")
        // set Visibity to visible
        distAreas.style.display = "block"
        var distAreasDiv = document.querySelector("#distAreas > .text-center")    
        // removed all elements
        distAreasDiv.innerHTML = ''
        // selected dropdown value
        var selectedDistrict = select.options[select.selectedIndex].text

        updates[selectedDistrict].forEach(update=>{
            createPara(distAreasDiv,update['detail'],update['title'])
        })
    })
}

function createPara(parentDiv,detail,title){
    var div = document.createElement("div")
    var h1 = document.createElement("h1")
    var p = document.createElement("p")
    p.setAttribute("style","word-wrap:break-word")
    h1.innerHTML = title
    p.innerHTML = detail

    div.appendChild(h1)
    div.appendChild(p)
    parentDiv.appendChild(div)
}

init();
