
文法:
select 對象/資料
from 表格
where 條件
and是同時成立，or是前後獨立。
-- <------------------------選擇用戶--------------------------------->
-- 選擇全部，選擇A01和A02用戶
-- <>為不等於
select *
from userinfo
where uid = 'A01' or uid='A02'
--除了A01和A02用戶之外都選。
-- where uid <> 'A01' and uid <>'A02'
where uid not in('A01','A02')

-- <------------------------選擇間值--------------------------------->
select *
from Bill
where fee <> 500
where fee>=300 and fee <=700
--where fee not between 300 and 700
-- <------------------------模糊查詢_王某某--------------------------------->
select *
from userInfo
where cname like '王%'
-- <------------------------模糊查詢_名字中有帶王的--------------------------------->
select *
from userInfo
where cname like '%王%'
-- <------------------------精準查詢--------------------------------->
select *
from userInfo
where cname ='王大明'
where cname in ('王大明')
-- <------------------------精準查詢_不是王大明，但是是null--------------------------------->

select *
from userInfo
where cname not in ('王大明') or cname is null
-- <------------------------精準查詢_選空集合和null--------------------------------->
select *
from userInfo
where cname= '' or cname is null
-- <------------------------調整內容_將null轉為空字串--------------------------------->
select * ,ifnull(cname,'')
from userInfo
-- <------------------------排序_根據中文筆畫數排序--------------------------------->
select *
from userInfo
order by convert(cname using big5)
-- <------------------------查詢_王大明的ID,地址和電話--------------------------------->-- 
-- <------------------------後面四步驟合併表格--------------------------------->

select userInfo.uid,address,tel
from userInfo,Live,House,Phone
where userInfo.uid=Live.uid
    and Live.hid=House.hid
    and House.hid=phone.hid
    and cname='王大明'
-- <------------------------合併四個表格--------------------------------->
select *
from userInfo join Live on UserInfo.uid = Live.uid
    join House on  Live.hid= House.hid
    join Phone on  House.hid= Phone.hid
where cname= '王大明'
-- <------------------------合併四個表格_應用--------------------------------->
select *
from userInfo join Live on UserInfo.uid = Live.uid
    join House on  Live.hid= House.hid
    join Phone on  House.hid= Phone.hid
    join Bill on  Phone.hid= Bill.hid
where fee >700
-- <------------------------左邊的資料比較多，需要保留時--------------------------------->
-- <------------------------用outer join資料才不會漏掉--------------------------------->
-- <------------------------用cross join基本上就是錯的--------------------------------->
select *
from userInfo left join Live on UserInfo.uid = Live.uid
    left join House on  Live.hid= House.hid
    left join Phone on  House.hid= Phone.hid
-- where cname= '朱小妹'
-- <------------------------帳號密碼驗證--------------------------------->
select count(*)
from userInfo
where uid='A01' and password='12345'
-- <------------------------群組運算_電話號碼的帳單總額--------------------------------->
select tel,sum(*)
from bill
group by tel

select tel,avg(*)
select tel,max(*)
select tel,min(*)
-- <------------------------群組運算_顯示地址/先由電話分類一遍，再根據地址分一遍--------------------------------->
select tel,sum(fee),address
from bill,house
where bill.hid=house.hid
group by tel,address
-- <------------------------取字串截斷值--------------------------------->
-- <------------------------陣列索引值（Array Index）才會從0計算，字喘會從1計算--------------------------------->
-- <------------------------使用 TRIM 函數可以去除字符串的多餘的空格--------------------------------->
select cname, left(cname, 1),right(cname, 1),substring(cname,1,2)
from userinfo
where cname is not null and TRIM(cname) != '';

-- <------------------------別名--------------------------------->
select uid as '帳號', cname as '姓名', address as '住址'
from userinfo,house
where cname is not null and TRIM(cname) != '';
-- <------------------------計算不同姓氏的數量--------------------------------->
select count(left( cname, 1))
from () as x
group by left( cname, 1)
-- <--------------巢狀查詢，從內開始理解--------------->
SELECT lastname, COUNT(*) AS count
FROM (
    SELECT cname, LEFT(cname, 1) AS lastname
    FROM userInfo
    WHERE cname IS NOT NULL AND TRIM(cname) != ''
) AS x
GROUP BY lastname;
-- <--------------from一定要加別名，不然會報錯--------------->
select lastname, count(*) 
from(
select cname, left(cname, 1) as lastname
from userinfo
where cname is not null and trim(cname) !='') as x
group by lastname;


