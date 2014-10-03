<?php
/**
 * Trip sorter API main file
 * 
 * This file has the whole sorting algorithm for boarding cards. 
 * It has three classes
 * One for generic main Boarding Pass named BoardingPass ( Base class)
 * One for Train Boarding Pass named TrainBoardingPass which inherits from main BoardingPass class 
 * One for AirportBusBoardingPass which inherits from main BoardingPass class 
 * One for 
 * 
 * This fi
 */
if(count(get_included_files()) ==1) exit("Direct access not permitted. Please refer to the docs provided with your API");
ini_set('memory_limit', '-1');

/**
 * Boarding pass
 * This base class will implement all the properties and methods
 * that are common to all modes of transportation.
 *
 * Each mode of transportation will extend BoardingPass
 * and add properties and methods that are specific
 * to that particular mode of transportation. Sweet!
 */
class BoardingPass
{
// properties declaration

	private $departureLocation = '';
	private $arrivalLocation = '';
	private $seat = '';

	function __construct($departureLocation, $arrivalLocation, $seat)
	{
		$this->departureLocation = $departureLocation;
		$this->arrivalLocation = $arrivalLocation;
		$this->seat = $seat;

// "$this" is implicitly returned.
	}

	public function BoardingPass($departureLocation, $arrivalLocation, $seat)
	{

		$this->departureLocation = $departureLocation;
		$this->arrivalLocation = $arrivalLocation;
		$this->seat = $seat;

// "$this" is implicitly returned.
	}

// Since the properties $departureLocation and $arrivalLocation are meant to be private, 
// we need to provide public getter methods.

	/**
	 * A summary informing the user what the associated element does.
	 *
	 * A *description*, that can span multiple lines, to go _in-depth_ into the details of this element
	 * and to provide some background information or textual references.
	 *
	 * @param  $obj With a *description* of this argument, these may also
	 *    span multiple lines.
	 *
	 * @return $obj->departureLocation
	 */

	public static function getDepartureLocation($obj)
	{
		return $obj->departureLocation;
	}

	/**
	 * A summary informing the user what the associated element does.
	 *
	 * A *description*, that can span multiple lines, to go _in-depth_ into the details of this element
	 * and to provide some background information or textual references.
	 *
	 * @param  $obj With a *description* of this argument, these may also
	 *    span multiple lines.
	 *
	 * @return $obj->arrivalLocation
	 */
	public static function getArrivalLocation($obj)
	{
		return $obj->arrivalLocation;
	}

}

/**
 * Train boarding pass.
 */
class TrainBoardingPass extends BoardingPass
{
	private $train;
// We need to explicitly call the "super" constructor. 
// Then we handle the stuff specific to trains. 

	function __construct($departureLocation, $arrivalLocation, $seat, $train)
	{
// This is the step that creates the inheritance chain,
// so TrainBoardingPass inherits from BoardingPass.
		parent::__construct($departureLocation, $arrivalLocation, $seat);
//print "<br/>In Train Boarding Passs constructor\n";
		$this->train = $train;
	}

// Define how to convert a train boarding pass to a string. 
	function TrainBoardingPassString()
	{
		return 'Take train ' . $this->train . ' from ' . $this->departureLocation . ' to ' . $this->arrivalLocation . '. Sit in $seat ' . $this->seat . '.';
	}

}

/**
 * Airport Bus Boarding Pass. As asked for.
 */
class AirportBusBoardingPass extends BoardingPass
{
	function __construct($departureLocation, $arrivalLocation, $seat = null)
	{
		parent::__construct($departureLocation, $arrivalLocation, $seat);
//print "<br/>In Airport Boarding Passs constructor\n";
	}

/**
* There doesn't seem to be any case specific to airport buses. But its for the follwing reason in requirements
* 3. Be prepared to suggest to us how we could extend the code towards new types of transportation, which might have different characteristics.	
* Nonetheless, we create this "class" for completeness. And later code completely if needed
*/


	function AirportBusBoardingPassString()
	{
		return 'Take the airport bus from ' . $this->departureLocation . ' to ' . $this->arrivalLocation . '. ' . ($this->seat ? 'Sit in seat ' . $this->seat . '.' : 'No seat assignment.');
	}

}


/**
 * Flight boarding pass.
 */
class FlightBoardingPass extends BoardingPass
{
	private $flight, $gate, $counter;
	function __construct($departureLocation, $arrivalLocation, $seat, $flight, $gate, $counter = null)
	{
		parent::__construct($departureLocation, $arrivalLocation, $seat);

		$this->flight = $flight;
		$this->gate = $gate;
		$this->counter = $counter;

//print "<br/>In Flight Boarding Passs constructor\n";
	}

