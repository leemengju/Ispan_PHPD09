-- <-----------------------若UserInfo 中新增一筆資料，將此事件自動記錄到Log 資料表中-------------------------------->
DROP trigger if exists userinfo_insert;
DELIMITER $$
CREATE trigger userinfo_insert
after insert on userInfo
for each ROW
BEGIN
DECLARE body varchar(255);
set @uid=new.uid;
set @cname=ifnull(new.cname,'noname');
set body=concat('將',@uid,',',@cname,'插入資料表中');
insert into log(body) values(body);
end$$
DELIMITER;



DROP TRIGGER IF EXISTS userinfo_insert;
-- 定界符
DELIMITER $$
CREATE TRIGGER userinfo_insert 
AFTER INSERT ON userInfo 
FOR EACH ROW
BEGIN
-- 宣告一個局部變數 body
   DECLARE body VARCHAR(255); -- 宣告一個變數用於存儲訊息
   -- 全域變數：以 @ 開頭，例如 @uid。
-- 可以在同一個連線的上下文中共享。
-- 欄位或局部變數：不加 @，例如 NEW.uid 或 DECLARE uid.
   SET @uid = NEW.uid;
   SET @cname = IFNULL(NEW.cname, 'Noname');
   -- 使用 CONCAT 函數將文字和變數拼接為一段訊息，格式為：將 uid, cname 插入到 userinfo 資料表，並將結果存入局部變數 body。
   SET body = CONCAT('將 ', @uid, ', ', @cname, ' 插入到 userinfo 資料表');
   -- 將組合好的訊息（body）插入到 log 表的 body 欄位中，以記錄該操作。
   INSERT INTO log(body) VALUES (body);
END $$
DELIMITER ;

-- <-----------------------更新兩筆以上資料且涉及到新舊密碼更動時，要擋掉-------------------------------->
-- <-----------------------新密碼是舊密碼old.password <=> new.password / -------------------------------->
-- <-----------------------"<=>" 稱為spaceship，是為了驗證前後兩值是否相同，若相同會報true，不同會報false -------------------------------->
DROP TRIGGER IF EXISTS userinfo_update_block;
DELIMITER $$

CREATE TRIGGER userinfo_update
before update ON userInfo 
FOR EACH ROW
BEGIN
   if @count is null then
     set @count=1;
ELSE
    set @count= @count+1;
end if;
-- 當更新兩筆以上資料，且新密碼不為舊密碼
   if @count >1 and not (old.password <=> new.password)then
-- sqlstate '45000' 是一個自定義的錯誤代碼，45000 通常表示應用程式層級的通用錯誤。
   signal sqlstate '45000' set message_text='更新兩筆資料以上';

END $$

DELIMITER ;


