<?php

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

    function __construct()
    {
        print "In BoardingPass constructor\n";
    }

    public function BoardingPass($departureLocation, $arrivalLocation, $seat)
    {
// JavaScript doesn't let us enforce property visibility (such as private or protected), 
// so we use a leading underscore to mark properties that should be treated as private. 
        $this->departureLocation = $departureLocation;
        $this->arrivalLocation = $arrivalLocation;
        $this->seat = $seat;

// "this" is implicitly returned. 
    }

// Since the properties $departureLocation and $arrivalLocation are meant to be private, 
// we need to provide public getter methods. 
    public function getDepartureLocation()
    {
        return $this->departureLocation;
    }

    public function getArrivalLocation()
    {
        return $this->arrivalLocation;
    }

}

/**
 * Train boarding pass.
 */
class TrainBoardingPass extends BoardingPass
{

    function __construct()
    {
        parent::__construct();
        print "<br/>In Train Boarding Passs constructor\n";
    }

    function TrainBoardingPass($departureLocation, $arrivalLocation, $seat, $train)
    {
// We need to explicitly call the "super" constructor. 
//BoardingPass($departureLocation, $arrivalLocation, $seat);

// Then we handle the stuff specific to trains. 
        $this->train = $train;
    }

// This is the step that creates the inheritance chain,
// so TrainBoardingPass inherits from BoardingPass.

//$TrainBoardingPass = new BoardingPass();

// Define how to convert a train boarding pass to a string. 
    function TrainBoardingPasstoString()
    {
        return 'Take train ' . $this->train . ' from ' . $this->departureLocation . ' to ' . $this->arrivalLocation . '. Sit in $seat ' . $this->seat . '.';
    }

}

/**
 * Airport Bus Boarding Pass
 */
class AirportBusBoardingPass extends BoardingPass
{
	function __construct()
	{
		parent::__construct();
		print "<br/>In Airport Boarding Passs constructor\n";
	}


    function AirportBusBoardingPass($departureLocation, $arrivalLocation, $seat)
    {
        // BoardingPass($this, $departureLocation, $arrivalLocation, $seat);

// There doesn't seem to be any case specific to airport buses.
// Nonetheless, we create this "class" for completeness. And later code if needed
    }

//$AirportBusBoardingPass = new BoardingPass;

    function AirportBusBoardingPasstoString()
    {
        return 'Take the airport bus from ' . $this->departureLocation . ' to ' . $this->arrivalLocation . '. ' . ($this->seat ? 'Sit in seat ' . $this->seat . '.' : 'No seat assignment.');
    }

}


/**
 * Flight boarding pass.
 */
class FlightBoardingPass extends BoardingPass
{
    public function FlightBoardingPass($departureLocation, $arrivalLocation, $seat, $flight, $gate, $counter='')
    {
        //BoardingPass($this, $departureLocation, $arrivalLocation, $seat);

        $this->flight = $flight;
        $this->gate = $gate;
        $this->counter = $counter;
    }

//$FlightBoardingPass = new BoardingPass();

    function FlightBoardingPasstoString()
    {
        return 'From ' . $this->departureLocation . ', take flight ' . $this->flight . ' to ' . $this->$arrivalLocation . '. Gate ' . $this->gate . ', seat ' . $this->seat . '. ' . ($this->counter ? 'Baggage drop at ticket counter ' . $this->counter . '.' : 'Baggage will be automatically transferred from your last leg.');
    }

}

/**
 * The trip sorter "class".
 */

class TripSorter
{

    public function TripSorter($boardingPasses)
    {
        private $this->boardingPasses = $boardingPasses;

        /*
        }

        // This is the meat of the algorithm.
        function TripSorter() {

        */
// Index the departure and arrival locations for fast lookup. 
// This indexing step takes O(n) time. 
        $this->createIndex();

// This next step also takes O(n) time. 
        $startingLocation = $this->getStartingLocation();

// From the starting location, traverse the boarding passes, creating a sorted list as we go. 
// This step takes O(n) time. 
        $sortedBoardingPasses = [];
        $currentLocation = $startingLocation;
        $currentBoardingPass;

        while ($currentBoardingPass = $this->departureIndex[$currentLocation]) {
// Add the boarding pass to our sorted list. 
            $sortedBoardingPasses . push($currentBoardingPass);

// Get our next location. 
            $currentLocation = $currentBoardingPass . getArrivalLocation();
        }

// After O(3n) operations, we can now return the sorted boarding passes. 
        return $sortedBoardingPasses;
    }

    private function createIndex()
    {
        private $this->departureIndex = array();
        private $this->arrivalIndex = array();

        for ($i = 0; $i < count($this->boardingPasses); $i++) {
// A shortcut 
            $boardingPass = $this->boardingPasses[$i];

            $this->departureIndex[getDepartureLocation($boardingPass)] = $boardingPass;
            $this->arrivalIndex[getArrivalLocation($boardingPass)] = $boardingPass;
        }
    }

    private function getStartingLocation()
    {
        for ($i = 0; $i < count($this->boardingPasses); $i++) {
// A shortcut 
            $departureLocation = getDepartureLocation($this->boardingPasses[$i]);

// The starting location is a place we depart from but never arrived at 
            if (!$this->arrivalIndex[$departureLocation]) {
                return $departureLocation;
            }
        }
    }
}

class Trip
{

    /**
     * A trip "class" can keep a collection of all the boarding passes
     * associated with a particular trip.
     */
    public function Trip($boardingPasses)
    {
        $this->boardingPasses = $boardingPasses;

// Trip uses TripSorter to make sure everything is in order. 
        $this->boardingPasses = new TripSorter($this->boardingPasses);

	    // Sort it
	    sort($this->boardingPasses);

    }

// Define how to convert a trip to a string. 
    private function TriptoString()
    {
// Convert each boarding pass to a string, and concatenate them together. 
        $str = '';
        for ($i = 0; $i < count($this->boardingPasses); $i++) {
            $str .= $this->boardingPasses[i] . toString() . '\n';
        }

// Final greetings. 
        $str .= 'You have arrived at your final destination.\n';

        return $str;
    }

}

/**
 * Now lets use our OO library.
 */
$myTrip = new Trip([
    new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'),
    new AirportBusBoardingPass('Barcelona', 'Gerona Airport'),
    new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344'),
    new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22')
]);

echo $myTrip;


?>