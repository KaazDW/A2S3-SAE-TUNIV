<?php

// Initialize an array to store the tournament teams
$teams = array();

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Retrieve the list of teams from the form
  $teamList = $_POST['teams'];

  // Explode the team list into an array of individual team names
  $teams = explode(',', $teamList);

  // Shuffle the array of teams to randomize the order
  shuffle($teams);

  // Calculate the number of matches that need to be played
  $numMatches = count($teams) / 2;

  // Initialize an array to store the matches
  $matches = array();

  // Loop through the number of matches
  for ($i = 0; $i < $numMatches; $i++) {
    // Create a new match with the current teams
    $matches[] = array(
      $teams[$i],
      $teams[count($teams) - 1 - $i]
    );
  }
}

?>

<!-- Create a form to input the teams for the tournament -->
<form method="POST">
  <label>Enter the names of the teams, separated by commas:</label>
  <input type="text" name="teams">
  <input type="submit" name="submit" value="Create tournament">
</form>

<!-- Display the matches for the tournament, if available -->
<?php if (isset($matches)): ?>
  <h3>Tournament matches:</h3>
  <ul>
    <?php foreach ($matches as $match): ?>
      <li><?php echo implode(' vs. ', $match); ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
