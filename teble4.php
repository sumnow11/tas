<?php 
  require_once("db_con.php");//เรียกใช้กconn
  if(isset ($_GET['delete'])){//ไม่ให้ขึ้น errorตอนกดลบ
    echo $_GET['id'];
    // sql to delete a record
    $sql = "DELETE FROM studentf WHERE student_id = '{$_GET['id']}'";
      if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
  }
  $sql = "SELECT * FROM studentf"; //สร้างเก้บ
  
  
  if(isset ($_GET['serach_click'])){
    $sql = "SELECT * FROM studentf WHERE student_id LIKE '%{$_GET['search']}%' OR student_fname LIKE '%{$_GET['search']}%' ";// LIKE การหาทุกตัว

    echo "<p>คุณกำลังค้นหา: {$_GET['search']}</p>";

  }
  $result = $conn->query($sql);//ดึงข้อมูล
 ?>
 <form action="." method="post">
    <button type="submit" name="logout">ออกจากระบบ</button>
</form>
 <form action="." method="get">
    <label for="search">ช่องค้นหา</label>
    <input type="text" name="search" id="search" placeholder="ค้นหา">
    <button type="submit" name="serach_click">ค้นหา</button>
</form>
<a href="from_inset.php">เพิ่ม</a>
<table style="width:100%"border="1">
  <tr>
    <th>รหัสนักศึกษา</th>
    <th>ชื่อ</th>
    <th>นามสกุล</th>
    <th>วัน/เดือน/ปี</th>
    <th>PIN</th>
    <th>เครื่องมือ</th>
  </tr>
  <?php 
    if ($result->num_rows > 0) {//มีข้อมูลรึเปล่า
    while($row = $result->fetch_assoc()) {
      ?>
<tr>
    <td><?php echo $row['student_id'];?></td>
    <td><?php echo $row['student_fname'];?></td>
    <td><?php echo $row['student_lname'];?></td>
    <td><?php echo $row['student_bday'];?></td>
    <td><?php echo $row['student_pin'];?></td>
    <td align="center">
            <a href="updata_form.php?id=<?php echo $row['student_id']; ?>">แก้ไข</a>  <!-- href ลิ้ง  เมดตอ้ดget-->
            <a href="?delete=1&id=<?php echo $row['student_id'];?>">ลบ</a><!-- get ID -->
    </td>
  </tr>
  <?php
    }
    } else {
      echo "0 results00000";
    }
    $conn->close();
 ?>
</table>
