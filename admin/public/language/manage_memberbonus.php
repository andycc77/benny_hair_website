<?php //中
$myl_page_deftitle = "會員紅利更新";
$myl_page_search_title = "搜尋會員";
$myl_page_list_title = "{$myl_page_deftitle} 清單";
$myl_page_view_title = "瀏覽 {$myl_page_deftitle} 資料";
$myl_page_add_title = "新增 {$myl_page_deftitle}";
$myl_page_edit_title = "修改 {$myl_page_deftitle}";
$myl_page_list_action = "執行";
$myl_page_list_qdel = "您確定要刪除 {$myl_page_deftitle} : ";
$myl_page_list_qupdate = "您確定要修改 {$myl_page_deftitle} : ";
$myl_page_waction_del = "刪除 {$myl_page_deftitle} : ";
$myl_page_waction_update = "修改 {$myl_page_deftitle} : ";
$myl_page_waction_add = "新增 {$myl_page_deftitle} : ";
$myl_page_waction_edit = "修改 {$myl_page_deftitle} : ";

$myl = array(
"{$bef}Sno"=>"主鍵" ,
"{$bef}Email"=>"Email / Id" ,
"{$bef}Email2"=>"Email" ,
"{$bef}Pw"=>"密碼" ,
"{$bef}Fbuid"=>"facebook uid" ,
"{$bef}Fbname"=>"facebook 名稱" ,
"{$bef}Pic"=>"照片" ,
"{$bef}Uid"=>"身份證號" ,
"{$bef}Name"=>"姓名" ,
"{$bef}Nick"=>"暱稱" ,
"{$bef}Sex"=>"性別" ,
"{$bef}Gsm"=>"手機" ,
"{$bef}Htelbef"=>"區碼" ,
"{$bef}Htel"=>"電話" ,
"{$bef}Otelbef"=>"區碼" ,
"{$bef}Otel"=>"辦公室" ,
"{$bef}Faxbef"=>"區碼" ,
"{$bef}Fax"=>"傳真" ,
"{$bef}Birth"=>"生日" ,
"{$bef}By"=>"生日" ,
"{$bef}Bm"=>"生日" ,
"{$bef}Bd"=>"生日" ,
"{$bef}Zip"=>"郵遞區號" ,
"{$bef}City"=>"城市" ,
"{$bef}Area"=>"地區" ,
"{$bef}Addr"=>"地址" ,
"kiwSno"=>"工作" ,
"kieSno"=>"學歷" ,
"{$bef}Epaper"=>"消息通知epaper" ,
"{$bef}Bonus"=>"點數" ,
"{$bef}Bonuswho"=>"分紅給memsno" ,
"{$bef}Bonusend"=>"分紅結束時間" ,
"{$bef}Eventtime"=>"參加活動次數" ,
"{$bef}Producttime"=>"購買次數" ,
"{$bef}Bonustime"=>"分紅購買次數" ,
"{$bef}Partytime"=>"商品促銷活動次數" ,
"{$bef}Cardtime"=>"卡片使用次數" ,
"{$bef}Buyproduct"=>"一般消費" ,
"{$bef}Buybonus"=>"分紅消費" ,
"{$bef}Buyparty"=>"促銷消費" ,
"{$bef}Checkmail"=>"Email驗證" ,
"{$bef}Checkgsm"=>"手機驗證" ,
"{$bef}Status"=>"狀態" ,
"{$bef}Lastevent"=>"最後參加活動" ,
"{$bef}LastProduct"=>"最後參加購物" ,
"{$bef}LastBonus"=>"最後參加分紅" ,
"{$bef}LastParty"=>"最後參加促銷" ,
"{$bef}Lastcard"=>"最候使用卡片" ,
"{$bef}Logintime"=>"登入時間" ,
"{$bef}Modtime"=>"更新時間" ,
"{$bef}Addtime"=>"建立時間" ,
"{$bef}Ps"=>"備註"
);
$myl['StatusOpt'] = array(1=>"上架" , 0=>"下架");
$myl['SexOpt'] = array(0=>"未選" , 1=>"男" , 2=>"女");
$myl['EpaperOpt'] = array(1=>"訂閱" , 0=>"不要");
$myl['CheckmailOpt'] = array(1=>"是" , 0=>"否");
$myl['CheckgsmOpt'] = array(1=>"是" , 0=>"否");
$mylps = array(
"{$bef}Sno"=>"主鍵" ,
"{$bef}Email"=>"Email 已經被使用" ,
"{$bef}Email2"=>"Email" ,
"{$bef}Pw"=>"如不修改請保持空白" ,
"{$bef}Fbuid"=>"facebook uid" ,
"{$bef}Fbname"=>"fb名稱" ,
"{$bef}Pic"=>"上傳圖片 150*150" ,
"{$bef}Uid"=>"身份證號" ,
"{$bef}Name"=>"姓名" ,
"{$bef}Nick"=>"暱稱" ,
"{$bef}Sex"=>"姓別0未知1男2女" ,
"{$bef}Gsm"=>"手機" ,
"{$bef}Htelbef"=>"區碼" ,
"{$bef}Htel"=>"電話" ,
"{$bef}Otelbef"=>"區碼" ,
"{$bef}Otel"=>"辦公室" ,
"{$bef}Faxbef"=>"區碼" ,
"{$bef}Fax"=>"傳真" ,
"{$bef}Birth"=>"生日" ,
"{$bef}By"=>"生日" ,
"{$bef}Bm"=>"生日" ,
"{$bef}Bd"=>"生日" ,
"{$bef}Zip"=>"郵遞區號" ,
"{$bef}City"=>"市" ,
"{$bef}Area"=>"區" ,
"{$bef}Addr"=>"地址" ,
"kiwSno"=>"工作" ,
"kieSno"=>"學歷" ,
"{$bef}Epaper"=>"消息通知epaper" ,
"{$bef}Bonus"=>"點數" ,
"{$bef}Bonuswho"=>"分紅給memsno" ,
"{$bef}Bonusend"=>"分紅結束時間" ,
"{$bef}Eventtime"=>"參加活動次數" ,
"{$bef}Producttime"=>"購買次數" ,
"{$bef}Bonustime"=>"分紅購買次數" ,
"{$bef}Partytime"=>"商品促銷活動次數" ,
"{$bef}Cardtime"=>"卡片使用次數" ,
"{$bef}Buyproduct"=>"一般消費累積金額" ,
"{$bef}Buybonus"=>"分紅消費累積金額" ,
"{$bef}Buyparty"=>"促銷消費累積金額" ,
"{$bef}Checkmail"=>"Email驗證" ,
"{$bef}Checkgsm"=>"手機驗證" ,
"{$bef}Status"=>"狀態" ,
"{$bef}Lastevent"=>"最後參加活動" ,
"{$bef}LastProduct"=>"最後參加購物" ,
"{$bef}LastBonus"=>"最後參加分紅" ,
"{$bef}LastParty"=>"最後參加促銷" ,
"{$bef}Lastcard"=>"最候使用卡片" ,
"{$bef}Logintime"=>"登入時間" ,
"{$bef}Modtime"=>"更新時間" ,
"{$bef}Addtime"=>"建立時間" ,
"{$bef}Ps"=>"備註"
);
$mylse = array(
"{$bef}Sno"=>"主鍵" ,
"{$bef}Email"=>"id兼email" ,
"{$bef}Email2"=>"Email" ,
"{$bef}Pw"=>"密碼" ,
"{$bef}Fbuid"=>"facebook uid" ,
"{$bef}Fbname"=>"fb名稱" ,
"{$bef}Pic"=>"照片" ,
"{$bef}Uid"=>"身份證號" ,
"{$bef}Name"=>"姓名" ,
"{$bef}Nick"=>"暱稱" ,
"{$bef}Sex"=>"性別" ,
"{$bef}Gsm"=>"手機" ,
"{$bef}Htelbef"=>"區碼" ,
"{$bef}Htel"=>"電話" ,
"{$bef}Otelbef"=>"區碼" ,
"{$bef}Otel"=>"辦公室" ,
"{$bef}Faxbef"=>"區碼" ,
"{$bef}Fax"=>"傳真" ,
"{$bef}Birth"=>"生日" ,
"{$bef}By"=>"生日" ,
"{$bef}Bm"=>"生日" ,
"{$bef}Bd"=>"生日" ,
"{$bef}Zip"=>"郵遞區號" ,
"{$bef}City"=>"市" ,
"{$bef}Area"=>"區" ,
"{$bef}Addr"=>"地址" ,
"kiwSno"=>"工作" ,
"kieSno"=>"學歷" ,
"{$bef}Epaper"=>"消息通知epaper" ,
"{$bef}Bonus"=>"點數" ,
"{$bef}Bonuswho"=>"分紅給memsno" ,
"{$bef}Bonusend"=>"分紅結束時間" ,
"{$bef}Eventtime"=>"參加活動次數" ,
"{$bef}Producttime"=>"購買次數" ,
"{$bef}Bonustime"=>"分紅購買次數" ,
"{$bef}Partytime"=>"商品促銷活動次數" ,
"{$bef}Cardtime"=>"卡片使用次數" ,
"{$bef}Buyproduct"=>"一般消費累積金額" ,
"{$bef}Buybonus"=>"分紅消費累積金額" ,
"{$bef}Buyparty"=>"促銷消費累積金額" ,
"{$bef}Checkmail"=>"Email驗證" ,
"{$bef}Checkgsm"=>"手機驗證" ,
"{$bef}Status"=>"狀態" ,
"{$bef}Lastevent"=>"最後參加活動" ,
"{$bef}LastProduct"=>"最後參加購物" ,
"{$bef}LastBonus"=>"最後參加分紅" ,
"{$bef}LastParty"=>"最後參加促銷" ,
"{$bef}Lastcard"=>"最候使用卡片" ,
"{$bef}Logintime"=>"登入時間" ,
"{$bef}Modtime"=>"更新時間" ,
"{$bef}Addtime"=>"建立時間" ,
"{$bef}Ps"=>"備註"
);
?>