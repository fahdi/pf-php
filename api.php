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
 * One named Trip which creates an object containing multiple boarding passes. Trip uses TripSorter to get sorted results.
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
 *
 * @property-read string $departureLocation Departing point for a boarding pass. Origin of the traveller
 *
 * @property-read string $arrivalLocation Arrival Location for a boarding pass. This is the destination point for one leg of trip, for a traveller
 *
 * @property-read string $seat Seat # for a boarding pass, common to all kinds of boarding passes
 */
class BoardingPass
{
	/**
	 *  properties initialization for BoardingPass
	 */

	private $departureLocation = '';
	/**
	 * @property-read string $arrivalLocation Arrival Location for a boarding pass. This is the destination point for one leg of trip, for a traveller
	 */
	private $arrivalLocation = '';
	/**
	 * @property-read string $seat Seat # for a boarding pass, common to all kinds of boarding passes
	 */
	private $seat = '';

	/**
	 * BoardingPass Constructor
	 *
	 * @param string $departureLocation Departing point for a boarding pass. Origin of the traveller
	 * @param string $arrivalLocation Arrival Location for a boarding pass. This is the destination point for one leg of trip, for a traveller
	 * @param string $seat Seat # for a boarding pass, common to all kinds of boarding passes
	 */
	function __construct($departureLocation, $arrivalLocation, $seat)
	{
		$this->departureLocation = $departureLocation;
		$this->arrivalLocation = $arrivalLocation;
		$this->seat = $seat;

		/*
		* '$this' is implicitly returned.
		*/
	}

	/*
	 *  Since the properties $departureLocation and $arrivalLocation are meant to be private,
	 *
	 * we need to provide public getter methods.
	 *
	 */

	/**
	 * Takes an object of any class inheriting from BoardingPass and returns departure location
	 *
	 * Takes an object of any class inheriting from BoardingPass and returns departure location
	 * Return the property departureLocation of an object of a child class with parent being 'BoardingPass'
	 *
	 * @param BoardingPass $obj An object of any child class that inherits from BoardingPass will be able to call
	 * this static function.
	 *
	 * @return string $obj->departureLocation Departure location for any boarding pass
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
	 * @param BoardingPass $obj An object of any child class that inherits from BoardingPass will be able to call
	 * this static function.
	 *
	 * @return string $obj->arrivalLocation Arrival location for any boarding pass
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
	 * @param BoardingPass $obj With a *description* of this argument, these may also
	 *    span multiple lines.
	 *
	 * @return string $obj->seat The seat # for a boarding pass
	 */
	public static function getSeat($obj)
	{
		return $obj->seat;
	}

}

/**
 * Train boarding pass. Child of BoardingPass. Adds train information to the basic boarding pass.
 */

/**
 * Class TrainBoardingPass*
 *
 * @property-write string $train Train # on the train boarding pass
 */
class TrainBoardingPass extends BoardingPass
{
	private $train;
	/*
	 *  We need to explicitly call the "super" constructor.
	 * Then we handle the stuff specific to trains.
	 */

	/**
	 * Constructor for TrainBoardingPass
	 *
	 * @param string $departureLocation Departing point for a boarding pass. Origin of the traveller
	 * @param string $arrivalLocation Arrival Location for a boarding pass. This is the destination point for one leg of trip, for a traveller
	 * @param string $seat Seat # for a boarding pass, common to all kinds of boarding passes
	 * @param string $train This denotes train # for a train boarding pass
	 */
	function __construct($departureLocation, $arrivalLocation, $seat, $train)
	{
		/*
		 *  This is the step that creates the inheritance chain,
		 *  so TrainBoardingPass inherits from BoardingPass.
		 */

		parent::__construct($departureLocation, $arrivalLocation, $seat);

		$this->train = $train;
	}

	/**
	 * Converts an object of TrainBoardingPass into human readable instruction set. This relates to only trains.
	 *
	 */
	public function toString()
	{
		/** @var $this TrainBoardingPass */
		return 'Take train ' . $this->train . ' from ' . boardingPass::getDepartureLocation($this) . ' to ' . boardingPass::getarrivalLocation($this) . '. Sit in seat ' . boardingPass::getSeat($this) . '.';
	}

}

