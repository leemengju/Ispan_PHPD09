
-- <--------------------------------撤回與提交----------------------------------------->
-- 一般預設是auto commit，所以要反悔一定要先設start transaction
-- 開始交易
start transaction;
insert into userInfo(uid,cname) values('C01','David');
-- 撤回
rollback;
-- 提交
commit;

-- <--------------------------------數個異動指令，只允許全部成功和全部失敗的，那就要開啟交易----------------------------------------->
-- <--------------------------------任何一個錯誤應該rollback，例如:領錢與扣款----------------------------------------->
DELIMITER $$

DROP PROCEDURE IF EXISTS test;

CREATE PROCEDURE test()
BEGIN
start transaction;
declare @err=0;

UPDATE userInfo set password='1234' where uid='A02';
set @err= @err + @@error_count;
insert into userInfo(uid) values('D01');
set @err= @err + @@error_count;

if  @err=0 then
commit;
else 
rollback;
end if ;
END$$

DELIMITER ;

-- <--------------------------------超賣現象----------------------------------------->

UPDATE ticket set quantity=1 WHERE tid=1;
drop PROCEDURE if exists buy;
CREATE procedure buy()
BEGIN
    DECLARE n int;
    -- query
    SELECT quantity into n from ticket where tid=1;
    -- check
    if n>0 THEN
    -- update
    update  ticket set quantity=quantity-1 WHERE tid=1;
    SELECT '買走一張票'as status;
    ELSE
    SELECT '賣完了'as status;
    end if;
    end;


-- <--------------------------------解除超賣現象_新增transaction----------------------------------------->

drop PROCEDURE if exists buy;
CREATE procedure buy()
BEGIN
    DECLARE n int;
    START TRANSACTION;
     --- update:嘗試購票，將 tid=1 的票數減少 1。
      update  ticket set quantity=quantity-1 WHERE tid=1;
    --- query:查詢 tid=1 的票數，並將結果存入變數 n。
     SELECT quantity into n from ticket where tid=1;
    -- checked
     if n>=0 THEN
   COMMIT;
    SELECT '買走一張票'as status;
    ELSE
    ROLLBACK;
    SELECT '賣完了'as status;
    end if;
 end;
-- <-----------------------為什麼不能直接用 CASE...WHEN...THEN...ELSE？--------------------------------->
-- CASE 只能選擇值，不能進行流程控制（如執行 COMMIT 或 ROLLBACK 這類語句）。
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

-- <--------------------------------隔離等級----------------------------------------->
■REPEATABLE READ：預設等級– 確保在交易中的多次讀取都是同樣的結果。不管外面怎麼改都一樣。
■ READ COMMITTED– 只會讀到已經 commit 的資料– uncommit 的資料會忽略，不會造成阻塞。
■ READ UNCOMMITTED– 可讀到另一交易已修改但尚未 commit 的資料，造成髒讀取
■ SERIALIZABLE– 確保一群交易依序執行，不會多個交易同時執行導致讀寫交錯– 因為需要更多的鎖來控制執行順序，因此會影響效率

-- <--------------------------------更改隔離等級----------------------------------------->
UPDATE userinfo set password=null WHERE uid='A01';
set TRANSACTION isolation level read committed;
-- default is repeatable read

START TRANSACTION
SELECT'r1',* from userinfo where uid='A01';
do sleep(10);
SELECT'r2',* from userinfo where uid='A01';
commit;