	public function FlightBoardingPass($departureLocation, $arrivalLocation, $seat, $flight, $gate, $counter = '')
	{
//BoardingPass($this, $departureLocation, $arrivalLocation, $seat);

		$this->flight = $flight;
		$this->gate = $gate;
		$this->counter = $counter;
	}

//$FlightBoardingPass = new BoardingPass();

	function FlightBoardingPassString()
	{
		return 'From ' . $this->departureLocation . ', take flight ' . $this->flight . ' to ' . $this->$arrivalLocation . '. Gate ' . $this->gate . ', seat ' . $this->seat . '. ' . ($this->counter ? 'Baggage drop at ticket counter ' . $this->counter . '.' : 'Baggage will be automatically transferred from your last leg.');
	}

}

/**
 * The trip sorter "class".
 */
class TripSorter
{
	function TripSorter($boardingPasses) {
		$this->boardingPasses = $boardingPasses;
	}

// This is the main sorting thing
	public function sort()
	{

// Index the departure and arrival locations for fast lookup.
// This indexing step takes O(n) time.
		self::createIndex();

// This next step also takes O(n) time.
		$startingLocation = self::getStartingLocation();

// From the starting location, traverse the boarding passes, creating a sorted list as we go.
// This step takes O(n) time.
		$sortedBoardingPasses = array();
		$currentLocation = $startingLocation;
// Assign respective boarding pass while checking for undefined index
		while ($currentBoardingPass = (array_key_exists($currentLocation,$this->departureIndex))? $this->departureIndex[$currentLocation] : null ) {
			/*
			* echo "current location".$currentLocation."<br/>";
			* echo "Current Boarding Passs<pre>";
			* print_r($currentBoardingPass); // This needs fixing
			* echo "</pre>";
			*/
			$currentBoardingPass;
// Add the boarding pass to our sorted list.
			array_push($sortedBoardingPasses, $currentBoardingPass);

// Get our next location.
			$currentLocation = boardingPass::getArrivalLocation($currentBoardingPass);
		}

// After O(3n) operations, we can now return the sorted boarding passes.
		return $sortedBoardingPasses;
	}

	

	function createIndex()
	{
		$departureIndex = array();
		$arrivalIndex = array();

		for ($counter = 0; $counter < count($this->boardingPasses); $counter++) {
// Assign a single boarding pass each time to the respective variable
			$boardingPass = $this->boardingPasses[$counter];

			/*
			// This was to see if values are assigned properly
			echo "Single Boarding Pass<pre>";
			print_r($boardingPass);
			echo "</pre>";
			*/

			$this->departureIndex[boardingPass::getDepartureLocation($boardingPass)] = $boardingPass;
			$this->arrivalIndex[boardingPass::getArrivalLocation($boardingPass)] = $boardingPass;
		}

		/*
		// This was to see if values are assigned properly
		echo "Departure Index:<pre>";
			print_r($this->departureIndex);
		echo "</pre>";
		*/

		/*
		// This was to see if values are assigned properly
		echo "Arrival Index:<pre>";
			print_r($this->arrivalIndex);
		echo "</pre>";	
		*/
		
	}


	private function getStartingLocation()
	{

		for ($counter = 0; $counter < count($this->boardingPasses); $counter++) {
			
// A shortcut, I am not proud of it
			$departureLocation = boardingPass::getDepartureLocation($this->boardingPasses[$counter]);
			
// The starting location is a place we depart from but never arrived at, sweet!
			if (!array_key_exists($departureLocation,$this->arrivalIndex)) {
				//echo  "Starting Location:". $departureLocation;
				return $departureLocation;
			}
		}
	}
}

/**
 * A trip "class" can keep a collection of all the boarding passes
 * associated with a particular trip.
 */
class Trip
{


	public function __construct($boardingPasses)
	{
		// All unordered
		$this->boardingPasses = $boardingPasses;

// Trip uses TripSorter to make sure everything is in order. 
		$boardingPasses = new TripSorter($this->boardingPasses);

// Sort it
		 $this->boardingPasses = $boardingPasses->sort(); // Send the complete array to the sort function

	}

// Define how to convert a trip to a string. 
	public function TripString()
	{
// Convert each boarding pass to a string, and concatenate them together. 
		$str = '';
		for ($i = 0; $i < count($this->boardingPasses); $i++) {
			$str .= (string)$this->boardingPasses[$i]. '\n';
		}

// Final greetings. 
		$str .= 'You have arrived at your final destination.\n';

		return $str;
	}

}


?>