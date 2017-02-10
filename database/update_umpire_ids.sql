#I accidentally left umpire_id out of the PitchesSeeder :/
#This sql should fix that problem
#If you are starting this project over, you should not need this script, because the omission was corrected.

insert into umpires (mlb_id, name)
select distinct umpire_id, umpire from raw_data where umpire_id not in (select mlb_id from umpires);


update pitches p
inner join (select u.id as umpire_db_id, r.id from raw_data r
left join umpires u on u.mlb_id = r.umpire_id) raw_umpires on raw_umpires.id = p.raw_data_id
set umpire_id = raw_umpires.umpire_db_id;