
文法:
select 對象/資料
from 表格
where 條件
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
-- and是繼續，or是斷掉前面的條件，重新回到主名詞。
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

select userInfo.uid, address,tel
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
