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

select images.id, images.url,district.name as 'district_name',
taluka.name as 'taluka_name',
localarea.name as 'localarea_name',
schemes.name as 'scheme_name',
main.created_datetime,
main.updated_datetime,
main.created_by,
main.updated_by
from  
(
	(
		(
			(
				(main inner join images on main.id=images.main_id)
				inner join district on main.district_id=district.id
			)
			inner join taluka on main.taluka_id=taluka.id
		)
		inner join localarea on main.localarea_id=localarea.id
	)
	inner join schemes on main.schemes_id=schemes.id
);


-- get schmese for district
select distinct schemes.id,schemes.name , 
schemes.created_datetime, schemes.updated_datetime, schemes.created_by, schemes.updated_by
from ((main inner join schemes on main.schemes_id=schemes.id)
inner join district on main.district_id=1); --add district.id here at 1

-- get taluka name from district_id and scheme_id
select distinct taluka.id, main.district_id,taluka.name, 
schemes.created_datetime, schemes.updated_datetime, schemes.created_by, schemes.updated_by
from (((main inner join taluka on main.taluka_id=taluka.id)
inner join schemes on main.schemes_id=schemes.id)
inner join district on main.district_id=3) where main.schemes_id=1;