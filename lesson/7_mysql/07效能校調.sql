-- <--------------------------------先將useinfo和house植入10萬和1萬筆數據---------------------------------------->
DELIMITER $$

DROP PROCEDURE IF EXISTS test $$

CREATE PROCEDURE test()
BEGIN
    -- 宣告變數 n 並初始化為 100000
    DECLARE n INT DEFAULT 100000;
      -- 宣告變數 m 並初始化為 10000
    DECLARE m INT DEFAULT 10000;


    -- 插入 userinfo 資料
    WHILE n > 0 DO
        INSERT INTO userinfo(uid, cname) VALUES (CONCAT('x', n), CONCAT('x', n));
        SET n = n - 1;
    END WHILE;

  
    -- 插入 house 資料
    WHILE m > 0 DO
        INSERT INTO house(address) VALUES (CONCAT('address', m));
        SET m = m - 1;
    END WHILE;
END $$

DELIMITER ;
-- <--------------------------------沒建索引是線性增長。建了索引是指數增長。建議會搜尋到的欄位都加索引。---------------------------------------->
-- 叢集索引的欄位預設為PK，二級索引可以很多。資料順序會跟崇集索引相同。
-- 叢集索引只需要搜尋一次，但二級索引需要找兩次。myserver可以將其他搜尋資訊併入節點，免去二次索引，但是mysql無法。
-- 等號左邊不建議使用處理函數，因為會吃不到索引。
-- 當出現using index condition時，就吃不到索引排序。



-- <--------------------------------以下欄位才會吃索引---------------------------------------->
-- <--------------------------------順向:ASC/逆向:DESC---------------------------------------->
-- uid(+),cname(+),pwd(+)
-- uid(+),cname(+)
-- uid(+)
-- uid(-)
-- uid(-),cname(-)
-- uid(-),cname(-),pwd(-)

-- <--------------------------------指定索引_use index()---------------------------------------->
explain
SELECT *
FROM userinfo use index()
WHERE uid='A01'
-- <--------------------------------索引重建---------------------------------------->
OPTIMIZE TABLE my_table
-- <--------------------------------建立資料庫???---------------------------------------->
需求:pchome網站的資料庫
需要做ppt。
做哪部分
做ER:drawer.io
建欄位名稱
每一個人都需要建立一個stored procedure
