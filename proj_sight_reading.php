<?php
// Prevent caching of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Define constants for SVG positioning and note rendering
const NOTE_FONT_SIZE = 50;
const NOTE_BASELINE_OFFSET = NOTE_FONT_SIZE / 2;
const NOTE_X_POSITION = 205;
const LEDGER_LINE_WIDTH = 20;
const LEDGER_LINE_X_OFFSET = LEDGER_LINE_WIDTH / 2;

// Map note names to their visual center Y-coordinate in SVG, organized by clef.
$note_clef_y_map = [
    'treble' => [
        'F5' => 95, 'E5' => 100, 'D5' => 105, 'C5' => 110,
        'B4' => 115, // Middle line
        'A4' => 120, 'G4' => 125, 'F4' => 130, 'E4' => 135,
        // Ledger Lines Below Staff
        'D4' => 140, 'C4' => 145, // Middle C
        'B3' => 150, 'A3' => 155, 'G3' => 160, 'F3' => 165,
        // Ledger Lines Above Staff
        'G5' => 90, 'A5' => 85, 'B5' => 80, 'C6' => 75, 'D6' => 70, 'E6' => 65,
    ],
    'bass' => [
        'A3' => 200, // Top line (190 + 10)
        'G3' => 205, 'F3' => 210, 'E3' => 215, // (195 + 10), (200 + 10), (205 + 10)
        'D3' => 220, // Middle line (210 + 10)
        'C3' => 225, 'B2' => 230, 'A2' => 235, 'G2' => 240, // (215 + 10), (220 + 10), (225 + 10), (230 + 10)
        // Ledger Lines Below Staff
        'F2' => 245, 'E2' => 250, 'D2' => 255, 'C2' => 260, // (235 + 10), (240 + 10), (245 + 10), (250 + 10)
        // Ledger Lines Above Staff
        'B3' => 190, 'C4' => 185, // Middle C (180 + 10), (175 + 10)
        'D4' => 190, // (180 + 10)
    ]
];


// Define the range of notes for random selection for each clef.
$treble_random_range = array_keys($note_clef_y_map['treble']);
$bass_random_range = array_keys($note_clef_y_map['bass']);

/**
 * Generates the SVG for a single musical note.
 *
 * @param string $note_name The name of the note (e.g., 'C4', 'F5').
 * @param int $note_x_position The X coordinate for the center of the note head.
 * @param array $note_clef_y_map An associative array mapping clef types to note names to their visual Y-coordinates.
 * @param string $clef_type The type of clef ('treble' or 'bass').
 * @return string The SVG code for the note.
 */
function generateNoteSVG($note_name, $note_x_position, $note_clef_y_map, $clef_type) {
    if (!isset($note_clef_y_map[$clef_type][$note_name])) {
        return "";
    }

    $center_y = $note_clef_y_map[$clef_type][$note_name];
    $baseline_y = $center_y + NOTE_BASELINE_OFFSET;

    // Note head SVG
    $output = "<g class=\"note-group\" data-note=\"{$note_name}\" data-clef=\"{$clef_type}\">";
    $output .= "<text x=\"{$note_x_position}\" y=\"{$baseline_y}\" font-family=\"Bravura\" font-size=\"" . NOTE_FONT_SIZE . "\" fill=\"white\" text-anchor=\"middle\">&#x1D15D;</text>";
    $output .= "</g>";

    return $output;
}

// --- Main Logic ---

// Randomly choose a clef
$clef_choice = (rand(0, 1) == 0) ? 'treble' : 'bass';

// Select a random note based on the chosen clef
$selected_note_name = ($clef_choice == 'treble')
    ? $treble_random_range[array_rand($treble_random_range)]
    : $bass_random_range[array_rand($bass_random_range)];

// Generate the SVG for the selected note
$note_svg_output = generateNoteSVG($selected_note_name, NOTE_X_POSITION, $note_clef_y_map, $clef_choice);
?>

<?php include_once "header.php"; ?>

<h1>Sight-Read</h1>
    <div class="music-container">
        <svg width="1200" height="600" viewBox="0 0 600 300">
            <g id="treble-staff">
                <line x1="50" y1="80" x2="550" y2="80" stroke="white" stroke-width="1" />
                <line x1="50" y1="90" x2="550" y2="90" stroke="white" stroke-width="1" />
                <line x1="50" y1="100" x2="550" y2="100" stroke="white" stroke-width="1" />
                <line x1="50" y1="110" x2="550" y2="110" stroke="white" stroke-width="1" />
                <line x1="50" y1="120" x2="550" y2="120" stroke="white" stroke-width="1" />
            </g>
            <g id="bass-staff">
                <line x1="50" y1="180" x2="550" y2="180" stroke="white" stroke-width="1" />
                <line x1="50" y1="190" x2="550" y2="190" stroke="white" stroke-width="1" />
                <line x1="50" y1="200" x2="550" y2="200" stroke="white" stroke-width="1" />
                <line x1="50" y1="210" x2="550" y2="210" stroke="white" stroke-width="1" />
                <line x1="50" y1="220" x2="550" y2="220" stroke="white" stroke-width="1" />
            </g>

            <line x1="205" y1="230" x2="225" y2="230" stroke="white" stroke-width="1" />
            <line x1="205" y1="240" x2="225" y2="240" stroke="white" stroke-width="1" />
            <line x1="205" y1="70" x2="225" y2="70" stroke="white" stroke-width="1" />
            <line x1="205" y1="60" x2="225" y2="60" stroke="white" stroke-width="1" />
            <line x1="205" y1="130" x2="225" y2="130" stroke="white" stroke-width="1" />
            <line x1="205" y1="170" x2="225" y2="170" stroke="white" stroke-width="1" />

            <path d="M40 80 Q 20 150, 40 220" stroke="white" stroke-width="2" fill="none"/>

            <?php echo $note_svg_output; ?>

            <text x="60" y="115" font-family="Arial, sans-serif" font-size="60" fill="white">&#x1D11E;</text>
            <text x="60" y="225" font-family="Arial, sans-serif" font-size="60" fill="white">&#x1D122;</text>
        </svg>
    </div>
    <p style="color:white; text-align: center;">Randomly selected note: <?php echo $selected_note_name; ?> (Clef: <?php echo ucfirst($clef_choice); ?>)</p>

<?php include_once "footer.php"; ?>