/**
 * Airport Bus Boarding Pass.
 *     * There does not seem to be any case specific to airport buses. But its for the following reason in requirements
 * 3. Be prepared to suggest to us how we could extend the code towards new types of transportation, which might have different characteristics.
 * Nonetheless, we create this "class" for completeness. And later code completely if needed
 */
class AirportBusBoardingPass extends BoardingPass
{
	/**
	 * Constructor for AirportBusBoardingPass
	 */

	/**
	 * Constructor for TrainBoardingPass
	 *
	 * @param string $departureLocation Departing point for a boarding pass. Origin of the traveller
	 * @param string $arrivalLocation Arrival Location for a boarding pass. This is the destination point for one leg of trip, for a traveller
	 * @param string $seat Seat # for a boarding pass, common to all kinds of boarding passes
	 */
	function __construct($departureLocation, $arrivalLocation, $seat = null)
	{
		parent::__construct($departureLocation, $arrivalLocation, $seat);

	}

	/**
	 * There does not seem to be any case specific to airport buses. But its for the following reason in requirements
	 * 3. Be prepared to suggest to us how we could extend the code towards new types of transportation, which might have different characteristics.
	 * Nonetheless, we create this "class" for completeness. And later code completely if needed
	 */

	/**
	 * Converts an object of AirportBusBoardingPass into human readable instruction set. This relates to only Airport passes.
	 */
	public function toString()
	{
		/** @var $this AirportBusBoardingPass */
		return 'Take the airport bus from ' . boardingPass::getDepartureLocation($this) . ' to ' . boardingPass::getarrivalLocation($this) . '. ' . (boardingPass::getSeat($this) ? 'Sit in seat ' . boardingPass::getSeat($this) . '.' : 'No seat assignment.');
	}

}


/**
 * Flight boarding pass which extends BoardingPass
 * Adds additional properties to BoardingPass i.e flight #, gate # (to reach the airport flight bus), airport counter # etc (for luggage drop off)
 *
 * @property-read string $flight Each flight has a flight number
 * @property-read string $gate The gate # to reach the airport flight bus
 * @property-read string $counter which is used in case some one drops off luggage. This can't always be the case ( web check in for example)
 */
class FlightBoardingPass extends BoardingPass
{
	private $flight, $gate, $counter;

