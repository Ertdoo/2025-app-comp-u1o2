<?php include_once "header.php"; ?>

<?php
// process the form if it is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // data from the form
    $nums_input = $_POST['nums']; 
    $msg = '';
    $original_numbers_array = []; // valid original numbers
    $sorted_array = [];           // sorted numbers

    if (empty($nums_input)) {
        $msg = "fill it in boy";
    } else {
        // regex ensures positive/negative, integer/float numbers.
        $pattern = '/^-?\d+(\.\d+)?\s-?\d+(\.\d+)?\s-?\d+(\.\d+)?$/';

        if (!preg_match($pattern, $nums_input)) {
            $msg = "enter 3 numbers separated by spaces boy";
        } else {
            $string_parts = explode(' ', $nums_input);

            foreach ($string_parts as $num_str) {
                $original_numbers_array[] = (float)$num_str;
            }
            // clone the original array to preserve original data
            $sorted_array = $original_numbers_array;
            $n = count($sorted_array); // get len
            // bu bu bu bubblesort
            for ($i = 0; $i < $n - 1; $i++) {
                $swapped = false; // flag
                // $n - 1 - $i makes it so we don't compare already sorted elements at the end
                for ($j = 0; $j < $n - 1 - $i; $j++) {
                    if ($sorted_array[$j] > $sorted_array[$j + 1]) {
                        $temp = $sorted_array[$j];
                        $sorted_array[$j] = $sorted_array[$j + 1];
                        $sorted_array[$j + 1] = $temp;
                        $swapped = true;
                    }
                }
                if ($swapped === false) { 
                    break;
                }
            }
 
            // $msg = "Sorted numbers: " . implode(', ', $sorted_array) ;
            $msg = "biggerest number = " . end($sorted_array) ;
        }
    }
}
?>

<h1>Enter 3 numbers</h1>
Seperated by spaces

<div class="d-flex vh-100 bg-dark">
  <form action="#" method="POST" style="width: 100%; max-width: 400px;">
    <label for="nums" class="form-label text-white">Numbers:</label>
    <input type="text" id="nums" name="nums" class="mb-3" required
           value="<?php echo isset($_POST['nums']) ? htmlspecialchars($_POST['nums']) : ''; ?>">
    <button type="submit" class="btn btn-primary w-100">Sort Numbers</button> <br>
    <br>
    <?php echo $msg ?>
  </form>
</div>


<?php include_once "footer.php"; ?>