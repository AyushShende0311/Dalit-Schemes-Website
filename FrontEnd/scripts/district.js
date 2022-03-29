var districts = ["औरंगाबाद","नांदेड","परभणी","लातूर"];
var talukas = {
    "औरंगाबाद" : {
        "t1":["a1","a2"],
        "t2":["a1","a2"]
    },
    "नांदेड":{
        "t1":["a1","a2"],
    },
    "परभणी":{
        "t1":["a1","a2"],
    },
    "लातूर":{
        "t1":["a1","a2"],
    }
};

(()=>{
    var form = document.createElement("form")
    form.setAttribute("id","frmSelectDistrict")
    var select = document.createElement("select")
    select.setAttribute('id',"sel-district")
    select.setAttribute("class","form-control")
    var value = 0

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

})()

function handler(talukas) {
    var select = document.querySelector("#sel-district")
    select.addEventListener("change",()=>{
        var distAreas = document.querySelector("#distAreas")
        
        // set Visibity to visible

        distAreas.style.display = "block"

        var distAreasDiv = document.querySelector("#distAreas > .text-center")
        
        // removed all elements

        distAreasDiv.innerHTML = ''
        
        // selected dropdown value

        var selectedDistrict = select.options[select.selectedIndex].text
        
        // created title

        var p = document.createElement("p")
        p.setAttribute("style","font-weight:600")
        var txt1 = document.createTextNode("Covered \"Nivadak Dalit Vasti Sudhaar\" areas in ")
        p.append(txt1)
        var span = document.createElement("span")
        span.setAttribute("id","disName")
        span.innerHTML = selectedDistrict
        p.appendChild(span)
        var txt2 = document.createTextNode(" district are -  ")
        p.appendChild(txt2)
        distAreasDiv.appendChild(p)

        //for each taluka
        for(var taluka in talukas[selectedDistrict]){
            //for each area in taluka
            talukas[selectedDistrict][taluka].forEach(area=>{
                createP(distAreasDiv,taluka,area)
            })
        }     
    })
}

function createP(parent,taluka, area){
    var p = document.createElement("p")
    var a = document.createElement("a")
    a.setAttribute('style','color:#444444')
    a.innerHTML = taluka + " - " + area
    p.appendChild(a)
    parent.appendChild(p)
}

handler(talukas)