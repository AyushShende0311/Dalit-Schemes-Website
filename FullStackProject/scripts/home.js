(()=>{
    var list = ["पाणी पुरवठा","शौचालय","नळ जोडणी","समाज मंदिर","समाज मंदिर","पाणी पुरवठा","शौचालय","नळ जोडणी","समाज मंदिर"]
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

})()

function createLi(ul,id,txt){
    var li = document.createElement("li")
    li.setAttribute("class","main-lower-checkbox")
    createInput(li,id)
    createLabel(li,id,txt)
    ul.appendChild(li)
}

function createInput(li,id){
    var input = document.createElement("input")
    input.setAttribute("type","checkbox")
    input.setAttribute("id",id)
    li.appendChild(input)
}

function createLabel(li,id,txt){
    var label = document.createElement("label")
    label.setAttribute("for",id)
    var txt = document.createTextNode(txt)
    label.appendChild(txt)
    li.appendChild(label)
}
