var tabs = document.querySelectorAll("[data-toggle]");

tabs.forEach(tab => {
    tab.addEventListener("click", ()=>{
        var li = tab.parentNode
        resetTabs();
        li.className += " active"
        var index = tab.dataset.toggleId;
        var tabsInfo = document.querySelectorAll(".floating-buttons-info > div")
        hideAllTabsInfo(tabsInfo);
        
        tabsInfo[index].className += "active"
        

    })
});

var resetTabs = ()=>{
    tabs.forEach(tab => {
        var li = tab.parentNode
        li.className = " "
    })
}

var hideAllTabsInfo = (tabs_info)=>{
    tabs_info.forEach(tab_info => {
        tab_info.className = tab_info.className.replace("active", "");
    })
}

var removeClass = (elements , class_name)=>{
    elements.forEach(element => {
        element.className.replace("active", "");
    })
}