-- <------------------------計算每人有幾間房--------------------------------->

select userinfo.uid,cname,count(hid)as house_number
from userinfo left join live on userinfo.uid=live.uid
group by userinfo.uid,cname
-- <------------------------*****計算空屋率-------------________________________________________12/27-------------------->
-- <------------------------*****計算空屋率--------------------------------->
沒住人的房/總房數
計算過程:
 select count(*)
       from House left join Live on House.hid = Live.hid
       where Live.uid is null  

得A值

SELECT COUNT(hid) 
FROM live
得B值

=>求A/B

解答:

-- <---------------CONCAT(..., '%')將計算結果轉換為字串，並加上 % 符號。--------------->
-- <---------------ROUND(..., 2)將計算結果四捨五入到小數點後 2 位。--------------->
-- <---------------Floor(()* 100)不要小數點--------------->
create view vw_vacancy_rate as
SELECT CONCAT(
  Floor(
      (
      (select count(*)
       from House left join Live on House.hid = Live.hid
       where Live.uid is null)
    /
   (SELECT COUNT(hid) FROM live) 
   )
   * 100),
  '%') 
AS 空屋率;
-- <------------------------帳單金額最高的那支電話的所有資訊，降序--------------------------------->
select*
from bill
where fee=(select max(fee) from bill)



-- <------------------------住最多人的房，如果只有一戶最多人--------------------------------->
12/29

hid 出現次數最多的房子號碼
select hid
from live
where hid=(
    select hid
    from live
    group by hid
    order by count(hid) desc
    limit 1
    )

-- <------------------------住最多人的房的地址--------------------------------->
select hid, count(uid) as n
 from live
 group by hid
  

select address,n  
 from
 (select hid, count(uid)as n
from live
group by hid
) as x ,house

where n=(
select max(n)
from(
select hid, count(uid)as n
from live
group by hid
) as x
) and x.hid=house.hid

-- <------------------------帳單金額最小的==>裝機地址，帳單總額，電話號碼--------------------------------->
select  address,850， 2222








解答:
select tel,sum(fee) as sum_fee
from bill
group by tel


select phone.tel, address, sum_fee
from(
select tel,sum(fee)as sum_fee
from bill
group by tel
) as x, phone, house

where x.tel = Phone.tel and Phone.hid = House.hid
   and sum_fee = (
       select sum(fee) as sum_fee
        from Bill
       group by tel
       order by sum_fee
       limit 1       
   )


-- bill的tel已經不見了 
select phone.tel, address, sum_fee
-- 來自三個資料庫  
from(
select tel,sum(fee)as sum_fee
from bill
group by tel
) as x, phone, house
-- 說明這三個資料庫的關聯，避免交叉合併(cross join)
where x.tel = Phone.tel and Phone.hid = House.hid
-- 為什麼這邊要定義sum_fee?只要資料原本沒有，就要定義。
   and sum_fee = (
       select sum(fee) as sum_fee
        from Bill
       group by tel
       order by sum_fee
       limit 1       
   )

-- <------------------------救急:只要出現重複就用這招，在select後面加distinct--------------------------------->
select distinct left(cname,1)
from userinfo
-- <------------------------應用:哪間屋子有住人?--------------------------------->
select address
from house
where hid in(
    select distinct hid
    from live
)
-- <------------------------救急:無中生有補一筆--------------------------------->


select address
from house
where hid in(
    select distinct hid
    from live
)
union all
 select'苗栗縣'
-- union:已經重複的就不併進去。
union 
 select'苗栗縣'
 -- <------------------------救急:打折--------------------------->

 select *,
    case
        when fee >500 then fee*0.8
        when fee >300 then fee*0.9
        else fee
    end as dicount
from bill
 -- <------------------------每支帳單總額--------------------->

方法一
 select *
from
( select tel, sum(fee)as sum_bee
from bill
group by tel)as x
where sum_fee>1000


方法二
select tel, sum(fee)as sum_bee
from bill
group by tel as x
having sum_fee>1000



