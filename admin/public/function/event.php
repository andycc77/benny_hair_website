<?php //活動相關
//修改會員點數
function changememberbonus($memSno , $bonus){
	$sql = " update oj_member set 
	memBonus = ( memBonus + ".$bonus." ) 
	where memSno = '".$memSno."' ";
	myquery($sql);
}


//新增會員推薦資料 完成invite條件的會員主鍵 , 被分享的會員主鍵
function addinvitelist( $invMemsno , $InvWhosno ){
	//先撈出完成條件會員
	$resF = myquery(" select memSno,memEmail,memFbuid,memNick from oj_member where memSno = '".$invMemsno."' ");
	//再撈出被分享的會員
	$resT = myquery(" select memSno,memEmail,memFbuid,memNick from oj_member where memSno = '".$InvWhosno."' ");
	if(mysql_num_rows($resF) > 0 and mysql_num_rows($resT) > 0){
		$rowF = mysql_fetch_assoc($resF);
		$rowT = mysql_fetch_assoc($resT);
		//判斷分享清單中是否此會員已經分享過 , 1人應該只能分享1次
		$resL = myquery(" select * from e_20110831_meminvitelist where invMemsno = '".$rowF['memSno']."' or invMememail = '".$rowF['memEmail']."' or invMemfbuid = '".$rowF['memFbuid']."' ");
		if(mysql_num_rows($resL) < 1){
			//撈出活動
			$rowE = mysql_fetch_assoc(myquery(" select * from oj_event where eveTable = 'e_20110831_meminvite' "));
			$today = getmk();
			
			//寫入 invite list
			$sql = " insert into e_20110831_meminvitelist set 
			invMemsno = '".$rowF['memSno']."' ,
			invMemnick = '".$rowF['memNick']."' ,
			invMememail = '".$rowF['memEmail']."' ,
			invMemfbuid = '".$rowF['memFbuid']."' ,
			InvWhosno = '".$rowT['memSno']."' ,
			InvTime = '".$today."' ";
			myquery($sql);
						if(time() >= 1318359669){
			insert_bonuslog($rowT['memSno'],"oj_event",$rowE['eveSno'],$rowE['eveBonus'] , $today ,$rowE['eveTitle']." 成功邀請會員");
			}
			else
			{
			//增加紅利記錄
			$sql2 = " insert into oj_bonuslog set 
			memSno = '".$rowT['memSno']."' ,
			admSno = '0' ,
			cadSno = '0' ,
			eveSno = '".$rowE['eveSno']."' ,
			ordSno = '0' ,
			memSnob = '0' ,
			orbSno = '0' ,
			bolBonus = '".$rowE['eveBonus']."' ,
			bolOrdertime = '".$today."' ,
			bolPaytime = '".$today."' ,
			bolEntertime = '".$today."' ,
			bolPs = '".$rowE['eveTitle']." 成功邀請會員' ,
			bolStatus = '1' ";
			myquery($sql2);
			
			//更新會員紅利
			changememberbonus($rowT['memSno'] , $rowE['eveBonus']);
			}
			//更新 e_20110831_meminvite 會員統計資料
			$sql = " update e_20110831_meminvite set 
			joiEndtime = '".$today."' , 
			joiDtotal = ( joiDtotal + 1 ) , 
			joiWtotal = ( joiWtotal + 1 ) , 
			joiMtotal = ( joiMtotal + 1 ) , 
			joiStotal = ( joiStotal + 1 ) , 
			joiYtotal = ( joiYtotal + 1 ) , 
			joiTotal = ( joiTotal + 1 ) 
			where memSno = '".$rowT['memSno']."' ";
			myquery($sql);
		}else{
			//此會員已經分享過了
		}
	}
}
?>