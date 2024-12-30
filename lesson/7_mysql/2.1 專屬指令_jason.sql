-- <-----------------------將數據資料轉成json字串--------------------------------->
select json_object(
    'uid',uid,
    'cname',cname
)
from userInfo
-- <-----------------------把多個欄位合在一列--------------------------------->
select 
group concat(
json_object(
    'uid',uid,
    'cname',cname
)
) 
from userInfo
-- <-----------------------前後加中括號--------------------------------->
select concat('[',
group concat(
json_object(
    'uid',uid,
    'cname',cname
)
) ,
']') as json
from userInfo

-- <-----------------------Jason字串--------------------------------->
[
{
"name":"David",
"age":30
},
{
"name":"Betty",
"age":28
}
]