
(()=>{
    var districts = ["औरंगाबाद","नांदेड","परभणी","लातूर"]
    var form = document.createElement("form")
    form.setAttribute("id","frmSelectDistrict")
    var select = document.createElement("select")
    select.setAttribute('id',"selDistrict")
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


