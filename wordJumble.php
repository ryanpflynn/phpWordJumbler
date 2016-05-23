<?php

  /*-------------------
  Ryan Flynn
  ryanflynn.us
  --------------------*/

  //Define variables
  //$input = $_POST['input'];
  $input = $argv[1];
  $newPuzzle = '';
  $jumbledWords = array();
  $words = array();
  $response = array();

  //cleanse the input
  $input = trim($input);
  $input = strtoupper($input);
  $input = strip_tags($input);
  $input = preg_replace('/[^a-z ]+/i', '', $input);
  $input = preg_replace("/\s\s+/i", ' ', $input);

  //Main process
  //break the string into words
  $words[] = explode(' ', $input);

for ($i = 0; $i < sizeof($words[0]); ++$i) {
    $piece = $words[0][$i];
    $newPuzzle = $newPuzzle.(jumbleTheWord($piece)).' ';
}

$newPuzzle = trim($newPuzzle);
$response['puzzle'] = $newPuzzle;
$response['answer'] = $input;
echo json_encode($response);
echo "\n";

  //Functions
function jumbleTheWord($word)
{
    $letters = str_split($word);
    $count = sizeof($letters);
    $sizeOfWord = $count;
    $newWord = '';
    $misses = 0;

    while ($count > 0) {
        $selection = rand(0, $count - 1);
        if (isset($letters[$selection])) {
            $newWord = $newWord.$letters[$selection];
            array_splice($letters, $selection, 1);
            $count--;
        }else{
          $misses++;
        }
    }
    while ($newWord == $word && strlen($word) > 1) {
        $newWord = jumbleTheWord($word);
    }
    return $newWord;
}
