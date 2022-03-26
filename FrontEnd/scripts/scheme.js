var tabs = document.querySelectorAll("[data-toggle]");

tabs.forEach(tab => {
    tab.addEventListener("click", ()=>{
        var li = tab.parentNode
        resetTabs();
        li.classList.add("active")
        var index = tab.dataset.toggleId;
        var tabsInfo = document.querySelectorAll(".floating-buttons-info > div")
        hideAllTabsInfo(tabsInfo);
        
        tabsInfo[index].classList.add("active")
        

    })
});

var resetTabs = ()=>{
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

(()=>{
    var li =document.querySelector(".nav > li:first-child")
    var div = document.querySelector(".floating-buttons-info > div:first-child")
    li.classList.remove("active")
    li.classList.add("active")
    div.classList.remove("active")
    div.classList.add("active")

})()

