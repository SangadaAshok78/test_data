<?php
$conn = oci_connect("C##DDMS_BANK","7032","localhost/orcl");
$acc = $_POST['acc_no']; $amt = $_POST['amount'];
$stmt = oci_parse($conn,
  "BEGIN withdraw_amount(:acc, :amt, :newbal); END;");
oci_bind_by_name($stmt, ":acc", $acc);
oci_bind_by_name($stmt, ":amt", $amt);
oci_bind_by_name($stmt, ":newbal", $newbal, 32);
@oci_execute($stmt);
if ($e = oci_error($stmt)) {
  echo "<p class='text-danger'>{$e['message']}</p>";
} else {
  echo "<h2>New Balance: ₹".number_format($newbal,2)."</h2>";
}
?>
