<?php
include_once('api.php');

  // Lets plan a trip

  $myTrip = new Trip([
   
    new AirportBusBoardingPass('Barcelona', 'Gerona Airport'),    
    new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22'),
    new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'),
    new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344')
  ]);


$myTrip->TripString();

?>