#I accidentally left umpire_id out of the PitchesSeeder :/
#This sql should fix that problem

update pitches p
inner join (select u.id as umpire_db_id, r.id from raw_data r
left join umpires u on u.mlb_id = r.umpire_id) raw_umpires on raw_umpires.id = p.raw_data_id
set umpire_id = raw_umpires.umpire_db_id;