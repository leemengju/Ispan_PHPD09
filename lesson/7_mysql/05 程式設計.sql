-- <-----------------------建立快速查詢-------------------------------->
DROP procedure if exists test;
DELIMITER $$
--預存程序 stored procedure
 CREATE procedure test( myuid varchar(20))
 BEGIN
select * from userInfo where uid=myuid;
end $$
 DELIMITER ;
-- <-----------------------建立快速查詢_B02,Tom,花蓮市聯華路5段238號 -------------------------------->
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
DELIMITER ;

