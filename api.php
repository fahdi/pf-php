<?php
/**
 * Trip sorter API main file
 *
 * This file has the whole sorting algorithm for boarding cards.
 * It has a few classes:
 * One for generic main Boarding Pass named BoardingPass ( Base class)
 * One for Train Boarding Pass named TrainBoardingPass which inherits from main BoardingPass class
 * One for Airport Bus Boarding Pass named AirportBusBoardingPass  which inherits from main BoardingPass class
 * One for Flight Boarding Pass named accordingly which inherits from main BoardingPass class
 * One named TripSorter which sorts a group of Boarding Passes
 * One named Trip which creates an object containing mutiple boarding passes. Trip uses Tripsorter to get sorted results.
 *
 */

/**
 * Turn on error reporting.
 */
error_reporting(E_ALL);

/**
 * Disallow direct access to the file
 */
if (count(get_included_files()) == 1) exit("Direct access not permitted. Please refer to the docs provided with your API");

/**
 * Give PHP unlimited memory, feed the monster!
 */
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

	/**
	 * BoardingPass Constructor
	 */
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
	 * Takes an object of any class inheriting from BoardingPass and returns departure location
	 *
	 * Takes an object of any class inheriting from BoardingPass and returns departure location
	 * Return the property departureLocation of an object of a child class with parent being 'BoardingPass'
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
	 * Takes an object of any class inheriting from BoardingPass and returns arrival location
	 *
	 * Takes an object of any class inheriting from BoardingPass and returns arrival location
	 * Return the property arrivalLocation of an object of a child class with parent being 'BoardingPass'
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

	/**
	 * Takes an object of a  class containing seat information,  inheriting from BoardingPass and returns seat #
	 *
	 * Takes an object of any class with additional seat property, inheriting from BoardingPass and returns returns seat #
	 * Return the property seat of an object of a child class with parent being 'BoardingPass'
	 *
	 * @param  $obj With a *description* of this argument, these may also
	 *    span multiple lines.
	 *
	 * @return $obj->seat;
	 */
	public static function getSeat($obj)
	{
		return $obj->seat;
	}

}

/**
 * Train boarding pass. Child of BoardingPass. Adds train information to the basic boarding pass.
 */
class TrainBoardingPass extends BoardingPass
{
	private $train;
// We need to explicitly call the "super" constructor. 
// Then we handle the stuff specific to trains. 
	/**
	 * Constructor for TrainBoardingPass
	 */
	function __construct($departureLocation, $arrivalLocation, $seat, $train)
	{
// This is the step that creates the inheritance chain,
// so TrainBoardingPass inherits from BoardingPass.
		parent::__construct($departureLocation, $arrivalLocation, $seat);
//print "<br/>In Train Boarding Passs constructor\n";
		$this->train = $train;
	}

// Define how to convert a train boarding pass to a string.
	/**
	 * Converts an object of TrainBoardingPass into human readable instruction set. This relates to only trains.
	 *
	 */
	public function toString()
	{
		return 'Take train ' . $this->train . ' from ' . boardingPass::getDepartureLocation($this) . ' to ' . boardingPass::getarrivalLocation($this) . '. Sit in seat ' . boardingPass::getSeat($this) . '.';
	}

}

/**
 * Airport Bus Boarding Pass. As asked for.
 */
class AirportBusBoardingPass extends BoardingPass
{
	/**
	 * Constructor for AirportBusBoardingPass
	 */
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

	/**
	 * Converts an object of AirportBusBoardingPass into human readable instruction set. This relates to only Airport passes.
	 *
	 */
	public function toString()
	{
		return 'Take the airport bus from ' . boardingPass::getDepartureLocation($this) . ' to ' . boardingPass::getarrivalLocation($this) . '. ' . (boardingPass::getSeat($this) ? 'Sit in seat ' . boardingPass::getSeat($this) . '.' : 'No seat assignment.');
	}

}


/**
 * Flight boarding pass.
 */
class FlightBoardingPass extends BoardingPass
{
	private $flight, $gate, $counter;

	/**
	 * Constructor for FlightBoardingPass
	 */
	function __construct($departureLocation, $arrivalLocation, $seat, $flight, $gate, $counter = null)
	{
		parent::__construct($departureLocation, $arrivalLocation, $seat);

		$this->flight = $flight;
		$this->gate = $gate;
		$this->counter = $counter;

//print "<br/>In Flight Boarding Passs constructor\n";
	}

//$FlightBoardingPass = new BoardingPass();

	/**
	 * Converts an object of FlightBoardingPass into human readable instruction set. This relates to only Flight boarding passes.
	 *
	 */
	public function toString()
	{
		return 'From ' . boardingPass::getDepartureLocation($this) . ', take flight ' . $this->flight . ' to ' . boardingPass::getarrivalLocation($this) . '. Gate ' . $this->gate . ', seat ' . boardingPass::getSeat($this) . '. ' . ($this->counter ? 'Baggage drop at ticket counter ' . $this->counter . '.' : 'Baggage will be automatically transferred from your last leg.');
	}

}

/**
 * The trip sorter "class". Contains all the sorting algorithm for n number of of boarding passes.
 */
class TripSorter
{
	/**
	 * Constructor for TripSorter
	 */
	function TripSorter($boardingPasses)
	{
		$this->boardingPasses = $boardingPasses;
	}

	/**
	 * Function to sort n number of boarding passes each within a single key of an array.
	 * So essentially an object of type TripSorter is a re-initialized Trip object.
	 *
	 * @param $this
	 *
	 * @return $sortedBoardingPasses
	 */
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
		while ($currentBoardingPass = (array_key_exists($currentLocation, $this->departureIndex)) ? $this->departureIndex[$currentLocation] : null) {
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

	/**
	 * This function creates associative arrays of the randomly arranged boarsing pases.
	 * So essentially an object of type TripSorter is a re-initialized Trip object.
	 */
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
			if (!array_key_exists($departureLocation, $this->arrivalIndex)) {
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

	/**
	 * Constructor
	 */
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
		$str = '<ol>';
		for ($counter = 0; $counter < count($this->boardingPasses); $counter++) {
			$currentPass = $this->boardingPasses[$counter];
			$currentClass = get_class($currentPass);
			$str .= '<li>' . $currentPass->toString() . '</li>' . PHP_EOL;
		}

// Final greetings. 
		$str .= '<li>You have arrived at your final destination.</li>' . PHP_EOL;
		$str .= '</ul>';
		return $str;
	}

}

?>