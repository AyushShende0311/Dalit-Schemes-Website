var stylesheetPath = "./stylesheets/";
var scriptPath = "./scripts/";

function setAttributes(el, attrs) {
    for(var key in attrs) {
      el.setAttribute(key, attrs[key]);
    }
}
(()=>{ 
    addCss(document.head, "main.css")
    addCss(document.head, "common.css")
    addCss(document.head, "header.css")
    addCss(document.head, "footer.css")
    addCss(document.head, "back-to-top.css")

    addScript(document.body,"header.js")
    addScript(document.body,"footer.js")
    addScript(document.body,"back-to-top.js")
    addScript(document.body,"languageHandler.js")

})()

function addCss(parent, fileName){
    var link = document.createElement("link")
    setAttributes(link,{"rel": "stylesheet", "href" : stylesheetPath+fileName})
    parent.appendChild(link) 
}

function addScript(parent,fileName){
    var script = document.createElement("script")
    script.setAttribute("src",scriptPath+fileName)
    parent.appendChild(script)
}