<?php
$Action=$_POST['Action'];
$FName=['Name','EngName','Gender','IDnumber','Birthday'];
$PDO=connectDB();
switch ($Action) {
    case 'Add':
        Add();
        break;
    case 'Update':
        Update();
        break;
    case 'Delete':
        Delete();
        break;
    default:
        Search();
        break;
}

//關閉資料庫
unset($PDO);
//exit;


function connectDB(){
    //資料庫連線
    try {
    $PDO = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test', 'root', 'MysqlFanny1104');
    return $PDO;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}
function Add(){
    $Data=$_POST['Data'];
    $SQL="INSERT INTO BasicInfo (`Name`, `EngName`, `Gender`,`IDnumber`,`Birthday`)
          VALUES ('{$Data[0]}', '{$Data[1]}', '{$Data[2]}', '{$Data[3]}', '{$Data[4]}');";
    $GLOBALS['PDO']->exec($SQL);
}

function Update(){
    $Data=$_POST['Data'][0];
    $UpdateData="";
    $IDnumber=$_POST['Data'][1];
    foreach ($Data as $key => $value) {
        $UpdateData.=$GLOBALS['FName'][$key].'='."'{$value}' ,";
    }
    $UpdateData=substr($UpdateData,0,-2);
    $SQL="UPDATE BasicInfo SET $UpdateData WHERE IDnumber='{$IDnumber}'";
    $GLOBALS['PDO']->query($SQL);
}

function Delete(){
    $IDnumber=$_POST['Data'];
    $SQL="DELETE FROM BasicInfo WHERE IDnumber='{$IDnumber}'";
    $GLOBALS['PDO']->exec($SQL);
}

function Search(){
    $str=$_POST['Data'];
    $SearchData="WHERE ";
    foreach($GLOBALS['FName'] as $Name){
     $SearchData.="`{$Name}` LIKE '%{$str}%' OR ";
    }
    $SearchData=substr($SearchData,0,-3);
    $SQL="SELECT * FROM BasicInfo $SearchData";
    $query=$GLOBALS['PDO']->query($SQL);
    $result=$query->fetchAll();
    foreach ($result as $index=>$col) {
        echo "<tr id='No{$index}'>";
	    foreach ($col as $key => $field) {
	        if(is_numeric($key))	
                echo "<td>{$field}</td>";
        } 
        echo"<td><input class='btn btn-dark' name='update' type='button' value='修改' onclick='Update(this)'></td>";     
        echo"<td><input class='btn btn-dark' name='delete' type='button' value='刪除' onclick='Delete(this)'></td>";
        echo '</tr>';      
    } 
}
