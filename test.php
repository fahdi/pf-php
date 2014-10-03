<?php
include_once('api.php');

echo "<h2>The Tests</h2>";

echo "<br/>Boarding Passes Tests<br/><br/>###########################################################################################<br/><br/><br/>";

echo "Should print:  'Departure: Madrid', 'Arrival:Barcelona', 'Seat:45B', 'Train:78A'";
echo "<br/><br/><br/>print_r(new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'));<br/><br/>###########################################################################################<br/><br/><br/>";
echo "Result:<pre>";
print_r(new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'));
echo "</pre>";

echo "<br/><br/><br/><br/><br/>###########################################################################################<br/><br/>";
echo "Should print:  'Departure: Barcelona', 'Arrival: Gerona Airport' , 'Seat:null'";
echo "<br/><br/><br/>print_r(new AirportBusBoardingPass('Barcelona', 'Gerona Airport'));<br/><br/>###########################################################################################<br/><br/><br/>";
echo "Result:<pre>";
print_r(new AirportBusBoardingPass('Barcelona', 'Gerona Airport'));
echo "</pre>";

echo "<br/><br/><br/><br/><br/>###########################################################################################<br/><br/>";
echo "Should print: 'Departure: Gerona Airport', 'Arrival : Stockholm' , 'Seat : 3A', 'Flight : SK455', 'Gate : 45B', 'Counter : 344'";
echo "<br/><br/><br/>print_r(new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344'));<br/><br/>###########################################################################################<br/><br/><br/>";
echo "Result:<pre>";
print_r(new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344'));
echo "</pre>";

echo "<br/><br/><br/><br/><br/>###########################################################################################<br/><br/>";
echo "Should print: 'Departure: Stockholm', 'Arrival : New York JFK' , 'Seat : 7B', 'Flight : SK22', 'Gate : 22', 'Counter : null'";
echo "<br/><br/><br/>print_r(new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22'));<br/><br/>###########################################################################################<br/><br/><br/>";
echo "Result:<pre>";
print_r(new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22'));
echo "</pre>";


echo "<br/><br/><br/>Trip Object Test:<br/><br/> Created a trip object with unsorted boarding cards. <br/><br/>###########################################################################################<br/><br/><br/>";
echo "
<pre>
$ myTrip = new Trip([
	new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344'),
	new AirportBusBoardingPass('Barcelona', 'Gerona Airport'),
	new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'),
	new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22')
]);
</pre>";
echo "Should print:  [0]: 'Departure: Madrid', 'Arrival:Barcelona', 'Seat:45B', 'Train:78A'<br>";
echo "Should print:  [1]: 'Departure: Barcelona', 'Arrival: Gerona Airport' , 'Seat:null'<br>";
echo "Should print:  [2]: 'Departure: Gerona Airport', 'Arrival : Stockholm' , 'Seat : 3A', 'Flight : SK455', 'Gate : 45B', 'Counter : 344'<br>";
echo "Should print:  [3]: 'Departure: Stockholm', 'Arrival : New York JFK' , 'Seat : 7B', 'Flight : SK22', 'Gate : 22', 'Counter : null'<br>";

echo "<br/><br/>###########################################################################################<br/><br/><br/>";

$myTrip = new Trip([
	new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344'),
	new AirportBusBoardingPass('Barcelona', 'Gerona Airport'),
	new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'),
	new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22')
]);


echo "Result:<pre>";
print_r($myTrip);
echo "</pre>";


echo "<br/><br/><br/><br/><br/>###########################################################################################<br/><br/>";


?>
