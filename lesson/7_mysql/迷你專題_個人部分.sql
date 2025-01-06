
-- <--------------------------------從調資料。---------------------------------------->
BDROP PROCEDURE IF EXISTS spec_img;

DELIMITER $$

CREATE PROCEDURE spec_img()
BEGIN
    if  Pspec = '火花燈' THEN
        SELECT 'https://hackmd.io/_uploads/r1DJbVVL1e.png' AS status;
    ELSEIF  Pspec = '石磨灰' THEN
        SELECT 'https://hackmd.io/_uploads/rJGAx4N8Jl.png' AS status;
    ELSEIF  Pspec = '日式深蒸綠茶' THEN
        SELECT 'https://hackmd.io/_uploads/H1k_ZNNL1g.png' AS status;
    ELSEIF Pspec = '春笠清茶' THEN
        SELECT 'https://hackmd.io/_uploads/rJMoZ4E8ke.png' AS status;
    ELSEIF   Pspec = '蜜香紅茶' THEN
        SELECT 'https://hackmd.io/_uploads/BJi9ZVEI1e.png' AS status;
    ELSEIF  Pspec = '金萱烏龍茶' THEN
        SELECT 'https://hackmd.io/_uploads/rJ4q-VNUye.png' AS status;
    ELSE
        SELECT 'Invalid specification' AS status;
    END IF;
END$$

DELIMITER ;


call spec_img();
 New.Pspec = '火花燈';