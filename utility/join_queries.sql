-- Taluka Query:
select taluka.id, taluka.name , district.name as 'district_name',taluka.district_id , taluka.created_by, taluka.updated_by, 
taluka.created_datetime, taluka.updated_datetime
from taluka inner join district where taluka.district_id=district.id
order by taluka.id;


-- LOCALAREA Query:
select localarea.id, localarea.name, taluka.name as 'taluka_name',localarea.taluka_id , localarea.created_by, localarea.updated_by, 
localarea.created_datetime, localarea.updated_datetime
from localarea inner join taluka on localarea.taluka_id=taluka.id
order by localarea.id;



-- MAIN Query:
select main.id, main.district_id, district.name as 'DISTRICT', 
main.taluka_id, taluka.name as 'TALUKA',
main.localarea_id, localarea.name as 'LOCAL_AREA',
main.schemes_id, schemes.name as 'SCHEMES', 
main.created_datetime, main.updated_datetime, main.created_by, main.updated_by 
from main 
inner join district on main.district_id=district.id 
inner join taluka on main.taluka_id=taluka.id
inner join schemes on main.schemes_id=schemes.id
inner join localarea on main.localarea_id=localarea.id
order by main.id;


-- IMAGES Query:
select images.id,
                images.url, 
                district.name as 'district_name' ,
                taluka.name as 'taluka_name',
                localarea.name as 'localarea_name', 
                schemes.name as 'scheme_name',
                images.created_datetime, 
                images.updated_datetime,
                images.created_by,
                images.updated_by 
                from images inner join main on images.main_id=main.id
                inner join district on images.main_id=district.id
                inner join taluka on images.main_id=taluka.id
                inner join localarea on images.main_id=localarea.id
                inner join schemes on images.main_id=schemes.id;