(()=>{
    var option;
    var url;
    if(language = localStorage.getItem("lang")){  
        url = "./scripts/languages/"+language+".json";
        option = document.querySelector(".language-selector option[value='" + language + "']");

    }else{
        url = "./scripts/languages/en.json";
        option = document.querySelector(".language-selector option[value='en']");
    }
    option.setAttribute("selected","true");
    onLanguageChange();

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
    selector.addEventListener("change", ()=>{
        var selectedLang = selector.options[selector.selectedIndex].value;
        localStorage.setItem("lang",selectedLang);
        location.reload();
    })
}
