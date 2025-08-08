<!--proj_paycalc.php-->
<?php include_once "header.php"; ?>
<link href="/0/school/2025yr11php/css/ertdooedits.css" rel="stylesheet">
 <!--style='margin-left: auto;margin-right: 0;'-->
<h1>Pay Calculator</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pay_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);


//display values on rates table
$sql = "SELECT id, base_rate, uniform, laundry, pm_allowance, ext_allowance, deductions FROM rates"; //sql query to select
$result = $conn->query($sql);

//display values on shifts table
$sql1 = "SELECT id, date, start_time, end_time, start_holiday, end_holiday, status FROM shifts ORDER BY id DESC";
$result1 = $conn->query($sql1);
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-sm-4">
      <h3>Rates</h3>
        <div class="vh-100 bg-dark">
          <form action="proj_paycalc_action.php" method="POST" class="w-100" style="max-width: 400px;margin-bottom: 20px;">

              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="rateHr" class="form-label text-white">Hourly Rate:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="number" id="rateHr" name="rateHr" class="form-control" style="width: 100px;" min="0" step="0.01" value="61.45"required>
                  </div>
              </div>

              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="uniform" class="form-label text-white">Uniform Allowance:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="number" id="uniform" name="uniform" class="form-control" style="width: 100px;" min="0"step="0.01" value="1.48" required>
                  </div>
              </div>

              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="laundry" class="form-label text-white">Laundry Allowance:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="number" id="laundry" name="laundry" class="form-control" style="width: 100px;" min="0"step="0.01" value="0.39"required>
                  </div>
              </div>

              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="pmAllowance" class="form-label text-white">PM Allowance:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="number" id="pmAllowance" name="pmAllowance" class="form-control" style="width: 100px;" min="0"step="0.01" value="34.73"required>
                  </div>
              </div>

              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="ext_income" class="form-label text-white">Extra Income:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="number" id="ext_income" name="ext_income" class="form-control" style="width: 100px;" min="0"step="0.01" value="0.00"required>
                  </div>
              </div>

              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="deductions" class="form-label text-white">Deductions:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="number" id="deductions" name="deductions" class="form-control" style="width: 100px;" min="0"step="0.01" value="972.85"required>
                  </div>
              </div>

              <button type="submit" name="rates_btn" class="btn btn-outline-warning">Update Database</button>
          </form>

          <h3>Shifts</h3>
          <form action="proj_paycalc_action.php" method="POST">
              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="date" class="form-label text-white">Date:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="date" id="date" name="date" class="form-control" style="width: 170px;" required>
                  </div>
                  <div class="col-sm-6">
                      <label for="startTime" class="form-label text-white">Start Time:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="time" id="startTime" name="startTime" class="form-control" style="width: 170px;" required>
                  </div>
                  <div class="col-sm-6">
                      <label for="endTime" class="form-label text-white">End Time:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="time" id="endTime" name="endTime" class="form-control" style="width: 170px;" required>
                  </div>
                  <div class="col-sm-6">
                      <label class="form-label text-white" for="holiday">Start on holiday?</label>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="start_holiday" name="start_holiday">
                        </div>
                  </div>
                  <div class="col-sm-6">
                      <label class="form-label text-white" for="holiday">End on holiday?</label>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="end_holiday" name="end_holiday">
                          </div>
                  </div>
              </div>
              <button type="submit" name="shift_btn" class="btn btn-outline-warning">Add to Database</button>
          </form>
        </div>
    </div>
    <div class="col-sm-8">
      <h3>Rates Data</h3>
      <table class="table" id="shiftsTable"> <thead> <tr>
            <th>Base Rate</th>
            <th>Uniform Allowance</th>
            <th>Laundry Allowance</th>
            <th>PM Allowance</th>
            <th>Extra Allowance</th>
            <th>Deductions</th>
          </tr>
        </thead>
        <tbody> <tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { //while row = the num_row
                    echo "<tr>";
                    echo "<td>$" . ($row["base_rate"]) . "</td>";
                    echo "<td>$" . ($row["uniform"]) . "</td>";
                    echo "<td>$" . ($row["laundry"]) . "</td>";
                    echo "<td>$" . ($row["pm_allowance"]) . "</td>";
                    echo "<td>$" . ($row["ext_allowance"]) . "</td>";
                    echo "<td>$" . ($row["deductions"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data bro</td></tr>";
            }
            ?>
          </tr>
        </tbody>
      </table>
    <h3>Shifts Database</h3>
      <table class="table" id="shiftsTable"> <thead> <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Start Holiday</th>
            <th>End Holiday</th>
            <th><!--button row--></th>
          </tr>
        </thead>
        <tbody> <tr>
            <?php
            if ($result1->num_rows > 0) {
                while($row = $result1->fetch_assoc()) { //while row = the num_row
                    if ($row["status"] == 1) {
                        echo "<tr>";
                        echo "<td>" . ($row["id"]) . "</td>";
                        echo "<td>" . ($row["date"]) . "</td>";
                        echo "<td>" . ($row["start_time"]) . "</td>";
                        echo "<td>" . ($row["end_time"]) . "</td>";
                        echo "<td>" . ($row["start_holiday"]? '✓' : '—') . "</td>";
                        echo "<td>" . ($row["end_holiday"]? '✓' : '—') . "</td>";
                        echo "<td>";
                        echo "<button type='button' class='btn btn-outline-custom btn-sm' data-bs-toggle='modal' data-bs-target='#shiftDetailsModal'
                                data-id='" . htmlspecialchars($row["id"]) . "'
                                data-date='" . htmlspecialchars($row["date"]) . "'
                                data-start_time='" . htmlspecialchars($row["start_time"]) . "'
                                data-end_time='" . htmlspecialchars($row["end_time"]) . "'
                                data-start_holiday='" . htmlspecialchars($row["start_holiday"]) . "'
                                data-end_holiday='" . htmlspecialchars($row["end_holiday"]) . "'>
                                Edit
                            </button>";
                        echo "</td>";
                        
                        echo "</tr>";
                }
            }
            } else {
                echo "<tr><td colspan='6'>No data bro</td></tr>";
            }
            ?>
          </tr>
        </tbody>
      </table>
        <form action="proj_paycalc_calc.php" method="POST">
            <button type="submit" name="shift_btn" class="btn btn-outline-warning">Calculate</button>
        </form>
    </div>
  </div>
</div>
 
<div class="modal fade" id="shiftDetailsModal" tabindex="-1" aria-labelledby="shiftDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shiftDetailsModalLabel">Edit Shift Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="editShiftForm" action="proj_paycalc_action.php" method="POST"> <input type="hidden" name="shift_id" id="modalShiftId"> <div class="mb-3">
                <p class="text-white">Current Shift ID: <span id="displayShiftId"></span></p>
              <div class="row mb-3 align-items-center">
                  <div class="col-sm-6">
                      <label for="date" class="form-label text-white">Date:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="date" id="date" name="date" class="form-control" style="width: 170px;" required>
                  </div>
                  <div class="col-sm-6">
                      <label for="startTime" class="form-label text-white">Start Time:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="time" id="startTime" name="startTime" class="form-control" style="width: 170px;" required>
                  </div>
                  <div class="col-sm-6">
                      <label for="endTime" class="form-label text-white">End Time:</label>
                  </div>
                  <div class="col-sm-6">
                      <input type="time" id="endTime" name="endTime" class="form-control" style="width: 170px;" required>
                  </div>
                  <div class="col-sm-6">
                      <label class="form-label text-white" for="holiday">Start on holiday?</label>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="start_holiday" name="start_holiday">
                          </div>
                  </div>
                  <div class="col-sm-6">
                      <label class="form-label text-white" for="holiday">End on holiday?</label>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="end_holiday" name="end_holiday">
                          </div>
                  </div>
                  
              </div>
          </form>
      </div>
<div class="modal-footer justify-content-between">
    <form id="deleteShiftForm" action="proj_paycalc_action.php" method="POST">
        <input type="hidden" name="shift_id" id="deleteModalShiftId">
        <button type="submit" name="delete_shift_btn" class="btn btn-outline-danger" style="width: auto;">Delete shift</button>
    </form>
    <div>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="edit_shift_btn" form="editShiftForm" class="btn btn-success">Save changes</button>
    </div>
</div>

<script> 
document.addEventListener('DOMContentLoaded', function() {
    // --- Modal Logic for Shift Details ---
    var shiftDetailsModal = document.getElementById('shiftDetailsModal');
    if (shiftDetailsModal) { // Check if the modal exists on the page
        shiftDetailsModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-bs-* attributes
            var id = button.getAttribute('data-id');
            var date = button.getAttribute('data-date');
            var startTime = button.getAttribute('data-start_time');
            var endTime = button.getAttribute('data-end_time');
            var startHoliday = button.getAttribute('data-start_holiday');
            var endHoliday = button.getAttribute('data-end_holiday');

            // Update the modal's content.
            // Corrected selectors to match the actual IDs in the HTML form within the modal
            var modalShiftIdInput = shiftDetailsModal.querySelector('#modalShiftId');
            var displayShiftIdSpan = shiftDetailsModal.querySelector('#displayShiftId');
            var modalDateInput = shiftDetailsModal.querySelector('#date'); // Corrected ID
            var modalStartTimeInput = shiftDetailsModal.querySelector('#startTime'); // Corrected ID
            var modalEndTimeInput = shiftDetailsModal.querySelector('#endTime'); // Corrected ID
            var modalStartHolidayInput = shiftDetailsModal.querySelector('#start_holiday'); // Corrected ID
            var modalEndHolidayInput = shiftDetailsModal.querySelector('#end_holiday'); // Corrected ID

            // Set values
            if (modalShiftIdInput) {
                modalShiftIdInput.value = id;
            }
            if (displayShiftIdSpan) {
                displayShiftIdSpan.textContent = id; // This line was missing for the span
            }
            if (modalDateInput) {
                modalDateInput.value = date;
            }
            if (modalStartTimeInput) {
                modalStartTimeInput.value = startTime;
            }
            if (modalEndTimeInput) {
                modalEndTimeInput.value = endTime;
            }
            // Checkboxes need special handling:
            if (modalStartHolidayInput) {
                modalStartHolidayInput.checked = (startHoliday === '1');
            }
            if (modalEndHolidayInput) {
                modalEndHolidayInput.checked = (endHoliday === '1');
            }

            // --- Logic for Delete Button (moved from HTML to JS for cleaner separation) ---
            var deleteShiftForm = document.getElementById('deleteShiftForm');
            if (deleteShiftForm) {
                var deleteModalShiftIdInput = deleteShiftForm.querySelector('#deleteModalShiftId');
                if (deleteModalShiftIdInput) {
                    deleteModalShiftIdInput.value = id; // Ensure the ID is passed to the delete form
                }
            }
        });
    }
});
</script>

<?php include_once "footer.php"; 
 