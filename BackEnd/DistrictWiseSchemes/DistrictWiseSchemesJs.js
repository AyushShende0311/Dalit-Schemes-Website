function getTalukas(){
    var district_selector = document.getElementById("district");
    var district_id = district_selector.options[district_selector.selectedIndex].value;
    var url = "http://localhost:8000/BackEnd/Taluka/taluka_api.php" + "?district_id=" + district_id; 
    get(url).then(data=>{
        districts = data['data'];
        var taluka_selector = document.getElementById("taluka");
        var area_selector = document.getElementById("area");    
        taluka_selector.innerHTML='';
        area_selector.innerHTML='';

        var option = document.createElement("option");
        option.innerHTML = "-- Select --";
        option.selected = true;
        option.disabled = true;
        var option1= document.createElement("option");
        option1.innerHTML = "-- Select --";
        option1.selected = true;
        option1.disabled = true;
        taluka_selector.appendChild(option);
        area_selector.appendChild(option1);

        Object.keys(districts).forEach(key=>{
             option = document.createElement("option");
             option.setAttribute("value", key);
             option.innerHTML = districts[key];
             taluka_selector.appendChild(option);
        });
    });
}

function getLocalAreas(){
    var taluka_selector = document.getElementById("taluka");
    var taluka_Id = taluka_selector.options[taluka_selector.selectedIndex].value;
    var url = "http://localhost:8000/BackEnd/LocalAreas/LocalAreas_api.php" + "?taluka_id=" + taluka_Id; 
    get(url).then(data=>{
        talukas = data['data'];
        var area_selector = document.getElementById("area");  
        area_selector.innerHTML='';

        var option = document.createElement("option");
        option.innerHTML = "-- Select Area --";
        option.selected = true;
        option.disabled = true;
        area_selector.appendChild(option);
        
        Object.keys(talukas).forEach(key=>{
             option = document.createElement("option");
             option.setAttribute("value", key);
             option.innerHTML = talukas[key];
             area_selector.appendChild(option);
        });
    });
}

function getLocalAreas_update(selectedLocalAreaId,taluka_id){
    var url = "http://localhost:8000/BackEnd/LocalAreas/LocalAreas_api.php" + "?taluka_id=" + taluka_id; 
    get(url).then(data=>{
        talukas = data['data'];
        var area_selector = document.getElementById("area");  
        Object.keys(talukas).forEach(key=>{
             option = document.createElement("option");
             option.setAttribute("value", key);
             option.innerHTML = talukas[key];
             if(parseInt(key) === selectedLocalAreaId){
                option.selected = true;
            }
             area_selector.appendChild(option);
        });
    });
}

function getTalukas_update(selecteedTalukaId){
    var district_selector = document.getElementById("district");
    var district_id = district_selector.options[district_selector.selectedIndex].value;
    var url = "http://localhost:8000/BackEnd/Taluka/taluka_api.php" + "?district_id=" + district_id; 
    get(url).then(data=>{
        districts = data['data'];
        var taluka_selector = document.getElementById("taluka");

        Object.keys(districts).forEach(key=>{
             option = document.createElement("option");
             option.setAttribute("value", key);
             option.innerHTML = districts[key];
             if(parseInt(key) === selecteedTalukaId){
                 option.selected = true;
             }
             taluka_selector.appendChild(option);
        });
    });
}

async function get(url){
    var response = await fetch(url);
    var data = await response.json();
    return data;
}

