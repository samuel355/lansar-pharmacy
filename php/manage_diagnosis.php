<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM diagnosis WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showMedicines(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showMedicines($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      updateMedicine($id, $name);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showMedicines(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchMedicine(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showMedicines($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM diagnosis";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showMedicineRow($seq_no, $row);
      }
    }
  }

  function showMedicineRow($seq_no, $row) {
    ?>
      <tr>
        <td><?php echo $seq_no; ?></td>
        <td><?php echo $row['DIAGNOSE_NAME']; ?></td>
        <td>
          <button href="" class="btn btn-info btn-sm m-1">
            <i class="fa fa-pencil"></i>
          </button>
          <button class="btn btn-danger btn-sm m-1" onclick="deleteMedicine(<?php echo $row['ID']; ?>);">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
    <?php
  }

function updateMedicine($id, $name) {
  require "db_connection.php";
  $query = "UPDATE diagnosis SET DIAGNOSE_NAME = '$name' WHERE ID = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showMedicines(0);
}

function searchMedicine($text, $tag) {
  require "db_connection.php";
  if($tag == "name")
    $column = "DIAGNOSE_NAME";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM diagnosis WHERE UPPER($column) LIKE '%{$text}%' ";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showMedicineRow($seq_no, $row);
    }
  }
}

?>
