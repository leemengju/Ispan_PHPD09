-- <-----------------------註冊檢驗-------------------------------->
DROP procedure if exists test;
DELIMITER $$
--預存程序 stored procedure
 CREATE procedure test( myuid varchar(20))
 BEGIN
select * from userInfo where uid=myuid;
end $$
 DELIMITER ;
-- <-----------------------註冊檢驗_B02,Tom,花蓮市聯華路5段238號 -------------------------------->
DROP procedure if exists register;
DELIMITER$$
 CREATE procedure register( myuid varchar(20),mycname varchar(50),myaddress varchar(100))
BEGIN
DECLARE n int;
select COUNT(*) into n;
from userInfo
where uid=myuid;

if n=1 then 
select 'false'as status;
else 
insert into userInfo(uid,cname,address);
values(myuid,mycname,myaddress)
select 'true'as status;
end if;

end$$
dELIMITER




DROP procedure if exists register;
DELIMITER $$
 CREATE procedure register( myuid varchar(20),mycname varchar(50),myaddress varchar(100))
BEGIN
    DECLARE n INT; -- 用來存儲查詢結果的變數

    -- 檢查是否存在指定的 uid
    SELECT COUNT(*) INTO n 
    FROM userInfo 
    WHERE uid = myuid;

    IF n = 1 THEN
        -- 如果 uid 已經存在，返回 false 狀態
        SELECT 'false' AS status;
    ELSE
        -- 如果 uid 不存在，插入新記錄並返回 true 狀態
        INSERT INTO userInfo (uid, cname, address) 
        VALUES (myuid, mycname, myaddress);
        SELECT 'true' AS status;
    END IF;
END $$

DELIMITER ;
-- <-----------------------註冊檢驗_B02,Tom,花蓮市聯華路5段238號 -------------------------------->
DROP procedure if exists register;
DELIMITER $$
 CREATE procedure register( myuid varchar(20),mycname varchar(50),myaddress varchar(100))
BEGIN
    select count(*)  into @n from userInfo where uid=myuid;
    if @n=1 THEN
    select 'false' as status;
    ELSE
   insert into UserInfo (uid, cname) values (myuid, mycname);
       select hid into @hid from House where address = myaddress;
       if @hid is null then
           insert into House (address) values (myaddress);
       end if;


       select hid into @hid from House where address = myaddress;
       insert into Live (uid, hid) values (myuid, @hid);
       select 'OK' as status;       
   end if;
END $$

DELIMITER ;
-- <-----------------------註冊檢驗_B02,Tom,花蓮市聯華路5段238號 -------------------------------->
-- 如果名為 register 的預存程序已經存在，則刪除它，防止重複定義或衝突。
DROP procedure if exists register;
-- 改變 SQL 語句的分隔符號為 $$，以便能正確處理多行的複雜語句
DELIMITER $$
 CREATE procedure register( myuid varchar(20),mycname varchar(50),myaddress varchar(100))
BEGIN
-- @n為全域變數，可以用宣告改成區域變數。
    select count(*)  into @n from userInfo where uid=myuid;
    if @n=1 THEN
    select 'false' as status;
    ELSE
   insert into UserInfo (uid, cname) values (myuid, mycname);
       select hid into @hid from House where address = myaddress;
       if @hid is null then
           insert into House (address) values (myaddress);
       end if;

-- 重新查詢 House 表，確保新插入的地址已經存在，並將其 hid 存入變數 @hid
       select hid into @hid from House where address = myaddress;
    -- 將用戶與地址的對應關係（uid 和 hid）插入到 Live 表中。
       insert into Live (uid, hid) values (myuid, @hid);
       select 'OK' as status;       
-- 結束 IF...ELSE 條件分支，並結束程序主體。
   end if;
END $$

DELIMITER ;

call register('B02','Tom','花蓮市聯華路5段238號')

-- <-----------------------建立帳號 -------------------------------->
DROP procedure if exists test;
DELIMITER $$
 CREATE procedure test( )
BEGIN
-- @n為全域變數，可以用宣告改成區域變數。
     DECLARE n INT default 10; -- 用來存儲查詢結果的變數
   aaa: while n>0 do
    if n=3 then
     -- sql裡面，leave就是break的意思。如果要繼續，請用iterate取代continuous
    leave aaa;
    end if;
    insert into userinfo(uid,cname) values (concat('x',n),concat('x',n));
    set n=n-1;
   end while;
END $$
-- <-----------------------定義一個名為 swap 的儲存程序（Stored Procedure），用來交換兩個整數的值。-------------------------------->

 DELIMITER $$
