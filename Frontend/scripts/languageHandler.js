(()=>{
    onLanguageChange();
    var option;
    var url;
    var language;
    if(localStorage.getItem("lang")){  
        language = localStorage.getItem("lang");
    }else{
        language = 'en';
    }
    url = "./scripts/languages/"+language+".json";
    option = document.querySelector(".language-selector option[value='" + language + "']");
    if(option){
        option.setAttribute("selected","true");
    }

    get(url).then(lang=>{
        setData(lang);
    })
})()


async function get(url){
    var response = await fetch(url);
    var data = await response.json();
    return data;
}

function setData(lang){

    // nav
    document.querySelector("#nav-title").innerHTML = lang.TITLE;
    document.querySelector("#nav-helpline").innerHTML = lang.HELPLINE;
    document.querySelector("#language").innerHTML = lang.LANGUAGE +" : ";
    document.querySelector("#home").innerHTML = lang.HOME.toUpperCase();
    document.querySelector("#about_us").innerHTML = lang.ABOUTUS.toUpperCase();
    document.querySelector("#schemes").innerHTML = lang.SCHEMES.toUpperCase();
    document.querySelector("#district_wise_covered_areas").innerHTML = lang.DISTRICTWISECOVEREDAREAS.toUpperCase();
    document.querySelector("#news_and_updates").innerHTML = lang.NEWSANDEVENTS.toUpperCase();
}

function onLanguageChange(){
    var selector = document.querySelector(".language-selector select");
    if(selector){
        selector.addEventListener("change", ()=>{
            var selectedLang = selector.options[selector.selectedIndex].value;
            localStorage.setItem("lang",selectedLang);
            location.reload();
        })
    }
}
