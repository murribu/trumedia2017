#This populates the r81 and c81 columns in the pitches table
#If you divide the strike zone into 27 rows and 27 columns (and each of the 8 adjacent zones outside of the strike zone), you have 6561 (3^8) zones. r81 tells you which row the pitch was in, r81 tells you which column - it includes the 27 rows (or columns) in the strike zone, as well as the 27 above and below (27 + 27 + 27 = 81)
#I wanted this information indexable, so I decided to denormalize with the following query.

#This first query took 367 seconds to run locally
#update pitches set r81 = ceil(greatest(least(54 - 27*((pz-szb)/(szt-szb)),80.9),0)), c81 = ceil(greatest(least(27*(px+(25.5/12))*12/17,80.9),0));

#I changed my mind. 6561 was too granular. I will try 243 instead.
update pitches set r27 = ceil(greatest(least(18 - 9*((pz-szb)/(szt-szb)),26.9),0)), c27 = ceil(greatest(least(9*(px+(25.5/12))*12/17,26.9),0));

replace into umpire_zones (umpire_id, zone_c27, zone_r27, umpire_prob_called_strike)
select umpire_id, c27, r27, sum(case when pitch_result_id = 2 then 1 else 0 end)/count(id)
from pitches
where pitch_result_id in (2,7)
and r27 is not null
group by r27, c27, umpire_id;