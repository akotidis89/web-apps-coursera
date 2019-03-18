<!DOCTYPE html>
<head><title>Anestis Kotidis MD5 Cracker</title></head>
<body>
<h1>MD5 cracker - Anestis Kotidis</h1>
<p>This application takes an MD5 hash
of a four-digit PIN and 
attempts to hash all four-digit combinations
to determine the original PIN.</p>
<pre>
Debug Output:
<?php
$goodtext = "Not found";
// If there is no parameter, this code is all skipped
if ( isset($_GET['md5']) ) {
	$time_pre = microtime(true);
	$md5 = $_GET['md5'];

	// This is our digits
	$digits = "0123456789";
	$show = 15;

	// Outer loop to go through the digits for the
	// first position in our "possible" pre-hash
	// PIN
	for($i=0; $i<strlen($digits); $i++ ) {
		$ch1 = $digits[$i];   // Our first digit

		// Our inner loop Not the use of new variables
		// $j and $ch2 
		for($j=0; $j<strlen($digits); $j++ ) {
			$ch2 = $digits[$j];  // Our second digit

			for ($k = 0; $k < strlen($digits); $k++) {
				$ch3 = $digits[$k];	// Our third digit

				for ($m = 0; $m < strlen($digits); $m++) {
					$ch4 = $digits[$m];	// Our final digit

					// Concatenate the four digits together to form the "possible" pre-hash text
					$try = $ch1.$ch2.$ch3.$ch4;

					// Run the hash and then check to see if we match
					$check = hash('md5', $try);
					if ( $check == $md5 ) {
					$goodtext = $try;
					break;   // Exit the inner loop
					}

					// Debug output until $show hits 0
					if ( $show > 0 ) {
					print "$check $try\n";
					$show = $show - 1;
					}
				}
			}
		}
	}

	// Compute elapsed time
	$time_post = microtime(true);
	print "Elapsed time: ";
	print $time_post-$time_pre;
	print "\n";
}
?>
</pre>
<!-- Use the very short syntax and call htmlentities() -->
<p>Original PIN: <?= htmlentities($goodtext); ?></p>
<form>
	<input type="text" name="md5" size="40" />
	<input type="submit" value="Crack MD5"/>
</form>
<ul>
	<li><a href="index.php">Reset</a></li>
	<li><a href="md5.php">MD5 Encoder</a></li>
	<li><a href="makecode.php">MD5 Code Maker</a></li>
	<li><a href="https://github.com/csev/wa4e/tree/master/code/crack" target="_blank">Source code for this application</a></li>
</ul>
</body>
</html>
