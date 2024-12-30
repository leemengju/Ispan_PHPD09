-- <-----------------------時間加減--------------------------------->
select adddate(now(), interval 7 hour)
select adddate(now(), interval -3 hour)
-- <-----------------------日期差--------------------------------->
select datediff(now(),'2024/1/1 0:0:0')
-- 365
-- <-----------------------月份差--------------------------------->
select timestampdiff(month,'2024/1/1 0:0:0',now())
-- 11
-- <-----------------------格式_年分--------------------------------->
select date_format(now(),'西元%Y年')
-- <-----------------------格式_星期--------------------------------->
select date_format(now(),'%W')
-- <-----------------------周數--------------------------------->
select weekday(now())
-- <-----------------------現在時間+17天後是星期幾？--------------------------------->
select dayname(adddate(now(), 17))

-- <-----------------------生日差--------------------------------->
select datediff(
(SELECT birthday FROM userInfo WHERE uid = 'A05'),
(SELECT birthday FROM userInfo WHERE uid = 'A06')
)as date_diff

-- <-----------------------每個人的年紀--------------------------------->
select *, Floor(datediff(now(), birthday)/365.25)as age,1000 as billing
from userinfo

-- <-----------------------該月壽星打八折--------------------------------->
SELECT 
    *, 
    billing, 
    birthday_month,
    CASE
        WHEN birthday_month = MONTH(NOW()) THEN billing * 0.8
        ELSE billing
    END AS discount
FROM (
    SELECT *, 1000 AS billing, FLOOR(DATE_FORMAT(birthday, '%m')) AS birthday_month
    FROM userinfo
) AS temp;

-- <-----------------------2019年每季帳單金額總和--------------------------------->

select quarter(dd) as q, sum(fee) as sum_fee
from bill
 where YEAR(dd)=2019
 GROUP by quarter(dd)



-- <-----------------------2019年每季帳單金額總和，缺項補0--------------------------------->
-- <-----------------------select& from 只能擇一加上同名稱的 as__，其他都只能用代名詞來使用。建議放在from--------------------------------->
SELECT 
    q, 
    SUM(fee) AS sum_fee
FROM (
    SELECT 
        QUARTER(dd) AS q, 
        fee
    FROM bill
    WHERE YEAR(dd) = 2019
    UNION ALL
    SELECT 1, 0
    UNION ALL
    SELECT 2, 0
    UNION ALL
    SELECT 3, 0
    UNION ALL
    SELECT 4, 0
) AS temp
GROUP BY q
ORDER BY q;
-- <-----------------------2019年上下半年帳單金額總和，缺項補0，日期優化，可以快速提升效能--------------------------------->



SELECT 
    CASE 
        WHEN MONTH(dd) BETWEEN 1 AND 6 THEN 1 
        ELSE 2 
    END AS hy,
    SUM(fee) AS sum_fee
FROM bill
-- WHERE YEAR(dd) = 2019
WHERE dd BETWEEN'2019/1/1 'and '2019/12/31 23:59:59.999'
GROUP BY 
    CASE 
        WHEN MONTH(dd) BETWEEN 1 AND 6 THEN 1 
        ELSE 2 
    END
UNION all
SELECT 1, 0
UNION all
SELECT 2, 0
ORDER BY hy;
-- <-----------------------不帶時區資訊--------------------------------->
抓時間的種類:
select now();
select utc_timestamp();
select unix_timestamp();
基準時間:1970年1月1日開始，總共經過了多少時間。儲存時需要扣除當地時間。
前端在使用時，終端介面會將unix time(epoch time)轉換成人能看懂得時間。
-- 將unix_timestamp轉成人視時間
select form unixtime(1735530155);
-- <-----------------------植入日期資訊--------------------------------->
-- <-----------------------!!!一定要先討論是否需要加減時區，通常會用utc時間，而非本地時間--------------------------------->
-- <-----------------------資料庫會再新開一個時區欄位，放當地的時間--------------------------------->
insert into bill (tel, fee, dd, hid)value('1111',2000, '2024/7/30 13:10:00',1)