	/**
	 * Constructor for FlightBoardingPass
	 *
	 * @param string $departureLocation Each flight boarding pass has a departure location, an origin airport for example
	 * @param string $arrivalLocation Each flight boarding pass has a arrival location, a destination airport for example
	 * @param string $seat A flight boarding pass has a seat # assigned to it. On rare occasions, the passenger makes a choice
	 * @param string $flight Each flight has a flight number
	 * @param string $gate The gate # to reach the airport flight bus
	 * @param string $counter which is used in case some one drops off luggage. This can't always be the case ( web check in for example)
	 *
	 */
	function __construct($departureLocation, $arrivalLocation, $seat, $flight, $gate, $counter = null)
	{
		/**
		 * Call constructor of the parent class
		 */
		parent::__construct($departureLocation, $arrivalLocation, $seat);

		$this->flight = $flight;
		$this->gate = $gate;
		$this->counter = $counter;

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
 *
 *
 * @property $arrivalIndex An associative array with the arrival locations being the key for the arrays
 * @property $departureIndex An associative array with the departure locations being the key for the arrays
 */
class TripSorter
{
	private $arrivalIndex = array();
	private $departureIndex = array();

	/**
	 * Constructor for TripSorter. It takes a Trip object and sorts the internal objects
	 *
	 * @param array $boardingPasses It is an array of objects each of different type of Boarding passes.
	 */
	function TripSorter($boardingPasses)
	{
		$this->boardingPasses = $boardingPasses;
	}

	/**
	 * Function to sort n number of boarding passes each within a single key of an array.
	 * So essentially an object of type TripSorter is a re-initialized Trip object.
	 *
	 * @internal param $this
	 *
	 * @return array $sortedBoardingPasses
	 */
	public function sort()
	{

		/*
		 * This indexing step takes O(n) time.
		 *
		 *  Index the departure and arrival locations for fast lookup.
		*/
		self::createIndex();
		/*
		 * This next step also takes O(n) time.
		 */
		$startingLocation = self::getStartingLocation();

		/*
		 *  From the starting location, traverse the boarding passes, creating a sorted list as we go.
		 *
		 * This step takes O(n) time.
		 */

		$sortedBoardingPasses = array();
		$currentLocation = $startingLocation;
		/*
		 * Assign respective boarding pass while checking for undefined index
		 */

		while ($currentBoardingPass = (array_key_exists($currentLocation, $this->departureIndex)) ? $this->departureIndex[$currentLocation] : null) {
			/*
			* echo "current location".$currentLocation."<br/>";
			* echo "Current Boarding Pass<pre>";
			* print_r($currentBoardingPass);
			* echo "</pre>";
			*/

			/*
			 *  Add the boarding pass to our sorted list.
			 */
			array_push($sortedBoardingPasses, $currentBoardingPass);

			/*
			 *  Get our next location.
			 */
			$currentLocation = boardingPass::getArrivalLocation($currentBoardingPass);
		}

		/*
		 * After O(3n) operations, we can now return the sorted boarding passes.
		 */
		return $sortedBoardingPasses;
	}

	/**
	 * This function creates two associative arrays of the randomly arranged boarding passeS
	 * One with the departure locations being the key for the arrays
	 * The other with the arrival locations being the key for the arrays
	 * So essentially an object of type TripSorter is a re-initialized Trip object.
	 */
	function createIndex()
	{

		for ($counter = 0; $counter < count($this->boardingPasses); $counter++) {
			/*
			 *  Assign a single boarding pass each time to the respective variable
			 */
			$boardingPass = $this->boardingPasses[$counter];

			/*
			* This was to see if values are assigned properly
			echo "Single Boarding Pass<pre>";
			print_r($boardingPass);
			echo "</pre>";
			*/

			$this->departureIndex[boardingPass::getDepartureLocation($boardingPass)] = $boardingPass;
			$this->arrivalIndex[boardingPass::getArrivalLocation($boardingPass)] = $boardingPass;
		}

		/*
		* This was to see if values are assigned properly
		echo "Departure Index:<pre>";
			print_r($this->departureIndex);
		echo "</pre>";
		*/

		/*
		* This was to see if values are assigned properly
		echo "Arrival Index:<pre>";
			print_r($this->arrivalIndex);
		echo "</pre>";	
		*/

	}

	/*
	* based on the idea that the starting location is never set as arrival location
	 * returns the first departure location, which also is the starting location
	 *
	 * @return string $departureLocation which contains the starting location for the whole trip
	 */

	private function getStartingLocation()
	{

		for ($counter = 0; $counter < count($this->boardingPasses); $counter++) {

			/*
			 *  A shortcut, I am not proud of it
			 */
			$departureLocation = boardingPass::getDepartureLocation($this->boardingPasses[$counter]);

			/*
			 * The starting location is a place we depart from but never arrived at, sweet!
			 */

			if (!array_key_exists($departureLocation, $this->arrivalIndex)) {
				//echo  "Starting Location:". $departureLocation;
				return $departureLocation;
			}
		}
		return null; // Just in case one needs to implement cross checking for broken legs in the Trip
	}
}

/**
 * A trip "class" can keep a collection of all the boarding passes
 * associated with a particular trip.
 *
 */
class Trip
{

	/**
	 * Constructor
	 *
	 * @param stdClass $boardingPasses an array of objects each of different type of Boarding passes.
	 *
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

	/**
	 * Define how to convert a trip to a string. This function takes an object of class 'Trip' and converts each
	 * boarding pass within it's object to a string using the object's respective class' toString() method
	 *
	 *
	 * @return string  $str  Complete string for the whole human readable instructions each
	 * created individually for all boarding passes.
	 */

	public function TripString()
	{
		/**
		 *Convert each boarding pass to a string, and concatenate them together.
		 */
		$str = '<ol>';
		for ($counter = 0; $counter < count($this->boardingPasses); $counter++) {
			$currentPass = $this->boardingPasses[$counter];
			//$currentClass = get_class($currentPass);
			$str .= '<li>' . $currentPass->toString() . '</li>' . PHP_EOL;
		}

		/*
		 *  Final greetings.
		 */
		$str .= '<li>You have arrived at your final destination.</li>' . PHP_EOL;
		$str .= '</ul>';
		return $str;
	}

}

?>