--  INOUT a INT: a 是一個既可以傳入也可以被修改的參數。執行程序後，a 的值會被更改。
 create procedure swap(inout a int, inout b int)
 begin
 declare tmp int;
--  將 a 的值存入臨時變數 tmp。
 set tmp = a;
--  將 b 的值賦給 a
 set a = b;
--  將暫存在 tmp 中的原 a 值賦給 b
 set b = tmp;
 end $$
 DELIMITER ;
-- <-----------------------all-by-value 傳值呼叫 -------------------------------->
set @n=10;
call test(@n);
select @n;

-- in:call-by-value 傳值呼叫
    -- 只進不出，裡面怎麼變外面都不會變
-- in:call-by-address 傳址呼叫
    -- 內外都會變
DROP procedure if exists test;
DELIMITER $$
 CREATE procedure test(inout n int)
BEGIN
set n=n+1;
END $$
DELIMITER ;

-- <-----------------------數學除法操作 a/b -------------------------------->

DROP procedure if exists test;
DELIMITER $$
-- a double: 輸入參數 𝑎，型別為 double。
-- b double: 輸入參數 𝑏，型別為 double。
-- inout error int: 輸入和輸出的參數，用於返回錯誤代碼，型別為 int。
 CREATE procedure test(a double, b double, inout error int)
BEGIN
  set error=0;
  if b=0 then
   set error=1;
else 
    select a/b as result;
-- 結束 if-else 條件
    end if;
END $$
DELIMITER ;
-- <----------------------- function_有傳回值-------------------------------->
-- <----------------------- procedure vs function_後者有傳回值-------------------------------->

DROP function if exists myadd;
DELIMITER $$
 CREATE function myadd(a double, b double) returns double
BEGIN
  return a + b;
END $$
DELIMITER ;


-- <-----------------------!!!!! cursor_會一筆一筆處理所有的資料-------------------------------->

DROP procedure if exists test1;
DELIMITER $$
 CREATE function test1()
BEGIN
-- bool:boolean型態
-- 宣告一個布林變數 E0F，初始值為 false。此變數用來標記游標是否已到資料的結尾（end-of-file, EOF）
  DECLARE E0F bool default false;
--   宣告一個整數變數 n，用於儲存當前從游標提取的資料值。
  DECLARE n int;
--   宣告一個整數變數 total，初始值為 0，用於累加 fee 欄位的總和。
  DECLARE total int default 0;

-- 定義游標 c，其目標是查詢 bill 資料表的 fee 欄位。
  DECLARE c cursor for select fee from bill;
--   cursor往下找沒找到資料就會 not found。
  DECLARE continue handle for not found set E0F=true;

  --   cursor指向第一筆資料。
--   開啟游標 c，準備開始遍歷查詢結果。
  open c;
--  往下挪動一筆，將資料c丟進n裡面
  fetch c into n;
--   開啟游標 c，準備開始遍歷查詢結果。
  while ! E0F do
--   將提取的資料值 n 累加到 total。
        set total =total + n;
-- 從游標提取下一筆資料，存入變數 n。如果資料提取失敗（游標到達結尾），觸發 not found 錯誤處理器，設置 E0F = true。
 fetch c into n;
  end while;

select total as result;
close c;

END $$
DELIMITER ;


-- <-----------------------!!!!! 帳號後兩碼+生日月分和日期-------------------------------->
DELIMITER $$

DROP PROCEDURE IF EXISTS initpassword$$

CREATE PROCEDURE initpassword()
BEGIN
    DECLARE E0F BOOLEAN DEFAULT FALSE;
    DECLARE myuid VARCHAR(255);
    DECLARE mybirthday DATE;
    DECLARE mypassword VARCHAR(255);

    -- 宣告游標，用於遍歷 userInfo 資料表
    DECLARE c CURSOR FOR SELECT uid, birthday FROM userInfo WHERE password IS NULL;

    -- 當游標沒有資料時，處理結束的情況
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET E0F = TRUE;

    -- 開啟游標
    OPEN c;

    -- 從游標讀取第一筆資料
    FETCH c INTO myuid, mybirthday;

    -- 遍歷每一行資料
    WHILE NOT E0F DO
        -- 生成新密碼：取 UID 的後兩位數 + 生日的月份和日期（MMDD）
        SET mypassword = CONCAT(SUBSTRING(myuid, -2), DATE_FORMAT(mybirthday, '%m%d'));

        -- 更新 userInfo 資料表中的密碼欄位
        UPDATE userInfo
        SET password = mypassword
        WHERE uid = myuid;

        -- 讀取下一筆資料
        FETCH c INTO myuid, mybirthday;
    END WHILE;

    -- 關閉游標
    CLOSE c;
END$$

DELIMITER ;






