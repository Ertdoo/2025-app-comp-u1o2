<!-- hangman.php by emerson :) -->
<!-- i put a lot of documentation into this one -->
<?php
session_start();
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
?>

<?php
//game vars
$words = ["kevinwang", "sam", "emerson", "harry", "micah", "dulsith", "charudesna", "dhiira"]; // people on the table during study period 3, 2.4, 29/5/2025 (right to left)
// {excluding hunter jestermaxxing}
$maxAttempts = 11;

$ascii_states = [ // the ascii art
    // 0 incorrect guesses (Initial empty state)
    "







    ",
    // 1 incorrect
    "





          
    =========
    ",
    // 2 incorrect
    "

          |
          |
          |
          |
          |
    =========
    ",
    // 3 incorrect 
    "
          +
          |
          |
          |
          |
          |
    =========
    ",
    // 4 incorrect 
    "
       +--+
          |
          |
          |
          |
          |
    =========
    ",
    // 5 incorrect 
    "
      +---+
      |   |
          |
          |
          |
          |
    =========
    ",
    // 6 incorrect 
    "
      +---+
      |   |
      O   |
          |
          |
          |
    =========
    ",
    // 7 incorrect 
    "
      +---+
      |   |
      O   |
      |   |
          |
          |
    =========
    ",
    // 8 incorrect
    "
      +---+
      |   |
      O   |
     /|   |
          |
          |
    =========
    ",
    // 9 incorrect 
    "
      +---+
      |   |
      O   |
     /|\  |
          |
          |
    =========
    ",
    // 10 incorrect 
    "
      +---+
      |   |
      O   |
     /|\  |
     /    |
          |
    =========
    ",
    // 11 incorrect
    "
      +---+
      |   |
     xOx  |   yikes!
     /|\  |   You're
     / \  |   hanged!
          |
    =========
    "
];

//start a new game
if (!isset($_SESSION["wordtoguess"]) || isset($_POST["play_again"])) {
    if (isset($_POST['play_again'])) {
        unset($_SESSION['wordtoguess']); // i am using unset instead of session_destroy() to avoid the login state being destroyed
        unset($_SESSION['guessed']);
        unset($_SESSION['incorrect']);
        unset($_SESSION['lettersInWord']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    $_SESSION['wordtoguess'] = strtolower($words[array_rand($words)]); // randomly chooses a word from the list
    $_SESSION['guessed'] = [];  // stores guesses letters (both correct and incorrect)
    $_SESSION['incorrect'] = 0; // only stores incorrect
    $_SESSION['lettersInWord'] = array_unique(str_split($_SESSION['wordtoguess']));    // unique letters in the word
}
// state vars
$wordtoguess = $_SESSION['wordtoguess'] ?? '';          // the ?? is null coalescing, which provides a defualt value of '' if the value is null or undefined. 
$guessed = $_SESSION['guessed'] ?? [];                  // default value of []
$incorrect = $_SESSION['incorrect'] ?? 0;               // default value of 0
$lettersInWord = $_SESSION['lettersInWord'] ?? [];      // default value of []

$msg = "";

//guessing code
if (isset($_POST['guess'])) {
    $letter = strtolower(trim($_POST['guess']));

    if (ctype_alpha($letter) && strlen($letter)==1) {   // check if the string is 1 letter long (ctype_alpha is to check if the character typed is compatible)
        if (!in_array($letter, $guessed)) {
            $_SESSION['guessed'][] = $letter; // add the guessed letter the $guessed array
            $guessed = $_SESSION['guessed']; // update local variable

            if (strpos($wordtoguess, $letter) === false) {
                $_SESSION['incorrect']++;
                $incorrect = $_SESSION['incorrect']; // update local variable
                $msg = "'$letter' is not in the word";
            } else {
                $msg = "'$letter' is in the word :)";
            }
        } else {
            $msg = "'$letter' is already guessed";
        }
    } elseif (!empty($letter)) {
        $msg = "pls enter a single letter";
    }
    //header("Location: " . $_SERVER['PHP_SELF']);
    //exit;
}

//game status
$display_letters = [];
$correctcount = 0;
foreach (str_split($wordtoguess) as $char) {
    if (in_array($char, $guessed)) {
        $display_letters[] = $char;
        if(in_array($char, $lettersInWord)) {
            // refine later
        }
    } else {
        $display_letters[] = '_'; 
    }
}
$display_word = implode(' ', $display_letters);

$allLettersGuessed = true;
foreach($lettersInWord as $uniqueLetter){
    if(!in_array($uniqueLetter, $guessed)){
        $allLettersGuessed = false;
        break;
    }
}

$gameWon = $allLettersGuessed;
$gameLost = $incorrect >= $maxAttempts;
$gameOver = $gameWon || $gameLost;
?>

<?php include_once "header.php";?>
 
<h1>Hangman</h1>
<!--Code-->
 <div style="font-family: hack; margin-bottom: 20px;">
    <pre style="font-family: monospace;">
        <?php echo $ascii_states[min($incorrect, $maxAttempts)];?>
    </pre>
    <p>Word: <?php echo strtoupper($display_word); ?></p>
    <p>Incorrect Guesses: <?php echo $incorrect . '/' . $maxAttempts; ?></p>
    <p>Guessed Letters: <?php echo implode(', ', array_map('strtoupper', $guessed)); ?></p>
    <?php if ($msg): ?>
        <div class="alert" style="color: <?php echo (strpos($msg, ':)') !== false || strpos($msg, 'already won') !== false) ? 'green' : 'red'; ?>;"><?php echo $msg; ?></div>
    <?php endif; ?>
</div>

<?php if (!$gameOver): ?>
    <form method="POST" action="" style="font-family: hack; margin-bottom: 20px;">
        <label for="guess">Guess a letter:</label>
        <input type="text" id="guess" name="guess" maxlength="1" autofocus autocomplete="off" required>
        <button type="submit" class="btn btn-success">Guess</button>
    </form>
<?php else: ?>
    <?php if ($gameWon): ?>
        <p style="color: green; font-weight: bold;">Congratulations! you did not get hanged :) the word was "<?php echo strtoupper($wordtoguess); ?>"!</p>
    <?php elseif ($gameLost): ?>
        <p style="color: red; font-weight: bold;">You got hanged <br> The word was "<?php echo strtoupper($wordtoguess); ?>".</p>
    <?php endif; ?>
    <form method="POST" action="">
        <button type="submit" name="play_again" class="btn btn-success">Play Again</button>
    </form>
<?php endif; ?>
 
<?php include_once "footer.php"; ?>